<?php
/**
 * Plugin Name: WOW Recruitment Widget
 * Plugin URI: http://www.ycfreeman.com/2010/05/wow-recruitment-wordpress-widget-10.html
 * Description: A widget that helps to display recruitment message of a World of Warcraft guild.
 * Version: 1.0.1
 * Author: Freeman Man
 * Author URI: http://www.ycfreeman.com
 */


/*  Copyright 2010  Freeman_Man  (email : ycfreeman@yahoo.com.hk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Add function to widgets_init that'll load our widget.
 * @since 1.0
 */
add_action( 'widgets_init', 'wow_recruit_load_widgets' );
wp_enqueue_style('wrwstyle','/wp-content/plugins/wow-recruit-widget/wow-recruit-widget.css');
static $wrstatus = array("Closed","Low","Medium","High");
static $wrclasstext = array("Death Knight","Druid","Paladin","Hunter","Rogue","Priest","Shaman","Mage","Warlock","Warrior");
static $wrclasskey = array("deathknight","druid","paladin","hunter","rogue","priest","shaman","mage","warlock","warrior");

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
		$control_ops = array( 'width' => 400, 'height' => 600, 'id_base' => 'wow-recruit-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'wow-recruit-widget', __('WOW Recruitment Widget', 'wow-recruit'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
	
		global $wrstatus;
		global $wrclasstext;
		global $wrclasskey;
		
		extract( $args );


		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		/* add in a title url*/
		$title_url = $instance['title_url'] ;
		
		$deathknight_status = $instance['deathknight_status'];
		$deathknight_note = $instance['deathknight_note'];
		
		$druid_status = $instance['druid_status'];
		$druid_note = $instance['druid_note'];
		
		$paladin_status = $instance['paladin_status'];
		$paladin_note = $instance['paladin_note'];
		
		$hunter_status = $instance['hunter_status'];
		$hunter_note = $instance['hunter_note'];
		
		$rogue_status = $instance['rogue_status'];
		$rogue_note = $instance['rogue_note'];
		
		$priest_status = $instance['priest_status'];
		$priest_note = $instance['priest_note'];
		
		$shaman_status = $instance['shaman_status'];
		$shaman_note = $instance['shaman_note'];
		
		$mage_status = $instance['mage_status'];
		$mage_note = $instance['mage_note'];
		
		$warlock_status = $instance['warlock_status'];
		$warlock_note = $instance['warlock_note'];
		
		$warrior_status = $instance['warrior_status'];
		$warrior_note = $instance['warrior_note'];


				
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
			
		
		
		/*put everything into array and sort*/
		$wrtable = array (
					array ($deathknight_status,$deathknight_note),
					array ($druid_status,$druid_note),
					array ($paladin_status,$paladin_note),
					array ($hunter_status,$hunter_note),
					array ($rogue_status,$rogue_note),
					array ($priest_status,$priest_note),
					array ($shaman_status,$shaman_note),
					array ($mage_status,$mage_note),
					array ($warlock_status,$warlock_note),
					array ($warrior_status,$warrior_note)
					);
		
		arsort($wrtable);
		
?>

<!--frontend start-->
<div id="wow-recruit-widget" <?php if ($title_url) { ?> onclick="location.href='<?php echo $title_url;?>';" style="cursor:pointer;" <?php }?>>

<table class="wow-recruit-table" style="width:100%;">

<?php

		foreach ($wrtable as $k1 =>$v1)
		{
			/*echo $k1.'=>'.$v1[0].'=>'.$v1[1].'<br />';*/
			if ($v1[0] >0)/*if status is not Closed*/
			{
?>
			<tr>
				<td rowspan="2" width="30px">
					<img src="<?php echo WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))?>images/class-<?php echo $wrclasskey[$k1];?>.png" class="wow-recruit-icon"/> 
				</td>
				<td><strong class="wow-recruit-<?php echo $wrclasskey[$k1]; ?>"><?php echo $wrclasstext[$k1]?> </strong>
				</td>
				<td><strong class="wow-recruit-status-<?php echo $wrstatus[$v1[0]]; ?>"><?php echo $wrstatus[$v1[0]]; ?></strong>
				</td>
			</tr>
			<tr>
				<td colspan="2"><div class="wow-recruit-note"><?php if ($v1[1]) echo 'Note: '. $v1[1]; ?></div>
				</td>
			</tr>
		
<?php		
		
			}
		}
		
?>
</table>


</div>


<!--frontend end-->



<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
	
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

		/* No need to strip tags for sex and show_sex. */
	
		$instance['deathknight_status'] = $new_instance['deathknight_status'];
		$instance['deathknight_note'] = strip_tags($new_instance['deathknight_note']);
		$instance['druid_status'] = $new_instance['druid_status'];
		$instance['druid_note'] = strip_tags($new_instance['druid_note']);
		$instance['paladin_status'] = $new_instance['paladin_status'];
		$instance['paladin_note'] = strip_tags($new_instance['paladin_note']);
		$instance['hunter_status'] = $new_instance['hunter_status'];
		$instance['hunter_note'] = strip_tags($new_instance['hunter_note']);
		$instance['rogue_status'] = $new_instance['rogue_status'];
		$instance['rogue_note'] = strip_tags($new_instance['rogue_note']);
		$instance['priest_status'] = $new_instance['priest_status'];
		$instance['priest_note'] = strip_tags($new_instance['priest_note']);
		$instance['shaman_status'] = $new_instance['shaman_status'];
		$instance['shaman_note'] = strip_tags($new_instance['shaman_note']);
		$instance['mage_status'] = $new_instance['mage_status'];
		$instance['mage_note'] = strip_tags($new_instance['mage_note']);
		$instance['warlock_status'] = $new_instance['warlock_status'];
		$instance['warlock_note'] = strip_tags($new_instance['warlock_note']);
		$instance['warrior_status'] = $new_instance['warrior_status'];
		$instance['warrior_note'] = strip_tags($new_instance['warrior_note']);


		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
	
		global $wrstatus;
		global $wrclasstext;
		global $wrclasskey;

		/* Set up some default widget settings. */

		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title(optional):', 'hybrid'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:390px;" />
		</p>
		
		<!-- Widget Title Url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title_url' ); ?>"><?php _e('Recruitment Page URL(optional, if not empty please use full url):', 'wow-recruit'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title_url' ); ?>" name="<?php echo $this->get_field_name( 'title_url' ); ?>" value="<?php echo $instance['title_url']; ?>" style="width:390px;" />
		</p>
	<?php
		foreach ($wrclasskey as $v1)
		{
		?>
		<div>
		<img src="<?php echo WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))?>images/class-<?php echo $v1?>.png" width="25px" />
		<select id="<?php echo $this->get_field_id( $v1.'_status' ); ?>" name="<?php echo $this->get_field_name( $v1.'_status' ); ?>" class="widefat" style="width:100px;">
			<?php
			foreach ($wrstatus as $k2=>$v2)
			{
			?>
			<option <?php if ( $k2 == $instance[$v1.'_status']) echo 'selected="selected"'; ?> value="<?php echo $k2?>"><?php echo $v2?></option>

			<?php
			}
			?>
		</select>
		Note: <input type="text" id="<?php echo $this->get_field_id( $v1.'_note' ); ?>" name="<?php echo $this->get_field_name( $v1.'_note' ); ?>" value="<?php echo $instance[$v1.'_note']; ?>" style="width:220px;" />
		</div>
		

		

	<?php
		}
	}
}

?>