#!/bin/bash
################################################################################
#
#  Copyright (C) 2020 wolves.finance developers
#  This file is part of wolves-www - https://github.com/wolvesofwallstreet/wolves-www
#
#  SPDX-License-Identifier: Apache-2.0
#  See the file LICENSE.txt for more information.
#
################################################################################

# Enable strict mode
set -o errexit
set -o pipefail
set -o nounset

# Configuration: Set this to "true" to exclude phpmyadmin, "false" to install it
EXCLUDE_PHPMYADMIN=true

#
# This deployment script is intended to install the wolves.finance website
# on a fresh Linux server.
#
# You will need the following items:
#
#   * wp-config.php - Obtain from team member and place in config/
#   * WordPress username/password
#   * Database migration file - wolves.dxvert.com-20201228-103745-x2hnnl.wpress
#
# After provisioning the server, install the following dependencies:
#
#   sudo apt install apache2 curl libapache2-mod-php mysql-server php7.4 php7.4-curl php7.4-mbstring php7.4-mysql php7.4-xml unzip wget zip
#
# You should secure Apache with Let's Encrypt. Install Cerbot:
#
#   sudo apt install certbot python3-certbot-apache
#
# Configure the Firewall for Apache access:
#
#   sudo ufw allow ssh
#   sudo ufw allow 'Apache Full'
#   sudo ufw enable
#
# Obtain an SSL certificate for the desired domains:
#
#   sudo certbot --apache -d <DOMAIN> [-d <DOMAIN> ...]
#
# I used the following options:
#
#   wolfpack@wolvesofwallstreet.finance
#   A
#   N
#   2
#
# If MySQL hasn't been configured yet, you'll want to run the DBMS's included
# security script:
#
#   sudo mysql_secure_installation
#
# I used the following options:
#
#   Y
#   0
#   <DB_PASSWORD from wp-config.php>
#   <DB_PASSWORD from wp-config.php>
#   Y
#   Y
#   Y
#   Y
#   Y
#
# Enter the MySQL CLI:
#
#   sudo mysql
#
# Create the user and database (substituting variables from wp-config.php):
#
#   mysql> CREATE USER '<DB_USER>'@'localhost' IDENTIFIED BY '<DB_PASSWORD>';
#   mysql> GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO '<DB_USER>'@'localhost' WITH GRANT OPTION;
#   mysql> CREATE DATABASE <DB_NAME>;
#   mysql> FLUSH PRIVILEGES;
#   mysql> exit
#
# To set up the SFTP server, modify /etc/ssh/sshd_config. It's recommended to
# make a backup before:
#
#   sudo cp /etc/ssh/sshd_config /etc/ssh/sshd_config-backup
#   sudo nano /etc/ssh/sshd_config
#
# Scroll to the bottom of the file and comment out the line `Subsystem sftp`,
# then add the internal-sftp subsystem:
#
#   #Subsystem sftp /usr/lib/openssh/sftp-server
#   Subsystem sftp internal-sftp
#
# Create a new SFTP user with the same name as the MySQL user and primary group
# www-data, then set its password to the same as the MySQL user:
#
#   sudo useradd -g www-data -d /var/www/html -s /sbin/nologin <DB_USER>
#   sudo passwd <DB_USER>
#
# Add the `Match Group` directive in SSH config (/etc/ssh/sshd_config):
#
#   Match Group www-data
#        ChrootDirectory %h
#        AllowTcpForwarding no
#        AcceptEnv
#        X11Forwarding no
#        ForceCommand internal-sftp
#        PasswordAuthentication yes
#
# Test SSH config before restarting:
#
#   sshd -t
#
# If no errors, restart the sshd service for changes to take affect:
#
#   sudo service sshd restart
#
# Try logging in with SFTP with your new user. It should be able to create files
# as itself which are readable by www-data.
#
# When the server is fully provisioned, you can now run this script to generate
# /var/www/html. The site can be deployed with rsync (run from repo root):
#
#   rsync -avP --delete ./html root@<DOMAIN>:/var/www
#
# When changes have been made to the content on the server, they can be synced
# back to the repo (run from repo root):
#
#   rsync -avP --delete root@<DOMAIN>:/var/www/html/wp-content .
#
# If setting up WP for the first time, enter the following information:
#
#   Site Title: Wolves of Wall Street
#   Username:   <WP username>
#   Password:   <WP password>
#   Email:      wolfpack@wolvesofwallstreet.finance
#

# Get the absolute path to this script
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

#
# Define directories. Each build stage has a directory:
#
#   * /config     Storage for site configuration
#   * /wp-content WordPress content (plugins, themes, etc) to install
#   * /downloads  Storage for downloaded dependency archives
#   * /extracted  Storage for extracted dependency archives
#   * /build      Storage for files as the site is built
#   * /html       The files for deployment
#
CONFIG_DIR="${SCRIPT_DIR}/config"
CONTENT_DIR="${SCRIPT_DIR}/wp-content"
DOWNLOAD_DIR="${SCRIPT_DIR}/downloads"
EXTRACT_DIR="${SCRIPT_DIR}/extracted"
BUILD_DIR="${SCRIPT_DIR}/build"
DEPLOY_DIR="${SCRIPT_DIR}/html"

# Create build stage directories
mkdir -p "${DOWNLOAD_DIR}"
mkdir -p "${EXTRACT_DIR}"
mkdir -p "${BUILD_DIR}"

# Check for required config file
if [ ! -f "${CONFIG_DIR}/wp-config.php" ]; then
  echo "You must provide wp-config.php. Place it in the config/ directory"
  exit 1
fi

#
# Dependency versions
#
# This script depends on the following dependencies:
#
#   * WordPress - https://wordpress.org
#   * phpMyAdmin (TODO: Make optional)
#
WORDPRESS_VERSION="5.6"
PHPMYADMIN_VERSION="5.0.4"

# Dependency URLs
WORDPRESS_URL="https://wordpress.org/wordpress-${WORDPRESS_VERSION}.zip"
PHPMYADMIN_URL="https://files.phpmyadmin.net/phpMyAdmin/${PHPMYADMIN_VERSION}/phpMyAdmin-${PHPMYADMIN_VERSION}-all-languages.zip"

# Download dependencies
echo "Downloading dependencies..."
wget --no-show-progress "${WORDPRESS_URL}" -O "${DOWNLOAD_DIR}/wordpress-${WORDPRESS_VERSION}.zip"
$EXCLUDE_PHPMYADMIN || wget --no-show-progress "${PHPMYADMIN_URL}" -O "${DOWNLOAD_DIR}/phpmyadmin-${PHPMYADMIN_VERSION}.zip"

# Extract dependencies
echo "Extracting dependencies..."
unzip -o "${DOWNLOAD_DIR}/wordpress-${WORDPRESS_VERSION}.zip" -d "${EXTRACT_DIR}"
$EXCLUDE_PHPMYADMIN || unzip -o "${DOWNLOAD_DIR}/phpmyadmin-${PHPMYADMIN_VERSION}.zip" -d "${EXTRACT_DIR}"

# Clean build directory
echo "Cleaning build directory..."
rm -rf "${BUILD_DIR}"/*

# Install dependencies to build directory
echo "Installing dependencies..."
cp -r "${EXTRACT_DIR}/wordpress"/* "${BUILD_DIR}"
$EXCLUDE_PHPMYADMIN || cp -r "${EXTRACT_DIR}/phpMyAdmin-${PHPMYADMIN_VERSION}-all-languages" "${BUILD_DIR}/phpmyadmin"

# Create writable folders for dependencies
mkdir -p "${BUILD_DIR}/wp-content/ai1wm-backups"
mkdir -p "${BUILD_DIR}/wp-content/plugins/all-in-one-wp-migration/storage"
mkdir -p "${BUILD_DIR}/wp-content/upgrade"

# Remove unused plugins and themes
echo "Removing unused plugins and themes..."
rm -rf "${BUILD_DIR}/wp-content/plugins/akismet"
rm -rf "${BUILD_DIR}/wp-content/plugins/hello.php"
rm -rf "${BUILD_DIR}/wp-content/themes/twentynineteen"
rm -rf "${BUILD_DIR}/wp-content/themes/twentytwenty"
rm -rf "${BUILD_DIR}/wp-content/themes/twentytwentyone"

# Also remove the readme, which gets renamed by WP to prevent access
rm "${BUILD_DIR}/readme.html"

# Install WP content
echo "Installing AiO backup data..."
cp -r "${CONTENT_DIR}"/ai1wm-backups "${BUILD_DIR}/wp-content"

echo "Installing languages..."
cp -r "${CONTENT_DIR}"/languages "${BUILD_DIR}/wp-content"

echo "Installing languages..."
cp -r "${CONTENT_DIR}"/plugins "${BUILD_DIR}/wp-content"

echo "Installing themes..."
cp -r "${CONTENT_DIR}"/themes "${BUILD_DIR}/wp-content"

echo "Installing uploads..."
cp -r "${CONTENT_DIR}"/uploads "${BUILD_DIR}/wp-content"

echo "Installing Wordfence data..."
cp -r "${CONTENT_DIR}"/wflogs "${BUILD_DIR}/wp-content"

# Install WP config
echo "Installing WordPress config..."
cp "${CONFIG_DIR}/.htaccess" "${BUILD_DIR}"
cp "${CONFIG_DIR}/wordfence-waf.php" "${BUILD_DIR}"
cp "${CONFIG_DIR}/wp-config.php" "${BUILD_DIR}"

# Replace the html directory with the fresh WordPress deployment
echo "Deploying website..."
sudo rm -rf "${DEPLOY_DIR}"
cp -r "${BUILD_DIR}" "${DEPLOY_DIR}"

# Set permissions on deployed files
echo "Updating permissions..."
find "${DEPLOY_DIR}" -type d -exec chmod 775 {} \;
find "${DEPLOY_DIR}" -type f -exec chmod 664 {} \;
find "${DEPLOY_DIR}" -type d -exec chmod g+s {} \;
sudo chown -R www-data:www-data "${DEPLOY_DIR}"

echo
echo "Deployment complete"
echo
