# Update A Module in DKAN
To do this you need to make sure that `sites/default` and `profiles/dkan` (recursively) are both *owned* by **www-data**.

Run the following:

    sudo chmod 777 /var/www/html/sites/default/settings.php
    sudo chown www-data /var/www/html/sites/default/
    sudo chown www-data -R /var/www/html/profiles/dkan/

If you're still running into problem then you may need to `chown` the modules folder to `www-data`. Or, create a folder for the module and `chown` that to `www-data`. Run the following:

    sudo mkdir /var/www/html/sites/all/modules/MODULE_NAME
    sudo chown www-data /var/www/html/sites/all/modules/MODULE_NAME

## VERY IMPORTANT!
Revert the settings config back to normal by running the following:

    sudo chmod 744 /var/www/html/sites/default/settings.php

Then you're done.
