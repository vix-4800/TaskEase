# Установить Vagrant и VirtualBox
PROJECT_FOLDER=Laravel\ projects
PROJECT_NAME=project

PHP_VERSION=8.1
NODE_VERSION=21.5.0
COMPOSER_SCRIPT=composer_install.sh

ENV_FILE=.env

DATABASE_NAME=project_database
DATABASE_USER=project_user
DATABASE_PASSWORD=^S3HP9nFgZ-XvUN

install_vagrant:
	sudo apt install virtualbox vagrant

install:
  	# Adding ubuntu 20 box to vagrant
	vagrant box add ubuntu/focal64 ~/Downloads/focal-server-cloudimg-amd64-vagrant.box
	
    # Initializing virtual machine
	vagrant init ubuntu/focal64

    # Starting virtual machine
	vagrant up

    # Installing PHP 8.1
	vagrant ssh -c "sudo apt update && sudo apt upgrade -y"
	vagrant ssh -c "sudo apt-add-repository ppa:ondrej/php && sudo apt update"
	vagrant ssh -c "sudo apt install -y openssl php$PHP_VERSION php$PHP_VERSION-cli php$PHP_VERSION-common php$PHP_VERSION-bcmath php$PHP_VERSION-curl php$PHP_VERSION-mbstring php$PHP_VERSION-mysql php$PHP_VERSION-xml php$PHP_VERSION-zip"
	
    # Installing composer
	scp -P 2222 -i .vagrant/machines/default/virtualbox/private_key ./$COMPOSER_SCRIPT vagrant@127.0.0.1:/home/vagrant/$COMPOSER_SCRIPT
	vagrant ssh -c "chmod +x ./$COMPOSER_SCRIPT && ./$COMPOSER_SCRIPT && sudo mv composer.phar /usr/local/bin/composer"
	vagrant ssh -c "rm ./$COMPOSER_SCRIPT"

    # Creating Laravel project
	vagrant ssh -c "mkdir $PROJECT_FOLDER && cd $PROJECT_FOLDER"
	vagrant ssh -c "composer create-project laravel/laravel $PROJECT_NAME && cd $PROJECT_NAME"

    # Node and npm installation
	vagrant ssh -c "curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash"
	vagrant ssh -c "nvm install $NODE_VERSION"

    # Installing MySQL
	vagrant ssh -c "sudo apt install mysql-server"
	vagrant ssh -c "sudo systemctl enable mysql.service && sudo systemctl start mysql.service"

	vagrant ssh -c "sudo mysql << EOF
    	CREATE DATABASE $DATABASE_NAME;
    	USE $DATABASE_NAME;
    	CREATE USER '$DATABASE_USER'@'%' IDENTIFIED BY '$DATABASE_PASSWORD';
    	GRANT ALL ON $DATABASE_NAME TO '$DATABASE_USER'@'%';
	EOF"

	vagrant ssh -c "sudo mysql_secure_installation << EOF
		y
		2
		y
		y
		y
		y
		EOF"

	sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DATABASE_NAME/g" $ENV_FILE
	sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DATABASE_USER/g" $ENV_FILE
	sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DATABASE_PASSWORD/g" $ENV_FILE

	vagrant ssh -c "sudo apt-get autoclean && sudo apt-get autoremove -y"

    # Stop virtual machine
	vagrant halt

start:
  vagrant up

  vagrant ssh -c "cd $PROJECT_FOLDER/$PROJECT_NAME"
  vagrant ssh -c "php artisan serve & && npm run dev &"