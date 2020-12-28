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
#   apt install apache2 curl libapache2-mod-php mysql-server php-mysql php7.4 unzip wget zip
#
# You should secure Apache with Let's Encrypt. Install Cerbot:
#
#   apt install certbot python3-certbot-apache
#
# Configure the Firewall for Apache access (run as root):
#
#   ufw allow ssh
#   ufw allow 'Apache Full'
#   ufw enable
#
# Obtain an SSL certificate for the desired domains (run as root):
#
#   certbot --apache -d <DOMAIN> [-d <DOMAIN> ...]
#
# I used the following options:
#
#   wolfpack@wolvesofwallstreet.finance
#   A
#   N
#   2
#
# If MySQL hasn't been configured yet, you'll want to run the DBMS's included
# security script (run as root):
#
#   mysql_secure_installation
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
# Enter the MySQL CLI as root:
#
#   mysql
#
# Create the user and database (substituting variables from wp-config.php):
#
#   mysql> CREATE USER '<DB_USER>'@'localhost' IDENTIFIED BY '<DB_PASSWORD>';
#   mysql> GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO '<DB_USER>'@'localhost' WITH GRANT OPTION;
#   mysql> CREATE DATABASE <DB_NAME>;
#   mysql> FLUSH PRIVILEGES;
#   mysql> exit
#
# When the server is fully provisioned, clone the wolves-www repo to /var/www.
# You can now run this script to generate /var/www/html. See the end of the
# script for configuring wordpress after the script is run.
#

# Get the absolute path to this script
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

#
# Define directories. Each build stage has a directory:
#
#   * /config     Storage for site configuration
#   * /downloads  Storage for downloaded dependency archives
#   * /extracted  Storage for extracted dependency archives
#   * /build      Storage for files as the site is built
#   * /html       The files for deployment
#
CONFIG_DIR="${SCRIPT_DIR}/config"
DOWNLOAD_DIR="${SCRIPT_DIR}/downloads"
EXTRACT_DIR="${SCRIPT_DIR}/extracted"
BUILD_DIR="${SCRIPT_DIR}/build"
DEPLOY_DIR="${SCRIPT_DIR}/html"

# Create build stage directories
mkdir -p "${DOWNLOAD_DIR}"
mkdir -p "${EXTRACT_DIR}"
mkdir -p "${BUILD_DIR}"

#
# Dependency versions
#
# This script depends on the following dependencies:
#
#   * WordPress - https://wordpress.org
#   * All-in-One WP Migration plugin - https://en-gb.wordpress.org/plugins/all-in-one-wp-migration
#   * All-in-One WP Migration File Extension plugin - https://import.wp-migration.com
#   * phpMyAdmin (TODO: Make optional)
#
WORDPRESS_VERSION="latest"
AIO_MIGRATION_VERSION="7.32"
AIO_FILE_EXTENSION_URL= # Unversioned
PHPMYADMIN_VERSION="5.0.4"

# Dependency URLs
WORDPRESS_URL="https://wordpress.org/${WORDPRESS_VERSION}.zip"
AIO_MIGRATION_URL="https://downloads.wordpress.org/plugin/all-in-one-wp-migration.${AIO_MIGRATION_VERSION}.zip"
AIO_FILE_EXTENSION_URL="https://import.wp-migration.com/all-in-one-wp-migration-file-extension.zip"
PHPMYADMIN_URL="https://files.phpmyadmin.net/phpMyAdmin/${PHPMYADMIN_VERSION}/phpMyAdmin-${PHPMYADMIN_VERSION}-all-languages.zip"

# Download dependencies
wget "${WORDPRESS_URL}" -O "${DOWNLOAD_DIR}/wordpress.zip"
wget "${AIO_MIGRATION_URL}" -O "${DOWNLOAD_DIR}/aio_migration.zip"
wget "${AIO_FILE_EXTENSION_URL}" -O "${DOWNLOAD_DIR}/aio_file_extension.zip"
wget "${PHPMYADMIN_URL}" -O "${DOWNLOAD_DIR}/phpmyadmin.zip"

# Extract dependencies
unzip -o "${DOWNLOAD_DIR}/wordpress.zip" -d "${EXTRACT_DIR}"
unzip -o "${DOWNLOAD_DIR}/aio_migration.zip" -d "${EXTRACT_DIR}"
unzip -o "${DOWNLOAD_DIR}/aio_file_extension.zip" -d "${EXTRACT_DIR}"
unzip -o "${DOWNLOAD_DIR}/phpmyadmin.zip" -d "${EXTRACT_DIR}"

# Clean build directory
rm -rf "${BUILD_DIR}"/*

# Install dependencies to build directory
cp -r "${EXTRACT_DIR}/wordpress"/* "${BUILD_DIR}"
cp -r "${EXTRACT_DIR}/all-in-one-wp-migration" "${BUILD_DIR}/wp-content/plugins"
cp -r "${EXTRACT_DIR}/all-in-one-wp-migration-file-extension" "${BUILD_DIR}/wp-content/plugins"
cp -r "${EXTRACT_DIR}/phpMyAdmin-${PHPMYADMIN_VERSION}-all-languages" "${BUILD_DIR}/phpmyadmin"

# Create writable folders for dependencies
mkdir -p "${BUILD_DIR}/wp-content/ai1wm-backups"
mkdir -p "${BUILD_DIR}/wp-content/plugins/all-in-one-wp-migration/storage"

# Remove unused plugins and themes
rm -rf "${BUILD_DIR}/wp-content/plugins/akismet"
rm -rf "${BUILD_DIR}/wp-content/plugins/hello.php"
rm -rf "${BUILD_DIR}/wp-content/themes/twentynineteen"
rm -rf "${BUILD_DIR}/wp-content/themes/twentytwenty"
rm -rf "${BUILD_DIR}/wp-content/themes/twentytwentyone"

# Install WP config
cp "${CONFIG_DIR}/wp-config.php" "${BUILD_DIR}"

# Set permissions on wp-content directory
chmod -R a+w "${BUILD_DIR}/wp-content"

# Create a writable .htaccess file so WP can configure permalinks. Otherwise,
# the migration might fail.
touch "${BUILD_DIR}/.htaccess"
chmod a+w "${BUILD_DIR}/.htaccess"

# Replace the html directory with the fresh WordPress deployment
rm -rf "${DEPLOY_DIR}"
cp -r -p "${BUILD_DIR}" "${DEPLOY_DIR}"

#
# If setting up WP for the first time, enter the following information:
#
#   Site Title: Wolves of Wall Street
#   Username:   <WP username>
#   Password:   <WP password>
#   Email:      wolfpack@wolvesofwallstreet.finance
#
# Once WordPress is installed, click "Log In" and enter the credentials.
# Activate the two All-in-One WP Migration plugins.
#
# Before migration, visit the Permalinks page in admin settings. Just visit the
# page once, and .htaccess will be updated.
#
# Navigate to "All-in-One WP Migration" in the WP admin screen, and then the
# plugin's "Import" section.
#
# Obtain the file wolves.dxvert.com-20201228-103745-x2hnnl.wpress and import
# it using All-in-One Migration's FILE source.
#

echo
echo "Deployment complete. Visit URL in a web browser"
echo
