# Playing with CKAN
You probably already know what CKAN is, so there's really no point in me explaining that to you. This post, however, will attempt to guide you through building CKAN from source. Keep in mind that I did all this using Ubuntu 16.04LTS. Good luck

---

## Step 1 - Dependencies
First step is to install the required dependencies. The following command was taken from the [CKAN docs](http://docs.ckan.org/en/latest/maintaining/installing/install-from-source.html)

	sudo apt-get install python-dev postgresql libpq-dev python-pip python-virtualenv git-core solr-jetty openjdk-6-jdk redis-server

There's a couple of things we need to fix here though. First, `openjdk-6-jdk` isn't a thing anymore, so we're gonna install `openjdk-9-jdk` instead. Secondly, we need to grab `virtualenv` as well. So the above command should actually look like this:

	sudo apt-get install python-dev postgresql libpq-dev python-pip python-virtualenv git-core solr-jetty openjdk-9-jdk redis-server virtualenv

## Step 2 - Symlink
The [docs](http://docs.ckan.org/en/latest/maintaining/installing/install-from-source.html) suggest creating a symlink the directories used in the docs to my home folder, making it easier to copy and paste in example commands and all that stuff. Sounds like a sensible suggestion, symlink it is.

	mkdir -p ~/ckan/lib
	sudo ln -s ~/ckan/lib /usr/lib/ckan
	mkdir -p ~/ckan/etc
	sudo ln -s ~/ckan/etc /etc/ckan

## Step 3 - Virtual Environment
Next up is to install CKAN into a Python virtual environment. Never done this before, could be fun:

	sudo mkdir -p /usr/lib/ckan/default
	sudo chown `whoami` /usr/lib/ckan/default

	virtualenv --no-site-packages /usr/lib/ckan/default
	. /usr/lib/ckan/default/bin/activate

### Keeping Your Virtual Environment Alive
The virtual environment has to stay active for the rest of the installation. You can tell if it is still active by looking for the `(default)` in your terminal like this:

	(default) john@ubuntu: ~/$

So if your machine reboots or shutdown or sets on fire or whatever, just run `. /usr/lib/ckan/default/bin/activate` to get things back up and running again.

## Step 4 - Install the CKAN Source Code
To install the latest stable release of CKAN (currently 2.6.1) run:

	pip install -e 'git+https://github.com/ckan/ckan.git@ckan-2.6.1#egg=ckan'

Anoyingly there isn't anyway of finding out which is the latest and most stable version, we just have to rely on [the docs](http://docs.ckan.org/en/latest/maintaining/installing/install-from-source.html). So if you're reading this a month or so after the published date, take a look at the [official CKAN documentation](http://docs.ckan.org/en/latest/maintaining/installing/install-from-source.html) to see is 2.6.1 is still the latest version.


## Step 5 - Python Modules
We need to install the following Python modules that CKAN uses. These are installed directly into your virtual environment.

	pip install -r /usr/lib/ckan/default/src/ckan/requirements.txt

I had an issue here were python couldn't find `pg_config`.

	writing pip-egg-info/psycopg2.egg-info/PKG-INFO
    writing top-level names to pip-egg-info/psycopg2.egg-info/top_level.txt
    writing dependency_links to pip-egg-info/psycopg2.egg-info/dependency_links.txt
    writing manifest file 'pip-egg-info/psycopg2.egg-info/SOURCES.txt'
    Error: pg_config executable not found.

	...
    
    Command "python setup.py egg_info" failed with error code 1 in /tmp/pip-build-C1PpP1/psycopg2/

The error suggested that I needed to add the directory containing `pg_config` to the PATH or specify the full executable path with the option:

	python setup.py build_ext --pg-config /path/to/pg_config build ...
    
[Joar's answer on Stack Overflow](http://stackoverflow.com/a/5450183) fixed my issue. Run:

	sudo apt-get install libpq-dev python-dev

---

If you run into further problems here, it could be that you're using an older version of CKAN. Previous to v2.1 the requirements file was called `pip-requirements.txt`, and not `requirements.txt`. Try running the below command if you're having issues:

	pip install -r /usr/lib/ckan/default/src/ckan/pip-requirements.txt

## Step 5 - Reboot the Virtual Environment
To make sure everything's working all fine and dandy we need to deactivate and reactivate your virtual environment. This way we can make sure that we're using the virtual environment's copies of commands like `paster` rather than the system-wide copies.

	deactivate

You should now be back to your normal terminal:

	john@ubuntu:~/$

Now just load everything back up with:

	. /usr/lib/ckan/default/bin/activate

## Step 6 - Checking PostgreSQL
Regardless of how you pronounce it, we have to install PostgreSQL. It's fairly easy, only a few commands to run.

First we should check that it's actually been installed properly.

	sudo -u postgres psql -l

If you get something like `sudo: unknown user: postgresql` then PostgreSQL probably didn't install properly. Run: `sudo apt-get install postgresql` to fix that.

Once that's all taken care off run:
	
    sudo -u postgres psql -l

You might have to input your password, and even then you might get something that says permission denided. However as long as you end up with something looking like a table then you're ok:

	Name    |  Owner   | Encoding |   Collate   |    Ctype    |   Access privileges   
    -----------+----------+----------+-------------+-------------+-----------------------
     postgres  | postgres | UTF8     | en_GB.UTF-8 | en_GB.UTF-8 | 
     template0 | postgres | UTF8     | en_GB.UTF-8 | en_GB.UTF-8 | =c/postgres          +
               |          |          |             |             | postgres=CTc/postgres
     template1 | postgres | UTF8     | en_GB.UTF-8 | en_GB.UTF-8 | =c/postgres          +
               |          |          |             |             | postgres=CTc/postgres
    (3 rows)

## Step 7 - Create DB
Now we're gonna try and create the PostgreSQL database and all that business. Let's start with creating a database user:

	sudo -u postgres createuser -S -D -R -P ckan_default

You'll be asked to enter a password, and then one again to confirm you typed it all correctly. You'll probably want to write this down somewhere, it's going to become useful later.

Next we're going to create a new database called `ckan_default`, which will be owned by the user we just created in the last command.

	sudo -u postgres createdb -O ckan_default ckan_default -E utf-8

## Step 8 - CKAN Config File
So CKAN uses a config file to help set itself up and run all it's crap. It's really simple to make, but kinda catastrophic if you mess it up so pay attention.

Start off by making a directory that gonna contain all the config files;

	sudo mkdir -p /etc/ckan/default

Then go ahead and `chmod` them so that their permissions are set properly and we don't have to `sudo` everywhere:

    sudo chown -R `whoami` /etc/ckan/
	sudo chown -R `whoami` ~/ckan/etc

Once that's all done make the CKAN config file itself:

	paster make-config ckan /etc/ckan/default/development.ini

## Step 9 - Editing the Config File
We've now made the file and given it the correct permissions, but now we need to actually fill it with the options we'll be using down the road.

Edit the development.ini file in a text editor (Nano, Vim, Emacs, doesn't matter which one - they all do the same thing) and make the following changes:

#### sqlalchemy.url
This should point to the DB we made earlier: `sqlalchemy.url = postgresql://ckan_default:pass@localhost/ckan_default
`. Just replace `pass` with the password that you set before.

#### site_id
Each CKAN site should have a unique site_id. Just set it to `ckan.site_id = default` for now.

#### site_url
The same goes for the url. This is used when putting links to the site into the FileStore, notification emails, etc. For now use `ckan.site_url = http://demo.ckan.org`

There's no need to add a trailing slash onto the URL here.

## Step 10 - Solr
CKAN uses Solr as its search platform, and uses a customized Solr schema file that takes into account CKAN’s specific search needs. Now that we have CKAN installed and all set up, we need to install Solr.

I'm not going to go into how to install Solr here, since it varies massively depending on your OS. Use the [Solr docs](http://lucene.apache.org/solr/resources.html) to guide you to where you need to go.

## Step 11 - Flip Some Tables
It's time to actually start dealing with tables and exciting database things.:

	cd /usr/lib/ckan/default/src/ckan
	paster db init -c /etc/ckan/default/development.ini

if that worked then you should see `Initialising DB: SUCCESS`.

If the above command asks for a password then you probably haven't set up the sqlalchemy.url option in your CKAN config file. Go back up to [Step 9](#step-9-editing-the-config-file) and follow that section through again. If you're still having problems then check out the [CKAN docs on config files](//docs.ckan.org/en/latest/maintaining/configuration.html).

## Step 12 - The Datastore
Funnily enough the Datastore is not a shop where you can buy your data. This is an optional step, so it you want to learn more about it read up on the [CKAN docs](http://docs.ckan.org/en/latest/maintaining/installing/install-from-source.html#set-up-the-datastore)

## Step 13 - Who.ini
No, this has nothing to do with the band [The Who](https://www.youtube.com/watch?v=8c1hYO_BYHY). It's an initilization file that needs to be accessible in the same directory as your CKAN config file. The easiest way to achieve this is to create a symlink to it:

	ln -s /usr/lib/ckan/default/src/ckan/who.ini /etc/ckan/default/who.ini

## Step 14 - FINISHED!
That's it! Well, like, that's not everything obviously, now you have to actually go through the process of making your development changes and doing loads of funky stuff that'll make the world a better place, or something like that.

But you CAN now server CKAN and use it in your web browser:

	cd /usr/lib/ckan/default/src/ckan
	paster serve /etc/ckan/default/development.ini

You should probably run [CKAN's tests](http://docs.ckan.org/en/latest/contributing/test.html) just to make sure that everything is working.

### Happy Coding.