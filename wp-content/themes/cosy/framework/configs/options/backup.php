<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Blog settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function cosy_options_section_backup( $sections )
{
    $sections['backup'] = array(
        'name' => 'backup_panel',
        'title' => esc_html__('Import / Export', 'cosy'),
        'icon' => 'fa fa-refresh',
        'fields' => array(
            array(
                'type'    => 'notice',
                'class'   => 'warning',
                'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'cosy'),
            ),
            array(
                'type'      => 'backup'
            )
        )
    );
    return $sections;
}