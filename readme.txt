=== WOW Recruitment Widget ===
Contributors: ycfreeman
Donate Link: http://www.ycfreeman.com
Tags: WOW, Warcraft, Guild, World of Warcraft, Recruitment
Requires at least: 2.8
Tested up to: 3.0.1
Stable tag: 1.2.5

A widget that helps to display recruitment message of a World of Warcraft guild.

== Description ==

A widget that helps to display recruitment message of a World of Warcraft guild.
It works just fine out of the box, but it is very customizable with some CSS techniques.
[Customization tutorial can be found here](http://www.ycfreeman.com/2010/08/wow-recruitment-wordpress-widget.html)

* please save the widget once after upgrade from 1.0.x to make it work with new codes, 
* make sure you backup those color codes before upgrade if you have changed them before

**New Features in 1.2:**

* option to use custom style sheet!
* fully customizable class / status texts! *(yea I don't have much time to hard code multilingual support, so now you can do it all yourself :p)*
* customizable number of rows!
* added in recruitment message
* added in a google ad to widget settings for my own good, lol, you can delete that line of code if you really don't like it.

To use this widget, simply go to Appearance => Widget and drag it to a sidebar as similar to other widgets.

[Full description on the web page of this plugin](http://www.ycfreeman.com/p/wow-recruitment-wordpress-widget.html)

If you managed to find bugs or want to correct some of my codes, please don't hesitate to leave a comment :)



== Installation ==

1. Unpack and Upload all files to the `/wp-content/plugins/wow-recruit-widget` directory
2. Activate the plugin through the **Plugins** menu in WordPress
3. Drag **WOW Recruitment Widget** to your sidebar
4. Enter details and done!
5. *(optional)* go to **Settings > WOW Recruit Widget** to set up all classes and status texts to your own language

== Frequently Asked Questions ==

[Full description on the web page of this plugin](http://www.ycfreeman.com/p/wow-recruitment-wordpress-widget.html)

== Screenshots ==

1. Here is how it looks (background is from my website, so it may not look exactly same on yours)

== Changelog ==
= 1.2.5 =
* there was some subversion mess up for previous 2 updates, I've recovered everything and this update should work properly

= 1.2.4 =
* fixed another issue about new generated wr-note class name, and a default style bug, also updated readme file
* removed google ad (sorry I was doing it wrong!)
* added a "help" icon that links to this plugin's new home page

= 1.2.3 =
* fixed a very minor potential issue about new generated wr-note class name, and a minor default style bug

= 1.2.2 =
* fixed another layout bug

= 1.2.1 =
* fixed a layout bug

= 1.2.0 =
* major update with new options panel
* option to use custom style sheet! and it is recombined back to one css
* fully customizable class / status texts!
* customizable number of rows!
* added in recruitment message

= 1.1.4 =
* fixed a few missed semi-colons, and missing close tags, which may cause bug in certain browsers

= 1.1.3 =
* fixed a layout bug that may cause by css float

= 1.1.2 =
* fixed a typing mistake "Huner", lol

= 1.1.1 =
* fixed a few non-set variable and duplicate function declaration bug
* fixed sorting mechanism, it should sort by status from high to low, then by class in alphabetical order, tell me if there is still bug

= 1.1 =
* major recode to everything including data structure
* no more table layout, all replaced by div, which can be easily customized by editing css/layout.css
* color and layout are seperated into css/layout.css and css/color.css
* class icons are combined into css sprite
* new sorting method used, it should sort by status then class as intended now

= 1.0.1 = 
* minor changes to path handling, added some simple URL validation, and some descriptions in widget

= 1.0 =
* First released version


== Upgrade Notice ==
* please save the widget once after upgrade from 1.0.x to make it work with new codes, 
* make sure you backup those color codes before upgrade if you have changed them before