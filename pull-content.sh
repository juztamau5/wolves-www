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
# This deployment script is intended to pull the current state of the WordPress
# content folder (wp-content) into this Git repository.
#

# Enable strict mode
set -o errexit
set -o pipefail
set -o nounset

# Configuration: Set this to "true" to exclude phpmyadmin, "false" to install it
DOMAIN=wolvesofwallstreet.finance

# Pull content from /var/www/html/wp-content
rsync -avP --delete "root@${DOMAIN}:/var/www/html/wp-content" "."
