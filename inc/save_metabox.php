<?php 
function save_global_notice_meta_box_data( $post_id ) {    
    ## Get current Component Type
    $c_cats = get_the_terms($post_id, 'component_type');

    ## get all the user defined fields
    $bcs_fileds = apply_filters( 'bcs__fileds', array());

    ## define a empty array where we push the data
    $array_to_save = [];

    if( is_array($c_cats) && count($c_cats) > 0 ){

        # Get first component slug/key
        $component_cat = $c_cats[0]->slug;

        # Check if available categories have any field defined
        if(array_key_exists($component_cat, $bcs_fileds)){
            // echo "YYY";

            # Get associative component fields from the array
            $c_bcs_fileds = $bcs_fileds[$component_cat];
            foreach($c_bcs_fileds as $field):
                $name = $field['field'];

                ## check if the value present in the post array push the data
                if( array_key_exists( $name, $_POST  )) :
                    $array_to_save[$name] = $_POST[$name];
                endif;


            endforeach;

            ## save the data to post meta
            update_post_meta( $post_id, 'bcs_component_data', serialize($array_to_save)  );

        }

    }

}

add_action( 'save_post', 'save_global_notice_meta_box_data' );