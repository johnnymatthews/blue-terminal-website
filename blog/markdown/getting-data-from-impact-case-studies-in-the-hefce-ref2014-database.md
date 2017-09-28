# Getting Data from Impact Case Studies in HEFCE’s REF2014 database

Recently we were tasked with grabbing some data from HEFCE’s API of [Impact Case Studies submitted to the REF2014](http://impact.ref.ac.uk/CaseStudies/).

What we wanted to know was to find out how many UK Data Service data collections were used in Impact Case Studies in REF2014 and the case studies they were used in.

The first step was to figure out how the API worked. Luckily the API is very well built, and includes a good amount of documentation to go along with it. Sure it might read like a wall of text, but some documentation is better than no documentation. The API itself works in a fairly regular way, with multiple endpoints and built in handy functions that we can utilise later on.

The UK Data Service uses [persistent identifiers](https://www.ukdataservice.ac.uk/use-data/citing-data) for users to cite data in the collection, but it seemed that a lot of the case studies using data in the UK Data Service collection had included data collections by name, rather than digital object identifier, so it seemed reasonable to start with a list of our collections from ukdataservice.ac.uk/get-data/key-data.

There's a joke within programming circles that says "*if you want to be the best programmer, you've got to be lazy*." Essentially, "*script everything*". Why bother doing something manually when you can just get a computer to do it for you. Doing so will tune up your scripting and logic skills, plus you never know when something like this might come in handy later. So with this in mind it shouldn't come as a surprise that instead of copying down each and every survey title by hand, we just got a script to do it for us. Here's how the script worked:

 - Get the source code from [ukdataservices.ac.uk/get-data/key-data](ukdataservices.ac.uk/get-data/key-data)
 - Find `<ul class="list">` (there is only one of these tags in the whole source)
 - For every `<li>` section find the first link inside it
 - Grab the text in between the `<a>` and `</a>` tags
 - Side note: We could have used the `<h1>` tag, but then we'd have to deal with removing the &#60;a/&#62; tags inside of it, so it was just easier to go for the text directly.

So now we've got a shiny new list of Impact Case studies using data in the UK Data Service collection. The REF2014 studies are ordered by Unit of Assessment (UOA) numbers. UOA numbers are essentially the subject of study that the publication refers to. For example, an article titled *Knee Injuries In Contact Sports* would likely fall under *UOA 26 - Sport and Exercise Sciences, Leisure and Tourism*.

The API allows us to grab all the articles that fall under each UOA, so we downloaded everything from each Unit of Assessment into its own json file. We wrote a script to run through all 36 UOAs and grab the associated json:

	for i in {1..36}
	do
		wget -O UOA$i.json "http://impact.ref.ac.uk/casestudiesapi/REFAPI.svc/SearchCaseStudies?UoA=$i"
	done

Next on the to-do list was to search through each of the 36 json files (all stored in the same directory) for each of the UK Data Service studies out of the list we created earlier. The best way to do this was to use a search tool built into Unix systems call `ACK`. Here's the script first, we'll go into it in a second:

	declare -a Topics=('1970 British Cohort Study' 'British Household Panel Survey' 'English Longitudinal Study of Ageing' 'Growing Up in Scotland' ... );

	for i in {0..44}
	do
		echo "SEARCHING:" ${Topics[i]}
		ack --ignore-case --files-with-matches --json "${Topics[i]}" ~/dev/public/projects/ref/
	done

So first up we've got a huge array lists each of the UK Data Service studies that we got earlier.

Next we start the `for` loop. For the novice programmers out there, the reason we're using a for loop and not a while loop is because we know the exact number of times that we needed to run the loop through. If we didn't then a while loop would work perfectly. We ran this loop through 45 times, since programming bash counts from (and includes) 0.

Once inside the loop we run a simple `echo` command, just so that we know what's being search for when running the script. 

The next section is where the magic happens. First up we call the `ack` command to inialise the tool, and everything after this point is either a tag, a string, or a directory.

 - `--ignore-case`: does exactly what it says on the tin, it ignores the case of the search term and so will match both upper and lowercase characters.

 - `--files-with-matches`: only print filenames containing matches

 - `--json`: only searches through files with this file extention (.json)

 - `"$s{Topics[I]}"`: searches for this number item in the Topics array we just declared.

 - `~/dev/public/projects/ref/`: searches for .json files in this directory

And that's it! The bash terminal then outputs a big list of all the data in the UK Data Service collection that are referenced or mentioned in any REF2014 Impact Case Study!

	SEARCHING: 1970 British Cohort Study
	/home/john_matthews/dev/public/projects/ref/UOA4 - Psychology, Psychiatry and Neuroscience.json
	SEARCHING: British Household Panel Survey
	/home/john_matthews/dev/public/projects/ref/UOA22 - Social Work and Social Policy.json
	SEARCHING: English Longitudinal Study of Ageing
	SEARCHING: Growing Up in Scotland
	SEARCHING: Longitudinal Study of Young People in England
	SEARCHING: Millennium Cohort Study
	/home/john_matthews/dev/public/projects/ref/UOA4 - Psychology, Psychiatry and Neuroscience.json
	SEARCHING: National Child Development Study
	/home/john_matthews/dev/public/projects/ref/UOA25 - Education.json
	SEARCHING: Understanding Society
	/home/john_matthews/dev/public/projects/ref/UOA4 - Psychology, Psychiatry and Neuroscience.json
	SEARCHING: Annual Population Survey
	SEARCHING: British Social Attitudes

`SEARCHING: 1970 British Cohort Study` tells us that `ACK` is searching for the term *"1970 British Cohort Study"* in each of the json files. The line directly underneath that tells us that `ACK` found the term within the UOA4 json file. If you take a look at the line that reads `SEARCHING: English Longitudinal Study of Ageing` you'll notice that there is no directly listed directly below it. This is because that particular search term was not found in any of the UOA json files.
