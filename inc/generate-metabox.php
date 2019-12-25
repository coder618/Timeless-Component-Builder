<?php 
require 'add_categories.php';



function global_notice_meta_box() {
    $bcs_fileds = apply_filters( 'bcs__fileds', array());
    bcs_add_categories($bcs_fileds);
    // var_dump($bcs_fileds);
    


    add_meta_box(
        'global-notice',
        __( 'Global Notice', 'sitepoint' ),
        'global_notice_meta_box_callback'
    );

}

add_action( 'add_meta_boxes', 'global_notice_meta_box' );







function global_notice_meta_box_callback( $post ) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'global_notice_nonce', 'global_notice_nonce' );

    $value = get_post_meta( $post->ID, '_global_notice', true );

    echo '<textarea style="width:100%" id="global_notice" name="global_notice">' . esc_attr( $value ) . '</textarea>';
}
/*
function save_global_notice_meta_box_data( $post_id ) {

    // Make sure that it is set.
    if ( ! isset( $_POST['global_notice'] ) ) {
        return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['global_notice'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_global_notice', $my_data );
}

add_action( 'save_post', 'save_global_notice_meta_box_data' );
*/