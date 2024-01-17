# Vagrant Box Configuration
VAGRANT_BOX = ubuntu/focal64

# PHP and Node.js Versions
PHP_VERSION = 8.1
NODE_VERSION = 21.5.0

# Project Configuration
PROJECTS_FOLDER = Laravel\ projects
PROJECT_NAME = TaskEase

# Laravel Environment File
LARAVEL_ENV_FILE = $(PROJECTS_FOLDER)/$(PROJECT_NAME)/.env

# Database Configuration Variables
DATABASE_NAME = task_ease_database
DATABASE_USER = task_ease_user
DATABASE_PASSWORD = ^S3HP9nFgZ-XvUN

install_vagrant:
    # Update and Upgrade System Packages
	sudo apt update && sudo apt upgrade -y

    # Install VirtualBox and Vagrant
	sudo apt install virtualbox vagrant

    # Add Ubuntu Focal64 Box to Vagrant
	vagrant box add $(VAGRANT_BOX)
    # vagrant box add $(VAGRANT_BOX) ~/Downloads/focal-server-cloudimg-amd64-vagrant.box

init_vagrant:
    # Initialize Vagrant Project with Ubuntu Focal Fossa (20.04)
	vagrant init $(VAGRANT_BOX)

install:
    # Start Vagrant Machine
	vagrant up

    # Update and Upgrade System Packages
	vagrant ssh -c "sudo apt update && sudo apt upgrade -y"

    # Install PHP and Dependencies
	vagrant ssh -c "sudo apt install -y php$(PHP_VERSION) \
		php$(PHP_VERSION)-cli php$(PHP_VERSION)-common php$(PHP_VERSION)-bcmath \
		php$(PHP_VERSION)-curl php$(PHP_VERSION)-mbstring php$(PHP_VERSION)-mysql \
		php$(PHP_VERSION)-xml php$(PHP_VERSION)-zip"
	
    # Install Composer using Script
	scp -P 2222 -i .vagrant/machines/default/virtualbox/private_key -o StrictHostKeyChecking=no composer_install.sh vagrant@127.0.0.1:/home/vagrant/composer_install.sh
	vagrant ssh -c "chmod +x composer_install.sh && \
		./composer_install.sh && \
		sudo mv composer.phar /usr/local/bin/composer && \
		rm composer_install.sh"

    # Setup Laravel Project
	vagrant ssh -c "mkdir $(PROJECTS_FOLDER) && cd $(PROJECTS_FOLDER) && \
		git clone https://github.com/vix-4800/TaskEase temp_folder && \
		mv temp_folder/TaskEase $(PROJECT_NAME) && \
		rm -rf temp_folder && cd $(PROJECT_NAME) && \
		composer update"

    # Install Node Version Manager (nvm) and Node.js
	vagrant ssh -c "curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash && \
		. ~/.nvm/nvm.sh && . ~/.profile && . ~/.bashrc && \
		nvm install $(NODE_VERSION)"

    # Start MySQL Service 
	vagrant ssh -c "sudo systemctl enable mysql.service && sudo systemctl start mysql.service"

    # Create MySQL Database and User
	vagrant ssh -c "sudo mysql -e 'CREATE DATABASE $(DATABASE_NAME); \
		CREATE USER \"$(DATABASE_USER)\"@\"%\" IDENTIFIED BY \"$(DATABASE_PASSWORD)\"; \
		USE $(DATABASE_NAME); \
		GRANT ALL PRIVILEGES ON $(DATABASE_NAME).* TO \"$(DATABASE_USER)\"@\"%\"; \
		FLUSH PRIVILEGES;'"

    # Configure Laravel Project Environment
	vagrant ssh -c "\
		cp $(PROJECTS_FOLDER)/$(PROJECT_NAME)/.env.example $(LARAVEL_ENV_FILE) && \
		sed -i 's/APP_NAME=.*/APP_NAME=$(PROJECT_NAME)/g' $(LARAVEL_ENV_FILE) && \
		sed -i 's/DB_DATABASE=.*/DB_DATABASE=$(DATABASE_NAME)/g' $(LARAVEL_ENV_FILE) && \
		sed -i 's/DB_USERNAME=.*/DB_USERNAME=$(DATABASE_USER)/g' $(LARAVEL_ENV_FILE) && \
		sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=$(DATABASE_PASSWORD)/g' $(LARAVEL_ENV_FILE)"

    # Generate Laravel Application Key
	vagrant ssh -c "php $(PROJECTS_FOLDER)/$(PROJECT_NAME)/artisan key:generate"

    # Run Laravel Database Migrations
	vagrant ssh -c "php $(PROJECTS_FOLDER)/$(PROJECT_NAME)/artisan migrate"

    # Clean up APT Packages
	vagrant ssh -c "sudo apt autoclean && sudo apt autoremove -y"

    # Halt Vagrant Machine
	vagrant halt

start:
    # Start Vagrant Machine
	vagrant up

    # Install NPM dependencies
	vagrant ssh -c "cd $(PROJECTS_FOLDER)/$(PROJECT_NAME) && npm update"
	vagrant ssh -c "echo fs.inotify.max_user_watches=524288 | sudo tee -a /etc/sysctl.conf && sudo sysctl -p"
	vagrant ssh -c "sudo apt install firefox"