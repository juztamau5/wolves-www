#!/bin/bash
################################################################################
#
#  Copyright (C) 2020 The Wolfpack
#  This file is part of wolves-www - https://github.com/wolvesofwallstreet/wolves-www
#
#  SPDX-License-Identifier: Apache-2.0
#  See the file LICENSE.txt for more information.
#
################################################################################

#
# In order to build the dapp, you will need NVM, Node and Yarn. Follow the
# instructions to install NVM (not printed here due to bash piping). Then,
# install Node 14 and Yarn:
#
#   nvm install 14
#   npm install -g yarn
#

# Enable strict mode
set -o errexit
set -o pipefail
set -o nounset

# Dapp version
WOLVES_DAPP_VERSION="91b51fd8686dbb94943433e8bf799bfed35bacf8"

# Dapp URL
WOLVES_DAPP_URL="https://github.com/wolvesofwallstreet/wolves.finance/archive/${WOLVES_DAPP_VERSION}.zip"

# Get the absolute path to this script
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

#
# Define directories. Each build stage has a directory:
#
#   * /config            Storage for site configuration
#   * /wp-content        WordPress content (plugins, themes, etc) to install
#   * /wp-content/wflogs Place Wordfence logs here
#   * /downloads         Storage for downloaded dependency archives
#   * /extracted         Storage for extracted dependency archives
#   * /build             Storage for files as the site is built
#   * /html              The files for deployment
#
DOWNLOAD_DIR="${SCRIPT_DIR}/downloads"
EXTRACT_DIR="${SCRIPT_DIR}/extracted"
BUILD_DIR="${SCRIPT_DIR}/build-presale"
DEPLOY_DIR="${SCRIPT_DIR}/html-presale"

# Create build stage directories
mkdir -p "${DOWNLOAD_DIR}"
mkdir -p "${BUILD_DIR}"

# Download dependencies
# TODO: Retry several times if a 404 is given (wget exits with code 8)
# A 404 occurred once with wordpress.com
echo "Downloading dapp source..."
wget "${WOLVES_DAPP_URL}" -O "${DOWNLOAD_DIR}/wolves-dapp-${WOLVES_DAPP_VERSION}.zip"

# Extract dependencies
echo "Extracting dapp source..."
unzip -o "${DOWNLOAD_DIR}/wolves-dapp-${WOLVES_DAPP_VERSION}.zip" -d "${EXTRACT_DIR}"

# Clean build directory
echo "Cleaning build directory..."
rm -rf "${BUILD_DIR}"

# Copy source to build directory
echo "Copying dapp source..."
cp -r "${EXTRACT_DIR}/wolves.finance-${WOLVES_DAPP_VERSION}" "${BUILD_DIR}"

# Build Wolves dapp
echo "Building presale dapp..."
(
  cd "${BUILD_DIR}"
  yarn install
  yarn run audit
  yarn compile
  yarn build
)

# Replace the html-presale directory with the fresh dapp deployment
echo "Deploying presale dapp..."
sudo rm -rf "${DEPLOY_DIR}"
cp -r "${BUILD_DIR}/build" "${DEPLOY_DIR}"

# Set permissions on deployed files
echo "Updating permissions..."
find "${DEPLOY_DIR}" -type d -exec chmod 775 {} \;
find "${DEPLOY_DIR}" -type f -exec chmod 664 {} \;
find "${DEPLOY_DIR}" -type d -exec chmod g+s {} \;
sudo chown -R www-data:www-data "${DEPLOY_DIR}"

echo
echo "Dapp deployment complete"
echo
