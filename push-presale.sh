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
# This deployment script is intended to push the deployed presale folder
# (html-presale) to the server where Apache is hosted.
#

# Enable strict mode
set -o errexit
set -o pipefail
set -o nounset

# Configuration: Set this to the domain name where the site is hosted
DOMAIN=wolvesofwallstreet.finance

# Push presale dapp to /var/www/html-presale
rsync -avP --delete "./html-presale" "root@${DOMAIN}:/var/www"
