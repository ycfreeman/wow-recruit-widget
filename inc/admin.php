<?php
/**
 * WOW Recruitment Widget Admin Page
 */
add_action('admin_init', 'wow_recruitoptions_init');
add_action('admin_menu', 'wow_recruitoptions_add_page');

// Init plugin options to white list our options
function wow_recruitoptions_init() {
    register_setting('wow_recruitoptions_options', 'wow_recruit', 'wow_recruitoptions_validate');
}

// Add menu page
function wow_recruitoptions_add_page() {
    add_options_page('WOW Recruit Widget Options', 'WOW Recruit Widget', 'manage_options', 'wow_recruitoptions', 'wow_recruitoptions_do_page');
}

// Draw the menu page itself
function wow_recruitoptions_do_page() {
?>
    <div class="wrap">
        <h2>WOW Recruit Widget Options</h2>
    <?php
    /* remove this line if you don't want to support this plug in */
    echo base64_decode('PGJyIC8+DQo8YnIgLz4NCg0KPHN0eWxlPiNvdXRlcmRpdjF7IG1hcmdpbjphdXRvOyB3aWR0aDo0NjhweDsgaGVpZ2h0OjYwcHg7IG92ZXJmbG93OmhpZGRlbjsgcG9zaXRpb246cmVsYXRpdmU7IH0jaW5uZXJpZnJhbWUxIHsgcG9zaXRpb246YWJzb2x1dGU7IHRvcDotNDQxcHg7IGxlZnQ6LTY4cHg7IHdpZHRoOjYwMHB4OyBoZWlnaHQ6NTUwcHg7IH08L3N0eWxlPg0KPGRpdiBpZD0nb3V0ZXJkaXYxJz4gPGlmcmFtZSBzcmM9Imh0dHA6Ly93d3cueWNmcmVlbWFuLmNvbS9wL3dvdy1yZWNydWl0LXdpZGdldC1hZC5odG1sIiBpZD0naW5uZXJpZnJhbWUxJyBzY3JvbGxpbmc9bm8+PC9pZnJhbWU+DQo8L2Rpdj4=');
    ?>
    <form method="post" action="options.php">
        <?php settings_fields('wow_recruitoptions_options'); ?>
<?php $options = get_option('wow_recruit'); ?>
        <table class="form-table">
            <tr valign="top"><th scope="row">Use Custom Style Sheet</th>
                <td><input name="wow_recruit[custom_style]" type="checkbox" value="1"
<?php checked('1', $options['custom_style']); ?> /></td>
            </tr>
            <tr valign="top">
                <td><h3>Status Texts</h3></td>
            </tr>
            <tr valign="top"><th scope="row">High</th>
                <td><input type="text" name="wow_recruit[status3]" value="<?php echo $options['status3']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Medium</th>
                <td><input type="text" name="wow_recruit[status2]" value="<?php echo $options['status2']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Low</th>
                <td><input type="text" name="wow_recruit[status1]" value="<?php echo $options['status1']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Closed (will not display in front end)</th>
                <td><input type="text" name="wow_recruit[status0]" value="<?php echo $options['status0']; ?>" /></td>
            </tr>
            <tr valign="top">
                <td>&nbsp;</td>
            </tr>
            <tr valign="top">
                <td><h3>Class Texts</h3></td>
            </tr>
            <tr valign="top"><th scope="row">Death Knight</th>
                <td><input type="text" name="wow_recruit[class0]" value="<?php echo $options['class0']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Druid</th>
                <td><input type="text" name="wow_recruit[class1]" value="<?php echo $options['class1']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Paladin</th>
                <td><input type="text" name="wow_recruit[class2]" value="<?php echo $options['class2']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Hunter</th>
                <td><input type="text" name="wow_recruit[class3]" value="<?php echo $options['class3']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Rogue</th>
                <td><input type="text" name="wow_recruit[class4]" value="<?php echo $options['class4']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Priest</th>
                <td><input type="text" name="wow_recruit[class5]" value="<?php echo $options['class5']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Shaman</th>
                <td><input type="text" name="wow_recruit[class6]" value="<?php echo $options['class6']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Mage</th>
                <td><input type="text" name="wow_recruit[class7]" value="<?php echo $options['class7']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Warlock</th>
                <td><input type="text" name="wow_recruit[class8]" value="<?php echo $options['class8']; ?>" /></td>
            </tr>
            <tr valign="top"><th scope="row">Warrior</th>
                <td><input type="text" name="wow_recruit[class9]" value="<?php echo $options['class9']; ?>" /></td>
            </tr>

        </table>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>
<?php
    }

// Sanitize and validate input. Accepts an array, return a sanitized array.
    function wow_recruitoptions_validate($input) {

        foreach ($input as $k => $v) {
            $input[$k] = wp_filter_nohtml_kses($v);
        }
        $input['custom_style'] = ( $input['custom_style'] == 1 ? 1 : 0 );

        return $input;
    }
?>