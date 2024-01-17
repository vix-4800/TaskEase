<p align="center">
    <img src="TaskEase/public/images/app-logo.png" width="200" alt="Laravel Logo" style="border-radius: 25px;">
</p>

# TaskEase

## Description

    TaskEase is a simple and user-friendly Laravel application for hassle-free task management. Organize your to-do list effortlessly with an intuitive interface, making task management a breeze. Stay productive and in control with TaskEase.

    This project also provides a Vagrant configuration and Makefile for setting up a development environment for Laravel using Ubuntu 20.04 (Focal Fossa). The Vagrantfile includes configurations for VirtualBox, and it's designed to simplify the process of getting a Laravel project up and running quickly.

## Requirements

-   VirtualBox
-   Vagrant

## Installation

1. Install <a href='https://www.virtualbox.org/wiki/Documentation'>VirtualBox</a>.

-   For Windows:

    Download the VirtualBox installer from the official website
    Run the installer and follow the installation wizard instructions

-   For macOS:

    Download the VirtualBox distribution from the official website
    Install VirtualBox following the on-screen instructions

-   For Ubuntu:

    Open the terminal
    Execute the following commands:

        sudo apt install virtualbox

-   For Fedora:

    Open the terminal
    Execute the following commands:

        sudo dnf install VirtualBox

-   For Arch Linux:

    Open the terminal
    Execute the following commands:

        sudo pacman -S virtualbox

2. Install <a href='https://developer.hashicorp.com/vagrant/docs'>Vagrant</a>.

-   For Windows:

    Download the Vagrant installer from the official website
    Run the installer and follow the installation wizard instructions

-   For macOS:

    Download the Vagrant distribution from the official website
    Install Vagrant following the on-screen instructions

-   For Ubuntu:

    Open the terminal
    Execute the following commands:

        sudo apt install vagrant

-   For Fedora:

    Open the terminal
    Execute the following commands:

        sudo dnf install vagrant

-   For Arch Linux:

    Open the terminal
    Ensure you have an AUR helper installed, e.g., yay. If not, install it:

        git clone https://aur.archlinux.org/yay.git
        cd yay
        makepkg -si

    Then install Vagrant from the AUR:

        yay -S vagrant

After the installation, type `vagrant` in the terminal or command prompt to confirm a successful installation.

3. In the project directory, run the following command: `make init_vagrant`. This will create a new Vagrant virtual machine with the following settings:

    - **Base box**: ubuntu/focal64
    - **Operating system**: Ubuntu 20.04 LTS
    - **Hostname**: laravel_host
    - **CPUs**: 2
    - **Memory**: 4096 MB -> 4 GB
    - **Storage size**: 20480 MB -> 20 GB

4. Proceed with the following command: make install. This will handle the installation of all the necessary dependencies for your <a href='https://laravel.com/docs/10.x'>Laravel</a> application.

5. Once the virtual machine is created, start it by running the following command: `make start`

6. Once the virtual machine is up and running, connect to it using SSH by running the following command: `vagrant ssh`

7. The Laravel server is now running on port 8000. You can open the project in your browser at http://localhost:8000
