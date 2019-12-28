<?php 
/**
 * This file will contain some function which will be helpful for user
 * 
 */
function tcb_data(){
    $id = get_query_var( 'tcb_id', false );
    
    if( $id ){
        return  unserialize( get_post_meta( $id, 'tcb_component_data',true));        
    }

    // by default return false
    return false;

}