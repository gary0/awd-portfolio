=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: http://anarchywebdev.com/
Tags: custom post type, portfolio
Requires at least: 4.0.1
Tested up to: 4.0
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin creates a 'Portfolio' custom post type, and a Skills taxonomy

== Description ==

This plugin was created using the WordPress Boilerplate for plugins created by Devin Vinson 
"https://github.com/DevinVinson/WordPress-Plugin-Boilerplate"
and an excellent tutorial on custon post types from TeamTreeHouse.com

The plugin started out with some functions in the functions.php of my WordPress theme, and I realised that it should not be tied in with the theme but should be developed as a separate plugin. So I decided to try and do it properly and incorporate the Plugin Boilerplate which has all the basic files and folders required for plugin publishing. The Boilerplate was probably a bit more than I required for a simple plugin but I would like to integrate the i18n. 

Currently the plugin does not use the class in the inc folder but uses functions defined in the awd-portfolio.php page. The awd-portfolio.php page bypasses the class that is used for initialisation, and thus the i18n function.

The plugin creates a 'Portfolio' custom post type, and a Skills taxonomy so that users can add skills (eg CSS, HTML, Hairstyling, Bricklaying or whatever they want).

There are also options for the user to input the 'year', and to set a featured image.

There is an option to use the shortcode to produce a list of Portfolio Items.
Paste [list-posts-portfolio] into any page or post to display the list, or optionally you can create a Portfolio page and the plugin will automatically use the 'archive.php' page to display a list of Porfolio custom post types. 

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `awd-portfolio` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add some skills to the Skills taxonomy in the Portfolio section
4. Create some new Portfolio Items
5. Paste [list-posts-portfolio] into any page or post to display the list

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
