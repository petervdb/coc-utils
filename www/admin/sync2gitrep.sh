#!/bin/bash
rsync -avzh --exclude 'config.php' /var/www/html/coc/* $HOME/GitHub/coc-utils/www

