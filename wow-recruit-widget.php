<?php
/**
 * Plugin Name: WOW Recruitment Widget
 * Plugin URI: http://www.ycfreeman.com/2010/06/wow-recruitment-wordpress-widget-11.html
 * Description: A widget that helps to display recruitment message of a World of Warcraft guild.
 * please save the widget once after upgrade to make it work with new codes, 
 * make sure you backup those color codes before upgrade if you have changed them before
 * Version: 1.1.1
 * Author: Freeman Man
 * Author URI: http://www.ycfreeman.com
 */


/**
 *  Copyright 2010  Freeman_Man  (email : ycfreeman@yahoo.com.hk)
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License, version 3, as
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/**
 * Add function to widgets_init that'll load our widget.
 * @since 1.0
 */
add_action( 'widgets_init', 'wow_recruit_load_widgets' );
wp_enqueue_style('wr_layout','/wp-content/plugins/wow-recruit-widget/css/layout.css');
wp_enqueue_style('wr_color','/wp-content/plugins/wow-recruit-widget/css/color.css');

/**
 * no more multiple array for handling these
 * @since 1.1
 */
static $wr_status = array("Closed","Low","Medium","High");
static $wr_class = array(
    "deathknight"=>"Death Knight",
    "druid"=>"Druid",
    "paladin"=>"Paladin",
    "hunter"=>"Huner",
    "rogue"=>"Rogue",
    "priest"=>"Priest",
    "shaman"=>"Shaman",
    "mage"=>"Mage",
    "warlock"=>"Warlock",
    "warrior"=>"Warrior"
    );
static $wr_max_row = 15;

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 1.0
 */
function wow_recruit_load_widgets() {
    register_widget( 'Wow_Recruit_Widget' );
}

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
	$widget_ops = array( 'classname' => 'wow-recruit', 'description' => __('Displays your guild\'s recruitment status.', 'wow-recruit') );

        /* Widget control settings. */
	$control_ops = array( 'width' => 500, 'height' => 600, 'id_base' => 'wow-recruit-widget' );

	/* Create the widget. */
	$this->WP_Widget( 'wow-recruit-widget', __('WOW Recruitment Widget', 'wow-recruit'), $widget_ops, $control_ops );
    }

    /**
     * How to display the widget on the screen.
     */
    function widget( $args, $instance ) {
	
	global $wr_status;
        global $wr_class;
        global $wr_max_row;

	extract( $args );

        /* Our variables from the widget settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	/* add in a title url*/
	$title_url = $instance['title_url'] ;
	
        
		
	/* Before widget (defined by themes). */
	echo $before_widget;

	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title )
        {
            if ($title_url)
            {
                echo $before_title;
                ?>
                    <a href="<?php echo $title_url; ?>"><?php echo $title; ?> </a>
                    <?php
                    echo $after_title;
            }
            else
            {
                echo $before_title . $title . $after_title;
            }
        }

	//prepare for sorting machanism
	for ($r = 0; $r < $wr_max_row; $r++)
        {
		    ${'wr_row_'.$r.'_class'} = $instance['wr_row_'.$r.'_class'];
            ${'wr_row_'.$r.'_status'} = $instance['wr_row_'.$r.'_status'];
            ${'wr_row_'.$r.'_note'} = $instance['wr_row_'.$r.'_note'];
			
            if (${'wr_row_'.$r.'_status'}>0)
            {
                $wr_data[] = array (
                                    'status'=>${'wr_row_'.$r.'_status'},
                                    'class'=>${'wr_row_'.$r.'_class'},
                                    'note'=>${'wr_row_'.$r.'_note'}
                                    );
            }
        }

        /**
         * corrected sort algorithm
         * @param <type> $a
         * @param <type> $b
         * @return <int>
         * @since 1.1.1
         */
        if (!function_exists('wr_sort'))
        {
            function wr_sort($a, $b) {
                if ($a['status'] == $b['status'])
                {
                    return ($a['class'] == $b['class']) ? 0 : (($a['class'] < $b['class']) ? -1 : 1);
                }
                else if (($a['status'] > $b['status']))
                    return -1;
                else
                    return 1;
            }
        }
                
        //usort($wr_data,'wr_class_sort' );
        if ($wr_data)
        {
            usort($wr_data,'wr_sort' );
        }

/**
 * Frontend Start
 */
?>


<div class="wow-recruit-widget"
    <?php if ($title_url) { ?>
        onclick="location.href='<?php echo $title_url;?>';"
        style="cursor:pointer;"
    <?php }?> >
    <div class="wr-container">

    <?php

        if ($wr_data)
        {
            foreach ($wr_data as $k =>$v)
            {
                $even;
                ?>
                <div class="wr-item wr-<?php echo $even? 'even': 'odd';?>">
                    <div class="wr-left">
                        <img class="wr-icon wr-<?php echo $v['class']?>"
                             src="<?php echo WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))?>img/spacer.gif"
                             alt="" />
                    </div>
                    <div class="wr-right">
                        <div class="wr-class-text wr-<?php echo $v['class']?>">
                            <?php echo $wr_class[$v['class']]?>
                        </div>
                        <div class="wr-status wr-<?php echo $wr_status[$v['status']]?>">
                            <?php echo $wr_status[$v['status']]?>
                        </div>
                        <div class="wr-note">
                            <?php echo $v['note']?>
                        </div>
                    </div>
                </div>


                <?php
                $even = !$even;
            }
        }
		
?>


    </div>
</div>





<?php
/**
 *  Frontend End
 */
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {

            global $wr_max_row;
            global $wr_class;
            /**
             * added simple url validation
             * @since 1.0.1
             */
            function ValidateURL($url)
            {
                return $url ? (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)? $url : 'http://'.$url) : '';
            }


            $instance = $old_instance;

            /* Strip tags for title and title_url to remove HTML (important for text inputs). */
            $instance['title'] = strip_tags( $new_instance['title'] );
            $instance['title_url'] = ValidateURL(strip_tags( $new_instance['title_url'] ));

            /**
             * Discard 1.0 data if present
             * @since 1.1
             */

            foreach ($wr_class as $k=>$v)
            {
                unset($instance[$k.'_status']);
                unset($instance[$k.'_note']);
            }

			//updating $instance
            for ($r = 0; $r < $wr_max_row ; $r++)
            {
                $instance['wr_row_'.$r.'_class'] = $new_instance['wr_row_'.$r.'_class'];
                $instance['wr_row_'.$r.'_status'] = $new_instance['wr_row_'.$r.'_status'];
                $instance['wr_row_'.$r.'_note'] = strip_tags($new_instance['wr_row_'.$r.'_note']);
            }
            

            return $instance;
        }

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
	
            global $wr_status;
            global $wr_class;
            global $wr_max_row;

            /**
             * Convert 1.0 data if present
             * @since 1.1
             */

            $r = 0;
            foreach ($wr_class as $k=>$v)
            {
                if ($instance[$k.'_status']||$instance[$k.'_note'])
                {
                    $instance['wr_row_'.$r.'_class'] = $k;
                    $instance['wr_row_'.$r.'_status'] = $instance[$k.'_status'];
                    $instance['wr_row_'.$r.'_note'] = $instance[$k.'_note'];

                    $r++;
                }
            }
            

            ?>

            <!-- Widget Title: Text Input -->
            <p>
            	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title(optional):', 'hybrid'); ?></label>
		<input type="text" 
                       id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>"
                       value="<?php echo $instance['title']; ?>"
                       style="width:100%;" />
            </p>
		
            <!-- Widget Title Url: Text Input -->
            <p>
            	<label for="<?php echo $this->get_field_id( 'title_url' ); ?>"><?php _e('Recruitment Page URL(optional, if not empty please use full url):', 'wow-recruit'); ?></label>
		<input type="text" 
                       id="<?php echo $this->get_field_id( 'title_url' ); ?>"
                       name="<?php echo $this->get_field_name( 'title_url' ); ?>"
                       value="<?php echo $instance['title_url']; ?>"
                       style="width:100%;" />
            </p>
	<?php
            for ($r = 0; $r < $wr_max_row; $r++)
            {
	?>
            <div>
		<select id="<?php echo $this->get_field_id( 'wr_row_'.$r.'_class' ); ?>"
                        name="<?php echo $this->get_field_name( 'wr_row_'.$r.'_class' ); ?>"
                        style="width:20%;"
                        >
                        <?php
                            foreach ($wr_class as $k => $v)
                            {
                        ?>
                                <option <?php if ($k == $instance['wr_row_'.$r.'_class']) echo 'selected="selected"'; ?>
                                        value="<?php echo $k;?>">
                                        <?php echo $v;?>
                                </option>
                        <?php
                           }
                        ?>

                </select>

                <select id="<?php echo $this->get_field_id( 'wr_row_'.$r.'_status' ); ?>"
                        name="<?php echo $this->get_field_name( 'wr_row_'.$r.'_status' ); ?>"
                        style="width:20%;"
			<?php
                            foreach ($wr_status as $k=>$v)
                            {
                            ?>
                                <option <?php if ( $k == $instance['wr_row_'.$r.'_status']) echo 'selected="selected"'; ?>
                                    value="<?php echo $k?>">
                                    <?php echo $v?>
                                </option>

                            <?php
                            }
			?>
		</select>
		Note:
                <input type="text"
                       id="<?php echo $this->get_field_id( 'wr_row_'.$r.'_note' ); ?>"
                       name="<?php echo $this->get_field_name( 'wr_row_'.$r.'_note' ); ?>"
                       value="<?php echo $instance['wr_row_'.$r.'_note']; ?>"
                       style="width:250px;" />

		</div>
		

		

	<?php
		}


	}
}

?>