# Dealing with Clean URLs, or How I Learned how to Interpret Recline JS Errors

This week I ran into an issue with *clean URLs* (essentially an SEO friendly URL, so no question marks, equals signs, etc) in DKAN. I stumbled onto this while attempting to fix an issue with the DKAN datastore. 

## The Problem

I could upload data (cvs, xls, etc) into DKAN and view the graphs and example data normally, but when I moved that data into the datastore then Recline would throw out an error. And it wasn't a nice, informative error either. It was literally the word `error` in a yellow box. Less than perfect, but at least it's something.

## Digging Deeper
Luckily, JS developers have a tendancy to throw errors into the browser console every once in a while, so I started digging there. Although there wasn't a developer written error there, there was a 404 from Chrome complaining that I couldn't find a particular JS file.

After jumping into Chrome's developer console a bit deeper I found that DKAN was looking for a JS file via the API. Normally not an issue, except that Recline was expecting DKAN to use clean URLs, and I hadn't set them up yet. Translation: Recline was looking for `/api/node` and DKAN was serving `/?q=api/node`.

## The Solution
Now I had my problem clearly mapped out, all that was left was to fix it. I jumped into the Drupal Docs and found that you could turn Clean URLs on through the admin backend. However once I got there I found that it didn't work. After a bit more searching around of Stack Overflow and the like, it turned out that I needed to edit my apache config files.

### Play-by-play

1. `sudo a2enmod rewrite`
2. `sudo chmod 700 /etc/apache2/apache2.conf`
2. `sudo vim /etc/apache2/apache2.conf`
3. Found the `<Directory>` bracket that I was concerned with an changed it to this:
	<Directory /vagrant>
		Options Indexes FollowSymLinks
		AllowOverride All
		Require all granted
	</Directory>
4. `sudo chmod 600 /etc/apache2/apache2.conf`
5. `sudo service apache2 restart`
6. Navigate to `/admin/config/search/clean-urls`

## And there we have it!
Now all that was left was to refresh the browser, turn on Clean URLs, and then all the ReclineJS functions worked as expected! 

A nice little Monday morning bug squashed by lunch!
