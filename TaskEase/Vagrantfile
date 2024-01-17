# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/focal64"
  
  config.vm.hostname = "laravel"

  config.vm.provider "virtualbox" do |vb|
    vb.cpus = 2
    vb.memory = 4096
  end

  config.vm.provision "shell", inline: <<-SHELL
    # Add PHP Repository
    sudo apt-add-repository ppa:ondrej/php

    # Update System Packages
    sudo apt update

    # Install Apache, OpenSSL and MySQL Server and 
    sudo apt install -y apache2 openssl mysql-server
  SHELL
end