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
# This deployment script is intended to push the deployed website folder (html)
# to the server where the WordPress site is hosted.
#

# Enable strict mode
set -o errexit
set -o pipefail
set -o nounset

# Configuration: Set this to "true" to exclude phpmyadmin, "false" to install it
DOMAIN=wolves

# Push website to /var/www/html
rsync -avP --delete "./html" "root@${DOMAIN}:/var/www"
