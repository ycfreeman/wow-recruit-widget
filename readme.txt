=== WOW Recruitment Widget ===
Contributors: ycfreeman
Donate Link: http://www.ycfreeman.com
Tags: WOW, Warcraft, Guild, World of Warcraft, Recruitment
Requires at least: 2.8
Tested up to: 3.3.1
Stable tag: 1.4.1

A widget that helps to display recruitment message of a World of Warcraft guild, also can be used for other games that have different classes.

== Description ==

A widget that helps to display recruitment message of a World of Warcraft guild.
It works just fine out of the box, but it is very customizable with some CSS techniques.
[Customization tutorial can be found here](http://www.ycfreeman.com/2010/08/wow-recruitment-wordpress-widget.html)

* please save the widget once after upgrade from 1.0.x to make it work with new codes, 
* make sure you backup those color codes before upgrade if you have changed them before 1.2

New in 1.4.1:

* due to popular demand (there are still many themes out there have very narrow side bar that the new bigger icon doesn't fit) simple theme support is added,
simply go to Settings > WOW Recruit Widget, under Theme, choose "For Narrow Sidebars"

New Features in 1.4:

* added monk class
* slightly larger icons
* few updates to default stylesheet, now uses float instead of absolute position, also with icon chrome in css3
* minor change to markup to accompany the stylesheet changes
* added item width to widget, you can use !important in your stylesheet to override it


** if "Monk" is not appearing on the list, go to Settings -> WOW Recruit Widget, check if "Monk" is there and do a "Save Changes"

** *This will be the last major update of version 1.x, next update will be version 2 and will feature major recode, please check 
[my website](http://www.ycfreeman.com) for updates.*

To use this widget, simply go to Appearance => Widget and drag it to a sidebar as similar to other widgets.


[Demo](http://wrdemo.ycfreeman.com/)
[Full description on the web page of this plugin](http://www.ycfreeman.com/wow-recruitment-widget)
[For bugs please leave a comment](http://www.ycfreeman.com/wow-recruitment-widget)


If you managed to find bugs or want to correct some of my codes, please don't hesitate to leave a comment :)



== Installation ==

1. Unpack and Upload all files to the `/wp-content/plugins/wow-recruit-widget` directory
2. Activate the plugin through the **Plugins** menu in WordPress
3. Drag **WOW Recruitment Widget** to your sidebar
4. Enter details and done!
5. *(optional)* go to **Settings > WOW Recruit Widget** to set up all classes and status texts to your own language
6. *(optional)* if you're using a theme with narrow sidebar, go to **Settings > WOW Recruit Widget** and choose "For Narrow Sidebars" under "Theme"

== Frequently Asked Questions ==

[Full description on the web page of this plugin](http://www.ycfreeman.com/p/wow-recruitment-wordpress-widget.html)

== Screenshots ==

1. Here is how it looks (background is from my website, so it may not look exactly same on yours)

== Changelog ==

= 1.4.1 =
* added theme for narrow sidebar themes

= 1.4.0 =
* added monk class
* larger icons
* few updates to stylesheet, now uses float instead of absolute position, also with icon chrome in css3
* moved div.wr-status to middle of div.wr-class-text and div.wr-note to accompany new stylesheet
* added item width to widget(.wr-item), you can use !important in your stylesheet to override it

= 1.3.2 =
* changed bug report link and readme file

= 1.3.1 =
* changed help/bug icons to host at external source, updated license wordings

= 1.3.0 =
* customizable tooltip!
* ability to enable display of "closed" status!
* bug report icon!
* added note and status css classes to each item wrapper, now it is even more customizable with proper css techniques

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
* fixed a lovely IE only bug caused a few missed semi-colons, and missing close tags, which may cause bug in certain browsers, thanks KGBAgent again

= 1.1.3 =
* fixed a layout bug that may cause by css float

= 1.1.2 =
* fixed a typing mistake "Huner", lol, thanks KGBAgent

= 1.1.1 =
* fixed a few non-set variable and duplicate function declaration bug, thanks Ramides
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