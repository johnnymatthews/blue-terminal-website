# HOW TO FUCKING GET LARAVEL HOMESTEAD RUNNING

Jesus Christ this is fucking annoying. I've spent about 3 hours this afternoon trying to install this piece of shit. Anywhere, we're now trying to fucking vagrant route now since every other piece of documentation is full of shit.

## Here we fucking go.

---

## Install Virtualbox and Vagrant

It's super fucking easy:

	sudo apt-get install virtualbox vagrant -y

Wouldn't it be nice if Laravel installed just like that? We fuck you it doesn't. It's gonna take hours away from your shitty little life and there's nothing else you can do about it, you big twat.

---

## *Install* the Homestead Vagrant Box

This bit's a sodding lie. We're not fucking installing anything. We're *DOWNLOADING*. That's all we're going. No registries are being made. Not .ini files being searched. No executables are opening. Literally just downloading a fucking Vagrant box:

	vagrant box add laravel/homestead

It's gonna take ages to load since your router is most likely a fucking potato.

---

## Installing Homestead

Fucking, `cd` into your home dir and `git clone` some shit and *then* `cd` into that shit you just shitted up:

	cd ~ && git clone https://github.com/laravel/homestead.git Homestead && cd Homestead

Fucking grand. Now run some stupid little script that do some stuff, I don't even fucking know:

	bash init.sh

It should show something like this:

	$ Homestead initialized!

Does it? **FUCKING FANTASTIC**.

---

## Configuring Some Shit

Seriously this is where the fucking work begins. I DON'T WANNA HAVE TO DO THIS SHIT! I JUST WANNA CODE! Dickheads.

Right `vim` into **Homestead.yaml** and make it look **EXACTLY** like this:

	 ---
	 ip: "192.168.10.10"
	 memory: 2048
	 cpus: 1
	 provider: virtualbox
	 
	 authorize: ~/.ssh/id_rsa.pub
	 
	 keys:
		 - ~/.ssh/id_rsa
	 
	 folders:
		 - map: ~/Code/blog
		   to: /home/vagrant/Code
	 
	 sites:
		 - map: homestead.local
		   to: /home/vagrant/Code/public
	 
	 databases:
		 - homestead
	 
	 # blackfire:
	 #     - id: foo
	 #       token: bar
	 #       client-id: foo
	 #       client-token: bar
	 
	 # ports:
	 #     - send: 50000
	 #       to: 5000
	 #     - send: 7777
	 #       to: 777
	 #       protocol: udp

---

## Hosts File

Because the people who made Laravel are convention breaking twats they chose to use .app and not .local for the end of their address lines or whatever. So we now have to go into the hosts file and change some shite:

	sudo vim /etc/hosts

Add this line to the bottom of the file:

	192.168.10.10	homestead.local

---

## RUN EVERYTHING

Literally just run:

	vagrant up

If you get an error it's probably because you're in the wrong fucking directory you turd-burger. `cd ~/Homestead` should sort you out.

---

## Here's the Important Bit

If you go to http://homestead.local now you won't see anything useful. Why is that? Well because you haven't actually told Laravel to fucking make anything yet!

Essentially, you're now at the point where you can start making stuff. Just `cd` into **Code** and run `laravel new blog` and Laravel should start making loads of cool shit.

---

## Looking at a stupid **nginx** error? 

It is most likely because of your **Homestead.yaml** file. Check the bit about folders and sites again, and make 100% sure that it looks like this:

	folder:
		- map: ~/Code/blog
		  to: /home/vagrant/Code

	sites:
		- map: homestead.local
		  to: /home/vagrant/Code/public

---

## Still having problems?

Well you're fucked. Because this solved my problems, which means I'm no longer going to search for fixes...

# Fucking,
# Done.

