<?php 
require 'add_categories.php';
require 'class-fields.php';



function bcs_add_metaboxes() {
    $bcs_fileds = apply_filters( 'bcs__fileds', array());
    bcs_add_categories($bcs_fileds);
    add_meta_box(
        'bcs_metaboxes',
        __( 'Component Info', 'sitepoint' ),
        'bcs_generate_fields'
    );
}

add_action( 'add_meta_boxes', 'bcs_add_metaboxes' );







function bcs_generate_fields( $post ) {
    ## get all the user defined fields
    $bcs_fileds = apply_filters( 'bcs__fileds', array());

    // var_dump($bcs_fileds);

    # get current post id
    $post_id = $post->ID;

    ## Get current Component Type
    $c_cats = get_the_terms($post_id, 'component_type');

    // var_dump($c_cats);

    ## Check if current component have any component_type selected
    if( is_array($c_cats) && count($c_cats) > 0 ){

        # Get first component slug/key
        $component_cat = $c_cats[0]->slug;

        # Check if available categories have any field defined
        if(array_key_exists($component_cat, $bcs_fileds)){

            $old_meta_data = get_post_meta( $post_id  ,'bcs_component_data', true );
            $old_data_array = [];
            
            ## if have any old metadata saved
            if($old_meta_data){                
                $old_data_array = unserialize($old_meta_data);                
            }

            # Get associative component fields from the array
            $c_bcs_fileds = $bcs_fileds[$component_cat];


            foreach($c_bcs_fileds as $field):
                if( count($old_data_array)  > 0){

                    ## get the value from the previous save data
                    $value = array_key_exists( $field['field'], $old_data_array ) ? $old_data_array[$field['field']]: '' ;
                    
                }
                ## push the data in the current field
                $field['value'] = $value;

                if( $field['type'] == 'text' ){
                    Bcs_fields::text($field);
                }
                if( $field['type'] == 'textarea' ){
                    Bcs_fields::textarea($field);
                }
            endforeach;
        }

    }

    print_r(get_post_meta( $post_id, 'bcs_component_data',true));


}

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

    // var_dump($array_to_save);


    // update_post_meta( $post_id, 'bcs_component_data', "defaule"  );




}

add_action( 'save_post', 'save_global_notice_meta_box_data' );