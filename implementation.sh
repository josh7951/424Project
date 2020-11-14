# Setting up SSL for Domain
#
# Install CertBot
sudo apt install certbot python3-certbot-apache
#
#
sudo nano /etc/apache2/sites-available/000-default.conf
#
# Add after <VirtualHost *:80>
#       ServerName miraj-security.net
#       ServerAlias www.miraj-security.net
#       ServerAdmin webmaster@localhost
#       DocumentRoot /var/www/html/424Project/public/
#	<Directory /var/www/>
#              	AllowOverride All
#       </Directory>
#
# save and exit
#
# test syntax
sudo apache2ctl configtest
#
# and reload system
sudo systemctl reload apache2
#
# obtain SSL certifcate
sudo certbot --apache
#
# verify service
sudo systemctl status certbot.timer
#
#
#
#
#
#
# SETTING UP IPTables
#
# First : Loopback/localhost data Allow data between items on the localhost network (loopback interface).
sudo iptables -A INPUT -i lo -j ACCEPT
#
# Allow/keep current related/established rules, such as our SSH connection.
sudo iptables -A INPUT -m conntrack --ctstate RELATED,ESTABLISHED -j ACCEPT
#
# Allow future SSH connections & HTTP (port 80) traffic:
sudo iptables -A INPUT -p tcp --dport 22 -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT
# Drop everything else
sudo iptables -A INPUT -j DROP
#
# allow https traffic :
sudo iptables -I INPUT 5 -p tcp --dport 443 -j ACCEPT
#
#
# Install Snort
# First determine Interface and IP address
ip addr
#
#
# interface : eth0
# IP: 172.31.14.217/20
sudo apt-get install snort
#
# Follow on screen instructions
# Check install
snort --version
# Configure Snort
sudo nano /etc/snort/snort.conf
#
# change ipvar HOME_NET any --> ipvar HOME_NET 172.31.14.217/20
#
# update snort rules
wget https://www.snort.org/rules/snortrules-snapshot-2983.tar.gz?oinkcode=940a87c18e940494e3e8dff86a9283cbd65564e3 -O snortrules-snapshot-2983.tar.gz
#
# extract and install rules
sudo tar -xvzf snortrules-snapshot-2983.tar.gz -C /etc/snort/rules