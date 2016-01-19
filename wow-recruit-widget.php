<?php
/**
 * Plugin Name: WOW Recruitment Widget
 * Plugin URI: http://www.ycfreeman.com/wow-recruitment-widget
 * Description: A widget that helps to display recruitment message of a World of Warcraft guild, also can be used for other games that have different classes.
 * please save the widget once after upgrade from 1.0.x to make it work with new codes,
 * make sure you backup those color codes before upgrade if you have changed them before
 * Version: 1.4.9
 * Author: Freeman Man
 * Author URI: http://www.ycfreeman.com
 */

/**
 * group help and bug report url as well as icons url to top for easier maintainence
 */
define("WR_HELP_URL", "http://ycfreeman.com/wow-recruitment-widget");
define("WR_BUG_URL", "https://github.com/ycfreeman/wow-recruit-widget/issues");

define("WR_BUG_ICON_URL", plugins_url("images/ic_bug_report.svg", __FILE__));
define("WR_INFO_ICON_URL", plugins_url("images/ic_info_outline.svg", __FILE__));

/**
 * Add function to widgets_init that'll load our widget.
 * @since 1.0
 */
add_action('widgets_init', 'wow_recruit_load_widgets');

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 1.0
 */
function wow_recruit_load_widgets()
{
    register_widget('Wow_Recruit_Widget');
}

/**
 * install/uninstall hooks
 * @since 1.2
 */
register_activation_hook(__FILE__, 'wow_recruit_widget_install');
register_deactivation_hook(__FILE__, 'wow_recruit_widget_uninstall');

if (!function_exists('wow_recruit_widget_install')) {

    function wow_recruit_widget_install()
    {
        $options = array(
            'class0' => 'Death Knight',
            'class1' => 'Druid',
            'class2' => 'Paladin',
            'class3' => 'Hunter',
            'class4' => 'Rogue',
            'class5' => 'Priest',
            'class6' => 'Shaman',
            'class7' => 'Mage',
            'class8' => 'Warlock',
            'class9' => 'Warrior',
            'class10' => 'Monk',
            'class11' => 'Demon Hunter',
            'status0' => 'Closed',
            'status1' => 'Low',
            'status2' => 'Medium',
            'status3' => 'High',
            'custom_style' => false,
            'theme' => false,
            'display_closed' => false,
        );


        add_option('wow_recruit', $options);
    }

}
if (!function_exists('wow_recruit_widget_uninstall')) {

    function wow_recruit_widget_uninstall()
    {
        delete_option('wow_recruit');
    }

}

/**
 * custom class/ status texts
 * @since 1.2
 */
$wr_options = get_option('wow_recruit');

$wr_status = array(
    '0' => $wr_options['status0'],
    '1' => $wr_options['status1'],
    '2' => $wr_options['status2'],
    '3' => $wr_options['status3']
);

$wr_class = array(
    'deathknight' => $wr_options['class0'],
    'druid' => $wr_options['class1'],
    'paladin' => $wr_options['class2'],
    'hunter' => $wr_options['class3'],
    'rogue' => $wr_options['class4'],
    'priest' => $wr_options['class5'],
    'shaman' => $wr_options['class6'],
    'mage' => $wr_options['class7'],
    'warlock' => $wr_options['class8'],
    'warrior' => $wr_options['class9'],
    'monk' => $wr_options['class10'],
    'demonhunter' => $wr_options['class11'],
);


if (!$wr_options['custom_style']) {
    /**
     * added simple theme support
     * @since 1.4.1
     */
    /**
     * set as function to avoid debug message
     * @since 1.4.2
     */

    if (!function_exists('wow_recruit_widget_enqueue_styles')) {
        function wow_recruit_widget_enqueue_styles()
        {
            $wr_options = get_option('wow_recruit');
            wp_enqueue_style('wr_layout', plugins_url('css/style' . (($wr_options['theme'] != '') ? '-' . $wr_options['theme'] : '') . '.css', __FILE__));
        }
    }

    add_action('init', 'wow_recruit_widget_enqueue_styles');
}

/**
 * display/not display closed status
 */

$wr_display_closed = $wr_options['display_closed'];

include_once "inc/classes/widget.php";

if (is_admin()) {
    include_once 'inc/admin.php';
}
