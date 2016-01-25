<?php

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
            global $wr_options;
            wp_enqueue_style('wr_layout', plugins_url('css/style' . (($wr_options['theme'] != '') ? '-' . $wr_options['theme'] : '') . '.css', WR__FILE__));
        }
    }

    add_action('init', 'wow_recruit_widget_enqueue_styles');
}

/**
 * display/not display closed status
 */

$wr_display_closed = $wr_options['display_closed'];
$wr_theme = $wr_options['theme'];