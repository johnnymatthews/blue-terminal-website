# Basic Play-By-Play
First, ssh into server: `ssh user@something.com`.

## Drupal and DKAN
Run the following line by line:

	mysql -uroot -p # log into mysql service
	DROP DATABASE dkan; # drop the current dkan database if it's there
	CREATE DATABASE dkan; # create a new, blank, dkan database
	EXIT; # exit the mysql service
	sudo rm -rf /var/www/html/* # delete everything
	sudo rm -rf /var/www/html/.* # delete all hidden folders and files
	sudo git clone --branch master https://github.com/nuams/dkan-drops-7.git /var/www/html/ # clone the latest dkan-drops-7 release
	sudo mkdir /var/www/html/adminer # create a folder for adminer
	sudo wget https://github.com/vrana/adminer/releases/download/v4.3.1/adminer-4.3.1.php /var/www/html/adminer # download adminer
	sudo mv /var/www/html/adminer/adminer-4.3.1.php /var/www/html/adminer/index.php # change the name of adminer

### DKAN Permission Settings
	sudo mkdir /var/www/html/sites/default/files # make a directory for dkan uploaded files
	sudo chmod 777 /var/www/html/sites/default/files # make the files directory completely public (read-write-exe)
	sudo cp /var/www/html/sites/default/default.settings.php /var/www/html/sites/default/settings.php # copy the default settings config
	sudo chmod 777 /var/www/html/sites/default/settings.php # make the settings config read-write-exe

### GUI Install
Complete the interactive Drupal installation in the browser.

### Clean Up 
Run the following:
	sudo chmod 744 /var/www/html/sites/default/settings.php # revert the settings config back to safe settings

## Composer

	sudo apt-get update # update the local apt repository
	sudo apt-get install curl php-cli php-mbstring git unzip # install dependencies for composer
	cd ~ # move into the home directory
	curl -sS https://getcomposer.org/installer -o composer-setup.php # grab the composer install
	php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer VERIFIED'; } else { echo 'Installer CORRUPT'; unlink('composer-setup.php'); } echo PHP_EOL;" # check that it's all good
	sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer # run the install

## Drush
Run the following:

	cd /var/www/html # move into the public html directory
	sudo composer require drush/drush # tell composer to install drush
	vendor/bin/drush # run drush to check everything worked
	sudo apt-get autoremove # delete any temporary files that were created during the installation

## Modules
The following modules should also be installed. Although they're not 100% necessary for DKAN to run, they're incredibly useful to have around.

### [Backup & Migrate](https://www.drupal.org/project/backup_migrate)
This module allows you to take complete backups of the whole DKAN instance installed on the server, as well as restore from those backups. [FTP link](https://ftp.drupal.org/files/projects/backup_migrate-7.x-3.1.tar.gz).
