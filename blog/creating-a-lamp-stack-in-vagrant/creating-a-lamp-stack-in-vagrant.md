# How to Make a LAMP Stack in 17 Steps

---

1. `vagrant init bento/ubuntu-16.04`
2. Edit the vagrant file to include:
	`config.vm.network :private_network, ip: "192.168.68.15"	`
    `config.vm.synced_folder "", "/home/vagrant/"`
3. `vagrant up`
4. `vagrant ssh` (password: **vagrant**)
5. `sudo apt-get update`
6. `sudo apt-get install -y apache2`
7. Add the following to the bottom of **/etc/apache2/apache2.conf**:
	`ServerName 192.168.68.15`
8. `sudo systemctl restart apache2`
9. `sudo ufw allow in "Apache Full"`
10. `sudo apt-get install -y mysql-server`
11. Enter password went prompted.
12. `sudo mysql_secure_installation`
13. Complete the installation by answering the questions it prompts. Here are my answers for reference:
	1. Validate Password Plugin: `n`
	2. Change Root Password: `n`
	3. Remove Anonymous Users: `y`
	4. Disallow Root Login: `n`
	5. Remote Test Database: `y`
	6. Reload Privilege Table: `y`
14. `sudo apt-get install -y php libapache2-mod-php php-mcrypt php-mysql`
15. `sudo apt-get install -y php-cgi php-cli php-curl php-common php-gd php-mysql`
16. Change the second line in **/etc/apache2/mods-enabled/dir.conf** to this:
	`DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm`
17. `sudo systemctl restart apache2`

And you're done!