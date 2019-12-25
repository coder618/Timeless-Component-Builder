<?php 
/**
 * This function will add categories based to the provided associative array keys
 * 
 */
function bcs_add_categories($bcs_fields){
    
    // create the component categories if not created
    $registered_component_type = get_terms( array(
        'taxonomy' => 'component_type',
        'hide_empty' => false,
    ));
    
    // collect all the component type in a index base array
    $custom_component_slugs = array_keys($bcs_fields);
    
    // collect all the Registered slug in a index base array
    $registered_component_slug = [];
    foreach($registered_component_type as $single_registered_tax){
        $registered_component_slug[] = $single_registered_tax->slug ;
    }
    
    
    // var_dump( $custom_component_slugs );
    foreach( $custom_component_slugs as $single_slug ){
    
        if( ! array_key_exists( $single_slug , $registered_component_slug ) ){
        wp_insert_term( 
            ucwords(str_replace("_"," ", $single_slug )),
            'component_type',
            [
            'slug' => $single_slug
            ]
        );
        }  
    }
  
}