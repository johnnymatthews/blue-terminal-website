# CKAN libapache2-mod-wsgi Installation Issue
## The Issue
So CKAN relies on `libapache2-mod-wsgi` to run various bits and bobs. Unfortunately for me I've ran into an issue. Attempting to install `libapache2-mod-wsgi` inside a Scotchbox Vagrant VM gives me the following error:

	WARNING: The following packages cannot be authenticated!
  		libapache2-mod-wsgi
        
	Install these packages without verification? [y/N]

Selecting yes leads onto this error:

	Err http://ppa.launchpad.net/ondrej/php5-5.6/ubuntu/ trusty/main libapache2-mod-wsgi amd64 4.3.0-1+deb.sury.org~trusty+1
  	
    404  Not Found

	E: Failed to fetch http://ppa.launchpad.net/ondrej/php5-5.6/ubuntu/pool/main/m/mod-wsgi/libapache2-mod-wsgi_4.3.0-1+deb.sury.org~trusty+1_amd64.deb  404  Not Found

	E: Unable to fetch some archives, maybe run apt-get update or try with --fix-missing?

Essentially, Ubuntu is having a hard time finding this package. The suggestion is to run `sudo apt-get update`, however all that does is point out that it can't find the location of the dependancy:

	Err http://ppa.launchpad.net trusty/main amd64 Packages                     	404  Not Found
    
    W: Failed to fetch http://ppa.launchpad.net/ondrej/php5-5.6/ubuntu/dists/trusty/main/binary-amd64/Packages  404  Not Found

	E: Some index files failed to download. They have been ignored, or old ones used instead.

Running through the rest of the CKAN installation without this dependacy is likely to cause lots of issues later on down the road, so it's best to fix this now.

## Installing From Source

The best solution that we have at the moment is to build `libapache2-mod-wsgi` from source. Building from source is always an adventure, so we'll see what happens.

First create a sources directory and `cd` into it:

	mkdir ~/sources
    cd ~/sources

Then pull down the package tar ball and unpack it:

	wget https://github.com/GrahamDumpleton/mod_wsgi/archive/4.5.15.tar.gz 
	tar xvfz 4.5.15.tar.gz

Now, anoyingly we need another two packages in order to put this one together. Here they are:

	 sudo aptitude install python-dev apache2-prefork-dev

I got a message saying that `apache2-prefork-dev` existsted in the package database, but it wasn't a real package. This meant that  had to remove `python-ckan{b}` before moving on with these two packages. Fairly anoying, but I can always reinstall the removed package once I've got `libapache2-mod-wsgi` installed.

Next we need to cd into the unpacked folder, configure everything, and then install `libapache2-mod-wsgi`.

	cd mod_wsgi-4.5.15/
    ./configure
    make

Yet another error pops up this time for me:

	apxs -c -I/usr/include/python2.7 -DNDEBUG -D_FORTIFY_SOURCE=2  -Wc,-g -Wc,-O2  src/server/mod_wsgi.c src/server/wsgi_*.c -L/usr/lib -L/usr/lib/python2.7/config  -lpython2.7 -lpthread -ldl  -lutil -lm
	/bin/sh: 1: apxs: not found
	make: *** [src/server/mod_wsgi.la] Error 127

According to a [Stack Overflow post](//stackoverflow.com/questions/16854750/issues-installing-mod-wsgi-cannot-find-makefile-in) this is due to not having the dev version of apache2 installed. Kinda stupid that the error message didn't allude to this in *any way*.

    sudo apt-get install -y apache2-dev

There we go. Now we can run `make` and it should go through nicely. Now that `libapache2-mod-wsgi` is finally installed we can move along to actually installing the rest of CKAN. 

Good luck.