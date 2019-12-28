<?php 
/**
 * 
 * This function will add metabox to the dashboard
 */
function tcb_add_metaboxes() {
    $tcb_fileds = apply_filters( 'tcb__fileds', array());
    tcb_add_categories($tcb_fileds);

        add_meta_box(
            'tcb_metaboxes',
            __( 'Component Info', 'tcb' ),
            'tcb_generate_fields',
            'tcb_component'
        );


        add_meta_box(
            'tcb_metaboxes_shortcode_info',
            __( 'Component Shortcode', 'tcb' ),
            'tcb_generate_shortcode',
            'tcb_component'
        );
    // endif;
}

add_action( 'add_meta_boxes', 'tcb_add_metaboxes' );