<?php 
require 'add_categories.php';



function bcs_add_metaboxes() {
    $bcs_fileds = apply_filters( 'bcs__fileds', array());
    bcs_add_categories($bcs_fileds);
    // var_dump($bcs_fileds);
    


    add_meta_box(
        'bcs_metaboxes',
        __( 'Component Info', 'sitepoint' ),
        'bcs_generate_fields'
    );

}

add_action( 'add_meta_boxes', 'bcs_add_metaboxes' );







function bcs_generate_fields( $post ) {
    $value = get_post_meta( $post->ID, 'bcs_data', true );
    $bcs_fileds = apply_filters( 'bcs__fileds', array());

    // var_dump($bcs_fileds);

    # get current post id
    $c_id = $post->ID;

    ## Get current Component Type
    $c_cats = get_the_terms($c_id, 'component_type');

    // var_dump($c_cats);

    ## Check if current component have any component_type selected
    if( is_array($c_cats) && count($c_cats) > 0 ){

        # Get first component slug/key
        $component_cat = $c_cats[0]->slug;

        # Check if available categories have any field defined
        if(array_key_exists($component_cat, $bcs_fileds)){
            // echo "YYY";

            # Get associative component fields from the array
            $c_bcs_fileds = $bcs_fileds[$component_cat];

            var_dump($c_bcs_fileds);


        }

    }





    // echo '<textarea style="width:100%" id="global_notice" name="global_notice">' . esc_attr( $value ) . '</textarea>';
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