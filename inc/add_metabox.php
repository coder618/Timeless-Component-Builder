<?php 
function bcs_add_metaboxes() {
    $bcs_fileds = apply_filters( 'bcs__fileds', array());
    bcs_add_categories($bcs_fileds);

    add_meta_box(
        'bcs_metaboxes',
        __( 'Component Info', 'sitepoint' ),
        'bcs_generate_fields'
    );


    add_meta_box(
        'bcs_metaboxes_shortcode_info',
        __( 'Component Shortcode', 'sitepoint' ),
        'bcs_generate_shortcode'
    );

}

add_action( 'add_meta_boxes', 'bcs_add_metaboxes' );