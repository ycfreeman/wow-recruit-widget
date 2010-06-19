=== WOW Recruitment Widget ===
Contributors: ycfreeman
Donate Link: http://www.ycfreeman.com
Tags: WOW, Warcraft, Guild, World of Warcraft, Recruitment
Requires at least: 2.8
Tested up to: 3.0
Stable tag: 1.1.2

A widget that helps to display recruitment message of a World of Warcraft guild.

== Description ==

A widget that helps to display recruitment message of a World of Warcraft guild.

There is not much WOW guild related plugins for wordpress out there, so I write my own for my guild website project :)


* please save the widget once after upgrade to make it work with new codes, 
* make sure you backup those color codes before upgrade if you have changed them before

New Features in 1.1:

* now it is possible to make multiple entries for same class
* no more old school table layout, all are recoded with css2 (works on IE8 as well)
* since there is no more layout codes in the widget itself, custom layout can be done just by editing the css
* color and layout are seperated into 2 css files
* data structure is changed, old data will be changed to new structure automatically
* class icons are combined into css sprite
* new sorting method used, it should sort by status then class as intended now.
* row order in widget settings page does not affect order that displays in front, it will just automatically sorts by status then class, I will improve this in later version

To use this widget, simply go to Appearance => Widget and drag it to a sidebar as similar to other widgets.

Full description on the blog entry of this plugin:

http://www.ycfreeman.com/2010/06/wow-recruitment-wordpress-widget-11.html

If you managed to find bugs or want to correct some of my codes, please don't hesitate to leave a comment :)



== Installation ==

1. Unpack and Upload all files to the `/wp-content/plugins/wow-recruit-widget` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Drag 'WOW Recruitment Widget' to your sidebar
4. Enter details and done!

== Frequently Asked Questions ==

= These color/font/size does not match my template, can I change them? =

Yes, just edit layout.css

= I don't want the icon class note to layout like that, can I change it? =

Yes, all layouts are done with css, please refer to http://www.ycfreeman.com/2010/06/wow-recruitment-wordpress-widget-11.html for some useful links and examples

= Can I sort recruitment messages in another way? =

Unfortunately no, please leave me a comment if you want this feature :).

== Screenshots ==

1. Here is how it looks (background is from my website, so it may not look exactly same on yours)
2. Widget Settings

== Changelog ==

= 1.0 =
* First released version

= 1.0.1 = 
* minor changes to path handling, added some simple URL validation, and some descriptions in widget

= 1.1 =
* major recode to everything including data structure
* no more table layout, all replaced by div, which can be easily customized by editing css/layout.css
* color and layout are seperated into css/layout.css and css/color.css
* class icons are combined into css sprite
* new sorting method used, it should sort by status then class as intended now

= 1.1.1 =
* fixed a few non-set variable and duplicate function declaration bug
* fixed sorting mechanism, it should sort by status from high to low, then by class in alphabetical order, tell me if there is still bug

= 1.1.2 =
* fixed a typing mistake "Huner", lol

== Upgrade Notice ==
* please save the widget once after upgrade to make it work with new codes, 
* make sure you backup those color codes before upgrade if you have changed them before