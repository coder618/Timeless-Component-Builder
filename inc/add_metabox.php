<?php 
function bcs_add_metaboxes() {
    $bcs_fileds = apply_filters( 'bcs__fileds', array());
    bcs_add_categories($bcs_fileds);

    // if( get_post_type($post->ID)== 'bcs_component' ) :
        add_meta_box(
            'bcs_metaboxes',
            __( 'Component Info', 'sitepoint' ),
            'bcs_generate_fields',
            'bcs_component'
        );


        add_meta_box(
            'bcs_metaboxes_shortcode_info',
            __( 'Component Shortcode', 'sitepoint' ),
            'bcs_generate_shortcode',
            'bcs_component'
        );
    // endif;

}

add_action( 'add_meta_boxes', 'bcs_add_metaboxes' );