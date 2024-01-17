install_vagrant:
    # Установить Vagrant и VirtualBox
	sudo apt install virtualbox vagrant

    # Adding ubuntu 20 box to vagrant
	vagrant box add ubuntu/focal64 ~/Downloads/focal-server-cloudimg-amd64-vagrant.box

install:	
    # Initializing virtual machine
    # vagrant init ubuntu/focal64

    # Starting virtual machine
    # vagrant up

    # Installing PHP 8.1
    # vagrant ssh -c "sudo apt update && sudo apt upgrade -y"
    # vagrant ssh -c "sudo apt-add-repository ppa:ondrej/php && sudo apt update"
    # vagrant ssh -c "sudo apt install -y openssl php8.1 php8.1-cli php8.1-common php8.1-bcmath php8.1-curl php8.1-mbstring php8.1-mysql php8.1-xml php8.1-zip"
	
    # Installing composer
    # scp -P 2222 -i .vagrant/machines/default/virtualbox/private_key composer_install.sh vagrant@127.0.0.1:/home/vagrant/composer_install.sh
    # vagrant ssh -c "chmod +x composer_install.sh && ./composer_install.sh && sudo mv composer.phar /usr/local/bin/composer"
    # vagrant ssh -c "rm composer_install.sh"

    # Creating Laravel project
    # vagrant ssh -c "mkdir Laravel\ projects"
    # vagrant ssh -c "git clone https://github.com/vix-4800/TaskEase Laravel\ projects/temp_folder"
    # vagrant ssh -c "mv Laravel\ projects/temp_folder/TaskEase Laravel\ projects/TaskEase && rm -rf Laravel\ projects/temp_folder"
    # vagrant ssh -c "cd Laravel\ projects/TaskEase && composer update"

    # Node and npm installation
    # vagrant ssh -c "curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash"
    # vagrant ssh -c ". ~/.nvm/nvm.sh && . ~/.profile && . ~/.bashrc && nvm install 21.5.0"
    # vagrant ssh -c "cd Laravel\ projects/TaskEase && npm install" !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    # Installing MySQL
    # vagrant ssh -c "sudo apt install mysql-server -y"
    # vagrant ssh -c "sudo systemctl enable mysql.service && sudo systemctl start mysql.service"

    # vagrant ssh -c "sudo mysql -e 'CREATE DATABASE task_ease_database;'"
    # vagrant ssh -c "sudo mysql -e 'CREATE USER \"task_ease_user\"@\"%\" IDENTIFIED BY \"^S3HP9nFgZ-XvUN\";'"
    # vagrant ssh -c "sudo mysql -e 'USE task_ease_database; GRANT ALL ON task_ease_database TO \"task_ease_user\"@\"%\";'"

    # vagrant ssh -c "cp Laravel\ projects/TaskEase/.env.example Laravel\ projects/TaskEase/.env"
    # vagrant ssh -c "sed -i 's/APP_NAME=.*/APP_NAME=TaskEase/g' Laravel\ projects/TaskEase/.env"
    # vagrant ssh -c "sed -i 's/DB_DATABASE=.*/DB_DATABASE=task_ease_database/g' Laravel\ projects/TaskEase/.env"
    # vagrant ssh -c "sed -i 's/DB_USERNAME=.*/DB_USERNAME=task_ease_user/g' Laravel\ projects/TaskEase/.env"
    # vagrant ssh -c "sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=^S3HP9nFgZ-XvUN/g' Laravel\ projects/TaskEase/.env"
    # vagrant ssh -c "php Laravel\ projects/TaskEase/artisan key:generate"
    # vagrant ssh -c "php Laravel\ projects/TaskEase/artisan migrate"

    # vagrant ssh -c "sudo apt-get autoclean && sudo apt-get autoremove -y"

    # Stop virtual machine
    # vagrant halt

start:
	vagrant up

	vagrant ssh -c "cd Laravel\ projects/TaskEase && php artisan serve & && npm run dev &"