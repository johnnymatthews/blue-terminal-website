# How to Disable Middle Mouse Button Paste in Ubuntu

Find out the `id` of your mouse by running `xinput list | grep 'id='`. This should give you a list similar to the following:

	⎡ Virtual core pointer                    	id=2	[master pointer  (3)]
	⎜   ↳ Virtual core XTEST pointer              	id=4	[slave  pointer  (2)]
	⎜   ↳ PixArt Microsoft USB Optical Mouse      	id=10	[slave  pointer  (2)]
	⎣ Virtual core keyboard                   	id=3	[master keyboard (2)]
		↳ Virtual core XTEST keyboard             	id=5	[slave  keyboard (3)]
		↳ Power Button                            	id=6	[slave  keyboard (3)]
		↳ Power Button                            	id=7	[slave  keyboard (3)]
		↳ Logitech USB Keyboard                   	id=8	[slave  keyboard (3)]
		↳ Logitech USB Keyboard                   	id=9	[slave  keyboard (3)]

Now, my mouse has *Microsoft* written on the back, so I can assume that it's the *PixArt Microsoft USB Optical Mouse*, which has an `id` of 10.

Running `xinput get-button-map 10` will give me a pretty useless list of all the buttons my mouse has:

	1 2 3 4 5 6 7

Luckily [some people on the internet happen to know which number represents the middle mouse button, and it's the 2nd number in (`2` in this case). To disable the paste function of the middle mouse button, but still retain the scroll functions, we need to change that second number to a 0. To do this run the following command:

	xinupt set-button-map 10 1 0 3

And that's it! Should work just fine now! You may have to add this to a startup script or something like that to make sure it runs every time you turn your computer on.
