# Get A Copy of Live DKAN Data

## In the Live DKAN instance (S3)
1. Go into Adminer and export the DKAN database.
1. Zip the entire /var/www/html folder.
1. Move the new .zip file somewhere publically available.

## On your local machine
1. Download and unzip the publically available zip file from S3.
1. `cd` into the unziped directory.
1. Run `vim sites/default/settings.php` and find where it reads `'password' => 'password` (around line 254). Change the line so it reads `'password' => 'rainbar'.
1. Save and exit vim (ESC + `:wp` + ENTER).
1. Run `vagrant init mohnjatthews/dkan`
1. Run `vim Vagrantfile` and uncomment line 29.
1. Run `vagrant up`.
1. Move the sql export we got in step 1 to `/adminer` in your DKAN root directory (~/dev/dkan-development/adminer).
1. Unzip the sql export in this directory.
1. Rename the unziped filed to `adminer.sql`
1. Open your browser and go to http://192.168.33.10/adminer.
1. Login using `root` as the username and `rainbar` as the password.
1. Click the tickbox next to **DKAN** and click **Drop**
1. Once that's done click on **Import**
1. Click on **Run File** on the right of the page under **From server**.
1. Once the import has finished you should be able to login to DKAN at http://192.168.33.10/user/login with the user and password details from the live DKAN instance.
