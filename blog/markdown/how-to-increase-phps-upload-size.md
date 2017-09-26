# How to Increase PHPs Upload Size

So, for some reason PHP's default upload size is only 2MB. This might have been large enough for most files way back in the day, but these days it's barely enough to move a .doc file around. Here's how to change it to whatever you like.

Use the [Quick Reference](quick-reference) steps if you already know what you're doing, and just need to copy the commands.

## Prerequsites
 - A server (local or remote) running LAMP with Ubuntu 14.04 or higher
 - SSH access to your server
 - Coffee

---

## Steps

1. Firstly you need to SSH into your server.
2. You need to find out where you `php.ini` file is. Doing this via the commandline can be misleading (`php --ini` only shows you which **php.ini** file is being used by the command line interface), so we're going use your servers web server to tell us.
 - `cd` to your web servers root (probably `/var/www/html`).
 - Run `echo "<?php phpinfo(); ?>" > info.php`
3. Open your web browers and go to **http://YOUR_SERVER_ADDRESS/info.php**, obviously inputting your servers address in the url.
4. You should see a page with your php details. Look for where it says **Configuration File (php.ini Path)**. It should be on the fourth row from the top. Copy that path.
5. Back in your server, `cd` to that path you just copied.
6. Open a file called `php.ini` in that directory.
7. Find where it says `upload_max_filesize = ` and change the value to `2048M`.
8. Still in the same file, find where it says `post_max_size = ` and change the value to `2048M`.
9. Save and exit the file.
10. Run `sudo service apache2 restart`.
11. Exit your server.
12. That's it, you're done. 

You should now be able to upload files of up to 2GB into your server.

---

## Quick Reference Steps

1. `vim /etc/php/7.0/apache2/php.ini`
2. Search for `upload_max_filesize`, change to required value.
3. Search for `post_max_size`, change to require value (=< than `upload_max_filesize`)
4. `sudo service apapche2 restart`
