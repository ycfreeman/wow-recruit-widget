<?php
/**
 * Plugin Name: WOW Recruitment Widget
 * Plugin URI: http://www.ycfreeman.com/wow-recruitment-widget
 * Description: A widget that helps to display recruitment message of a World of Warcraft guild, also can be used for other games that have different classes.
 * please save the widget once after upgrade from 1.0.x to make it work with new codes,
 * make sure you backup those color codes before upgrade if you have changed them before
 * Version: 1.4.12
 * Author: Freeman Man
 * Author URI: http://www.ycfreeman.com
 */

/**
 * group help and bug report url as well as icons url to top for easier maintainence
 */
define("WR_HELP_URL", "http://ycfreeman.com/wow-recruitment-widget");
define("WR_BUG_URL", "https://github.com/ycfreeman/wow-recruit-widget/issues");

define("WR__FILE__", __FILE__);

define("WR_BUG_ICON_URL", plugins_url("images/ic_bug_report.svg", WR__FILE__));
define("WR_INFO_ICON_URL", plugins_url("images/ic_info_outline.svg", WR__FILE__));

/**
 * Add function to widgets_init that'll load our widget.
 * @since 1.0
 */
add_action('widgets_init', 'wow_recruit_load_widgets');

/**
 * install/uninstall hooks
 * @since 1.2
 */
register_activation_hook(WR__FILE__, 'wow_recruit_widget_install');
register_deactivation_hook(WR__FILE__, 'wow_recruit_widget_uninstall');

include 'inc/hooks.php';
include 'inc/config.php';
include 'inc/widget.php';

if (is_admin()) {
    include 'inc/admin.php';
}
