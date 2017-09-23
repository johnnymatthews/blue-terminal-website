# Open your File Manager from the Terminal in Ubuntu Mate

### This post was build with Ubuntu Mate in mind, but any Linux distro using the [Gnome file manager](https://en.wikipedia.org/wiki/GNOME_Files) should work fine.

Do you ever find yourself 22 folders deep into some long lost repository or Drupal theme, and need to jump into the file manager at this point to take a look at some pictures or something? Add the following line into your `.bashrc` file:

	alias ofm=`gnome-open .

Make sure to include the dot at the end.

Run `source ~/.bashrc` and you should now be able to run `ofm` within a terminal to **o**pen your **f**ile **m**anager at the same directory your terminal is currently in.

## Cheers!
