# cd /mnt/c/ -> go to directory where key is stored.
# Change Permission for pem file
sudo chmod 400 424Key2.pem 
#
# SSH login into server using the IPv4 address
sudo ssh -i 424Key2.pem  ubuntu@54.176.159.34
#

# update system
sudo apt-get update
#
# upgrade with installed packages
sudo apt-get upgrade
#
#
# LAMP SETUP
#
# Install Apache2
sudo apt-get install apache2
#
# Install PHP and packages
sudo apt-get install php
php --version
sudo apt-get install php7.4-cli php7.4-common php7.4-curl php7.4-gd php7.4-json php7.4-mbstring php7.4-intl php7.4-mysql php7.4-xml php7.4-zip
#
# move index.php to the front of the list in DirectoryIndex
sudo vi /etc/apache2/mods-enabled/dir.conf
#
# Install MySQL
sudo apt-get install mysql-server
#
# config MySQL
sudo mysql_secure_installation
sudo mysql
# Config root password
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'mirajsecurity1';
# reload and push changes
FLUSH PRIVILEGES;
exit;
# Installing Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
#
#Install Git
sudo apt-get install git-core
#Download and install repo
cd /var/www/html
sudo git clone https://github.com/josh7951/424Project.git
cd 424Project
#
#Intall Dependencies 
sudo composer install
#
# set proper permissions
sudo chown -R www-data.www-data /var/www/html/424Project
sudo chmod -R 755 /var/www/html/424Project
sudo chmod -R 777 /var/www/html/424Project/storage
#
#Create environment settings and add application key
sudo mv .env.example .env
sudo php artisan key:generate
sudo php artisan migrate
#
#Edit .env file
sudo vi .env
#
#
#
cd ~
sudo vi /etc/apache2/sites-available/000-default.conf
#
# set up apache conf file
#
#
sudo systemctl restart apache2