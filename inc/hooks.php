<?php

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