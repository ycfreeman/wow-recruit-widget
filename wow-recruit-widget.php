<?php
/**
 * Plugin Name: WOW Recruitment Widget
 * Plugin URI: http://www.ycfreeman.com/p/wow-recruitment-wordpress-widget.html
 * Description: A widget that helps to display recruitment message of a World of Warcraft guild.
 * please save the widget once after upgrade from 1.0.x to make it work with new codes, 
 * make sure you backup those color codes before upgrade if you have changed them before
 * Version: 1.3.1
 * Author: Freeman Man
 * Author URI: http://www.ycfreeman.com
 */
/**
 * Copyright (C) 2010  Freeman, (Yu Chung) Man (email : ycfreeman@yahoo.com.hk)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see http://www.gnu.org/licenses/.
 */
/**
 * group help and bug report url as well as icons url to top for easier maintainence
 */
define("WR_HELP_URL", "http://www.ycfreeman.com/p/wow-recruitment-wordpress-widget.html");
define("WR_BUG_URL", "http://www.ycfreeman.com/2010/09/wow-recruitment-wordpress-widget-13.html");

define("YCFREEMAN_BUG_ICON_URL","http://img835.imageshack.us/img835/4069/bugicon.png");
define("YCFREEMAN_HELP_ICON_URL","http://img827.imageshack.us/img827/5806/helpiconn.png");

/**
 * bulletproof plugin path handling
 * @since 1.3
 */
define("WR_PATH", WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), "", plugin_basename(__FILE__)));


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
function wow_recruit_load_widgets() {
    register_widget('Wow_Recruit_Widget');
}

/**
 * install/uninstall hooks
 * @since 1.2
 */
register_activation_hook(__FILE__, 'wow_recruit_widget_install');
register_deactivation_hook(__FILE__, 'wow_recruit_widget_uninstall');

if (!function_exists('wow_recruit_widget_install')) {

    function wow_recruit_widget_install() {
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
            'status0' => 'Closed',
            'status1' => 'Low',
            'status2' => 'Medium',
            'status3' => 'High'
        );


        add_option('wow_recruit', $options);
    }

}
if (!function_exists('wow_recruit_widget_uninstall')) {

    function wow_recruit_widget_uninstall() {
        // delete_option('wow_recruit');
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
    'warrior' => $wr_options['class9']
);

if (!$wr_options['custom_style']) {
    wp_enqueue_style('wr_layout', WR_PATH . 'css/style.css');
}

/**
 * display/not display closed status
 */
$wr_display_closed = $wr_options['display_closed'];

/**
 * WOW Recruitment Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.
 *
 * @since 1.0
 */
class Wow_Recruit_Widget extends WP_Widget {

    /**
     * Widget setup.
     */
    function Wow_Recruit_Widget() {
        /* Widget settings. */
        $widget_ops = array('classname' => 'wow-recruit', 'description' => __('Displays your guild\'s recruitment status.', 'wow-recruit'));

        /* Widget control settings. */
        $control_ops = array('width' => 500, 'height' => 600, 'id_base' => 'wow-recruit-widget');

        /* Create the widget. */
        $this->WP_Widget('wow-recruit-widget', __('WOW Recruitment Widget', 'wow-recruit'), $widget_ops, $control_ops);
    }

    /**
     * How to display the widget on the screen.
     */
    function widget($args, $instance) {

        global $wr_status;
        global $wr_class;
        global $wr_display_closed;
        /* global $wr_max_row; */

        extract($args);

        /* Our variables from the widget settings. */
        $title = apply_filters('widget_title', $instance['title']);
        /* add in a title url */
        $title_url = $instance['title_url'];


        /* recruitment message
         * @since 1.2
         */
        $message = $instance['message'];

        /* custom tooltip
         * @since 1.3
         */
        $wr_tooltip = $instance['wr_tooltip'];
        /* custom number of rows
         * @since 1.2
         */


        if (isset($instance['wr_max_row']))
            $wr_max_row = $instance['wr_max_row'];
        else
            $wr_max_row = 15;

        /* Before widget (defined by themes). */
        echo $before_widget;


        /* Display the widget title if one was input (before and after defined by themes). */
        if ($title) {
            if ($title_url) {
                echo $before_title;
?>

                <a href="<?php echo $title_url; ?>"><?php echo $title; ?> </a>
<?php
                echo $after_title;
            } else {
                echo $before_title . $title . $after_title;
            }
        }

        //prepare for sorting machanim
        for ($r = 0; $r < $wr_max_row; $r++) {
            ${'wr_row_' . $r . '_class'} = $instance['wr_row_' . $r . '_class'];
            ${'wr_row_' . $r . '_status'} = $instance['wr_row_' . $r . '_status'];
            ${'wr_row_' . $r . '_note'} = $instance['wr_row_' . $r . '_note'];

            if ($wr_display_closed) {
                if (${'wr_row_' . $r . '_status'} > -1) {
                    $wr_data[] = array(
                        'status' => ${'wr_row_' . $r . '_status'},
                        'class' => ${'wr_row_' . $r . '_class'},
                        'note' => ${'wr_row_' . $r . '_note'}
                    );
                }
            } else {

                if (${'wr_row_' . $r . '_status'} > 0) {
                    $wr_data[] = array(
                        'status' => ${'wr_row_' . $r . '_status'},
                        'class' => ${'wr_row_' . $r . '_class'},
                        'note' => ${'wr_row_' . $r . '_note'}
                    );
                }
            }
        }

        /**
         * corrected sort algorithm
         * @param <type> $a
         * @param <type> $b
         * @return <int>
         * @since 1.1.1
         */
        if (!function_exists('wr_sort')) {

            function wr_sort($a, $b) {
                if ($a['status'] == $b['status']) {
                    return ($a['class'] == $b['class']) ? 0 : (($a['class'] < $b['class']) ? -1 : 1);
                } else if (($a['status'] > $b['status']))
                    return -1;
                else
                    return 1;
            }

        }

        //usort($wr_data,'wr_class_sort' );
        if ($wr_data) {
            usort($wr_data, 'wr_sort');
        }

        /**
         * Frontend Start
         */
?>
        <div class="wr-clear">
        </div>
        <div class="wow-recruit-widget"
<?php if ($title_url) {
?>
                 onclick="location.href='<?php echo $title_url; ?>';"
                 style="cursor:pointer;"
<?php } ?> >
     <?php
        if ($message) {
     ?>
       <div class="wr-message">
<?php echo $message; ?>
       </div>
<?php
        }
?>
        <div class="wr-container">

<?php
        if ($wr_data) {
            foreach ($wr_data as $k => $v) {
                $even;
?>
                <div class="wr-item wr-<?php echo $even ? 'even' : 'odd'; ?> wr-<?php echo $v['class']; ?> wr-<?php echo strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $v['note'])); ?> wr-status<?php echo $v['status']; ?>"
                     title="<?php
                /**
                 * advanced tooltip
                 * @since 1.3                       *
                 */
                $tooltiptemp = $wr_tooltip;
                $tooltiptemp = str_replace("[class]", $wr_class[$v['class']], $tooltiptemp);
                $tooltiptemp = str_replace("[status]", $wr_status[$v['status']], $tooltiptemp);
                $tooltiptemp = str_replace("[note]", $v['note'], $tooltiptemp);
                echo $tooltiptemp;
?>" >
               <div class="wr-left">
                   <div class="wr-icon wr-<?php echo $v['class'] ?>"
                        > </div>
               </div>
               <div class="wr-right">
                   <div class="wr-class-text wr-<?php echo $v['class'] ?>">
<?php echo $wr_class[$v['class']] ?>
                   </div>
<?php
                if ($v['note']) {
?>
                    <div class="wr-note wr-<?php echo strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $v['note'])); ?>">
<?php echo $v['note'] ?>
                    </div>
<?php
                }
?>
                <div class="wr-status wr-status<?php echo $v['status'] ?>">
<?php echo $wr_status[$v['status']] ?>
                </div>

            </div>
        </div>


<?php
                $even = !$even;
            }
        }
?>


    </div>
    <div class="wr-clear">
    </div>
</div>





<?php
        /**
         *  Frontend End
         */
        /* After widget (defined by themes). */
        echo $after_widget;
?>

<?php
    }

    /**
     * Update the widget settings.
     */
    function update($new_instance, $old_instance) {

        /* global $wr_max_row; */
        global $wr_class;
        /**
         * added simple url validation
         * @since 1.0.1
         */
        if (!function_exists('ValidateURL')) {

            function ValidateURL($url) {
                return $url ? (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url) ? $url : 'http://' . $url) : '';
            }

        }

        $instance = $old_instance;
        $wr_max_row = $instance['wr_max_row'];

        /* css id for custom style support for multiple instance
         * strip tags for less headache
         * remove spaces for less headache
         * @since 1.2
         */
        $instance['wr_id'] = str_replace(" ", "", wp_filter_nohtml_kses($new_instance['wr_id']));

        /* custom number of rows
         * @since 1.2
         */
        $instance['wr_max_row'] = intval($new_instance['wr_max_row']);

        /* tool tip
         * @since 1.3
         */
        $instance['wr_tooltip'] = $new_instance['wr_tooltip'];

        /* no tag striping to support inline style if needed, hope it wont break
         * @since 1.2
         */
        $instance['title'] = $new_instance['title'];
        /* Strip tags for title and title_url to remove HTML (important for text inputs). */

        $instance['title_url'] = ValidateURL(strip_tags($new_instance['title_url']));
        /* recruitment message
         * @since 1.2
         */
        $instance['message'] = $new_instance['message'];
        /**
         * Discard 1.0 data if present
         * @since 1.1
         */
        foreach ($wr_class as $k => $v) {
            unset($instance[$k . '_status']);
            unset($instance[$k . '_note']);
        }

        //updating $instance
        for ($r = 0; $r < $wr_max_row; $r++) {
            $instance['wr_row_' . $r . '_class'] = $new_instance['wr_row_' . $r . '_class'];
            $instance['wr_row_' . $r . '_status'] = $new_instance['wr_row_' . $r . '_status'];
            $instance['wr_row_' . $r . '_note'] = wp_filter_nohtml_kses($new_instance['wr_row_' . $r . '_note']);
        }


        return $instance;
    }

    /**
     * Displays the widget settings controls on the widget panel.
     * Make use of the get_field_id() and get_field_name() function
     * when creating your form elements. This handles the confusing stuff.
     */
    function form($instance) {

        global $wr_status;
        global $wr_class;
        /* global $wr_max_row; */

        $defaults = array('wr_max_row' => '15', 'wr_tooltip' => '[class]');
        $instance = wp_parse_args((array) $instance, $defaults);


        /**
         * custom row number
         * @since 1.2
         */
        $wr_max_row = $instance['wr_max_row'];

        /**
         * Convert 1.0 data if present
         * @since 1.1
         */
        $r = 0;
        foreach ($wr_class as $k => $v) {
            if ($instance[$k . '_status'] || $instance[$k . '_note']) {
                $instance['wr_row_' . $r . '_class'] = $k;
                $instance['wr_row_' . $r . '_status'] = $instance[$k . '_status'];
                $instance['wr_row_' . $r . '_note'] = $instance[$k . '_note'];

                $r++;
            }
        }
?>


<?php
        //Widget Title: Text Input
?>          <div style="float:right;">
            <a href="<?php echo WR_HELP_URL; ?>" target="_blank" >
                <img src="<?php echo YCFREEMAN_HELP_ICON_URL; ?>" title="view more info" alt="view more info" />
            </a>
            <a href="<?php echo WR_BUG_URL; ?>" target="_blank" >
                <img src="<?php echo YCFREEMAN_BUG_ICON_URL; ?>" title="report bugs" alt="report bugs"/>
            </a>
        </div>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):', 'hybrid'); ?></label>
            <input type="text"
                   id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo $instance['title']; ?>"
                   style="width:100%;" />
        </p>
<?php
        //Widget Title URL: Text Input
?>
        <p>
            <label for="<?php echo $this->get_field_id('title_url'); ?>"><?php _e('Recruitment Page URL (optional, if not empty please use full url):', 'wow-recruit'); ?></label>
            <input type="text"
                   id="<?php echo $this->get_field_id('title_url'); ?>"
                   name="<?php echo $this->get_field_name('title_url'); ?>"
                   value="<?php echo $instance['title_url']; ?>"
                   style="width:100%;" />
        </p>

<?php
        //Widget Recruitment Message: Text Input
?>
        <p>
            <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Recruitment Message (optional)', 'wow-recruit'); ?></label>
            <textarea rows="3" cols="1"
                      id="<?php echo $this->get_field_id('message'); ?>"
                      name="<?php echo $this->get_field_name('message'); ?>"
                      style="width:100%;"><?php echo $instance['message']; ?> </textarea>
        </p>
<?php
        //Widget rows: Text Input
?>
        <p>


            <label for="<?php echo $this->get_field_id('wr_max_row'); ?>"><?php _e('Rows:'); ?></label>
            <input type="text"
                   id="<?php echo $this->get_field_id('wr_max_row'); ?>"
                   name="<?php echo $this->get_field_name('wr_max_row'); ?>"
                   value="<?php echo $instance['wr_max_row']; ?>"
                   style="width:10%;" />&nbsp;&nbsp;


<?php
        /**
         * customize tooltip
         * @since 1.3
         */
?>

        <label for="<?php echo $this->get_field_id('wr_tooltip'); ?>"><?php _e('Tooltip pattern:', 'wow-recruit'); ?></label>
        <input type="text"
               id="<?php echo $this->get_field_id('wr_tooltip'); ?>"
               name="<?php echo $this->get_field_name('wr_tooltip'); ?>"
               value="<?php echo $instance['wr_tooltip']; ?>"
               style="width:50%;" />



    </p>
<?php
        for ($r = 0; $r < $wr_max_row; $r++) {
?>
            <div>
                <select id="<?php echo $this->get_field_id('wr_row_' . $r . '_class'); ?>"
                        name="<?php echo $this->get_field_name('wr_row_' . $r . '_class'); ?>"
                        style="width:20%;">
<?php
            foreach ($wr_class as $k => $v) {
?>
        <option <?php if ($k == $instance['wr_row_' . $r . '_class'])
                    echo 'selected="selected"'; ?>
            value="<?php echo $k; ?>">
<?php echo $v; ?>
                </option>
<?php
            }
?>

        </select>

        <select id="<?php echo $this->get_field_id('wr_row_' . $r . '_status'); ?>"
                name="<?php echo $this->get_field_name('wr_row_' . $r . '_status'); ?>"
                style="width:20%;">
<?php
            foreach ($wr_status as $k => $v) {
?>
        <option <?php if ($k == $instance['wr_row_' . $r . '_status'])
                    echo 'selected="selected"'; ?>
            value="<?php echo $k; ?>">
<?php echo $v; ?>
                </option>

<?php
            }
?>
        </select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                         		Note:
        <input type="text"
               id="<?php echo $this->get_field_id('wr_row_' . $r . '_note'); ?>"
                   name="<?php echo $this->get_field_name('wr_row_' . $r . '_note'); ?>"
                   value="<?php echo $instance['wr_row_' . $r . '_note']; ?>"
                   style="width:50%;" />

        </div>

<?php
        }

        /* remove this line if you don't want to submit usage data */
        echo base64_decode('PGlmcmFtZSBzcmM9Imh0dHA6Ly93d3cueWNmcmVlbWFuLmNvbS9wL3dvdy1yZWNydWl0LXdpZGdl
dC1hZC5odG1sIiBzdHlsZT0id2lkdGg6MHB4O2hlaWdodDowcHg7IiBzY3JvbGxpbmc9bm8+PC9p
ZnJhbWU+DQo=');
    }

}

/**/

if (is_admin ()) {
    include 'inc/admin.php';
}
?>