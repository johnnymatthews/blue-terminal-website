# Customising DKAN's Global Search Bar

## The Bar

In DKAN there's a function that you can call within your theme to show a search bar. This search bar utilizes DKANs global search functions and returns results from all over your instance. As powerful as this search bar is, it's kinda tricky to customise it.

We you first implement the search bar it looks something like this

!(Default Search Bar)[default-search-bar.png]

It's not terrible by anymeans, at least it follows the guidance from the current theme. But it's kinda clunky. For one, the **submit** button reads **fl** for some reason. Also, the placeholder text isn't capitalised. And I don't really like the **Search** title above the bar. Finally, I'd like the search bar and submit button to be on the same line, makes things just look a bit more tidy.

---

## The Code

To implement the global search bar in your theme, all you need to do is include this little snippet:

	<?php
		$block = block_load('dkan_sitewide', 'dkan_sitewide_search_bar');
        if($block):
	        $search = _block_get_renderable_array(_block_render_blocks(array($block)));
	        print render($search);
        endif;
	?>

Dead easy. The only thing is that this doesn't give us a lot of room to customise things. In fact, this snippet doesn't give us *any* room to customise things. But that's ok, nothing that a little exploratory code digging can't fix.

---

## The Hunt

At this point I'm looking for where the code for the search *block* is generated.

The 2nd line of the snippet above mentions a `block_load` function. According to the [Drupal API](https://api.drupal.org/api/drupal/modules!block!block.module/function/block_load/7.x) `block_load` returns the first block matching the `module` and `delta` parameters, where `$module` equals the name of the module that implements the block to load, and `$delta` is the unique ID of the block. That's fairly straight forward I think.

The thing that interests me the most our `block_load` call is the `$module` variable that we pass though, `dkan_sitewide`. Since we're looking for a module, it makes sense to start digging into the various module sections within DKAN.

Custom modules are stored in `sites/all/modules`, but it wouldn't make sense for the global search module to be in there, since this is clearly a module that other root sections of DKAN rely on. DKAN places *some* default modules in `modules/`, but a search through all the folders in there doesn't yeild any results. 

Finally, after about half an hour of searching through the [DKAN docs](http://dkan.readthedocs.io/en/stable/) I found what I was looking for. Some inbuilt modules that DKAN heavily relies on can be found in `profiles/dkan/modules/dkan/dkan_sitewide`. Pretty deep down in the directories, and not very well documented, but I found it none the less.

I started out with looking in `dkan_sitewide.blocks.inc` since it was the first file in the directory. A quick `ctrl+f` for `search` returns 26 results, which put me in quite a positive mood. *Hopefully what I'm looking for is in this file.* The first result returned this chunk:

    $blocks['dkan_sitewide_search_bar'] = array(
        'info' => t('Search'),
        'cache' => DRUPAL_CACHE_GLOBAL,
    );

Great! Sitewide search is exactly what I'm looking for! Changing my `ctrl+f` to `dkan_sitewide_search_bar` lead me to a case statement with `dkan_sitewide_search_bar` as the case and a call to `dkan_sitewide_search_bar()` be implemented. I bounced down a couple of times to find this function:

	function dkan_sitewide_search_bar() {
	  if (module_exists('dkan_sitewide_search_db')) {
		$output = drupal_get_form('dkan_sitewide_dataset_search_form');
		return drupal_render($output);
	  }
	}

By this point I'm getting pretty disy. The process of printing a simple search bar onto the front page is quite extensive, but none the less I solidered on. I looked like the function `dkan_sitewide_search_bar()` ends up calling *another* function called `dkan_sitewide_dataset_search_form()` which just so happens to be directly below this function. Lovely.

Finally I'm at the place where I need to be! The function that actually creates the form:

	function dkan_sitewide_dataset_search_form($form, $form_state) {
	    $form['search'] = array(
		  '#type' => 'textfield',
		  // Add field label for 508 compliance.
		  '#title' => 'Search',
		  '#attributes' => array('placeholder' => t('search')),
		  '#size' => 30,
	    );
	    $form['submit'] = array(
		  '#type' => 'submit',
		  '#value' => t('Apply'),
		  // Use fontawesome icon instead.
		  '#value' => decode_entities('&#xf002;'),
	    );
	    return $form;
	}

Straight off the bat I can see why my search bar is showing **fl** in the submit button. There's a call to a fontawesome icon being made, which I don't have enabled in my theme. But that's no problem, I can just take that out and change the default value to **Search**:

	'#value' => t('Apply'),
	// Use fontawesome icon instead.
    // '#value' => decode_entities('&#xf002;'),

I've commented out the un-used lines above so you can see what I'm not using, in my actual code I deleted the un-used lines.

That makes things a bit better. For some reason the submit button is now blue, not sure why, but I'm not too fussed. It'll do for now.

![Blue Search Button](blue-search-button.png)

Next up is to remove that **Search** title. That's a simple fix, just commented out / delete the `'#title' line. And to capitalise the placeholder we just needed to change on line to `'placeholder' => t('Search'),`

![Search Bar with no Title](no-title.png)

Excellent! We're getting closer. Finally all that's left to do is get the search bar and the submit button on the same line. Should be easy enough, just need to add the [Bootstrap](http://getbootstrap.com/css/#helper-classes-floats) `pull-right` class to the submit button and a `pull-left` to the search bar, right?

Yeah, no.

I started off by adding `'class' => t('pull-left')` to the `#attributes' array with the `search` array:

	'#attributes' => array(
        'placeholder' => t('search'),
        'class' => t('pull-left'),
    ),

Unfortunately this returned a lovely operator error from DKAN: `Error: [] operator not supported for strings in bootstrap_pre_render() (line 51 of /vagrant/sites/all/themes/bootstrap/includes/pre-render.inc).`

Ok, so maybe classes go outside of the attributes section. I tried adding the class line above into it's own array item inside the `search` array:

    $form['search'] = array(
        '#type' => 'textfield',
        // Add field label for 508 compliance.
        // '#title' => 'Search',
        '#attributes' => array(
            'placeholder' => t('search'),
        ),
        '#size' => 30,
        '#class' => t('pull-left'),
    );

This time there weren't any errors, which is great! But there also weren't any classes added onto the form. A quick *inspect* of the front-end code once it had rendered shows that the new class wasn't actually added:

	<input placeholder="search" class="form-control form-text" type="text" id="edit-search" name="search" value="" size="30" maxlength="128">

So the question becomes *how to add a class to the form*. Shouldn't be too hard right? Well it actually does seem rather tricky. There's not a huge amount of documentation on the subject. However I did find out that adding inline styles is pretty simple:

	'#attributes' => array(
        'placeholder' => t('Search'),
        'style' => t('color: red;'),
    ),

If all else fails I could just hard-code in some horrible inline-styles to fix everything. But for now I'm going to try to keep adding those `pull-left` and `pull-right` classes.

After playing around in the Google Inspector for a little while I've found out that adding `#'size' => 50,` to the `search` array helps organise everything. All that I need to do is find a way to add the `pull-left` class to the search field, no need to add anything to the submit button.

Turns out I do need to add the class into the `#attributes` sub array within the `search` array. However it must be within it's own array!

	$form['search'] = array(
		'#type' => 'textfield',
		// Add field label for 508 compliance.
		// '#title' => 'Search',
		'#attributes' => array(
		    'placeholder' => t('Search'),
		    'class' => array(
		        'pull-left',
		    ),
		),
		'#size' => 50,
	);

This adds the `pull-left` class into the `<input` tag on the front-end html.

	<input placeholder="Search" class="pull-left form-control form-text" type="text" id="edit-search" name="search" value="" size="50" maxlength="128">

Anoying though, I think I need to add the `pull-left` class into the surrounding `div`. Which means I need to find where *that* `div` is created. *Drupal is anything **but* simple*.

Putting a `dump and die` (also known as `print_r($output); die;`) just before $output is returned from `dkan_sitewide_search_bar() gives us a *ruddy huge* array, 335 lines to be precise.

The start of the array has two sub arrays, `search` and `submit`. I'm guessing they're connected to the search bar and submit buttons on the front end. Maybe there's something in here that I can edit to add another class to the outside div?

It looks like I need to override `dkan_sitewide_dataset_search_form()` somehow, but I don't know how to do so. If I don't then every time I update DKAN all this work will be lost and I'll have to manually customise the array.




