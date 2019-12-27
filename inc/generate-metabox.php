<?php 
require 'class-fields.php';


function bcs_generate_fields( $post ) {
    ## get all the user defined fields
    $bcs_fileds = apply_filters( 'bcs__fileds', array());

    // var_dump($bcs_fileds);

    # get current post id
    $post_id = $post->ID;

    ## Get current Component Type categories
    $c_cats = get_the_terms($post_id, 'component_type');

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
                    $value = array_key_exists( $field['field'], $old_data_array ) ? $old_data_array[$field['field']]: '';
                    
                    // ## push the data in the current field
                    $field['value'] = $value;
                }

                $fields_class = new Bcs_fields($field, $value);

                $fields_class->render_field();
            endforeach;
        }

    }

    print_r(get_post_meta( $post_id, 'bcs_component_data',true));


}
