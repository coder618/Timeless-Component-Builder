<?php 
/**
 * This file will contain some function which will be helpful for user
 * 
 */
function bcs_data(){
    $id = get_query_var( 'bcs_id', false );
    
    if( $id ){
        return  unserialize( get_post_meta( $id, 'bcs_component_data',true));        
    }

    // by default return false
    return false;

}