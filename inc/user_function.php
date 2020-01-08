<?php 
/**
 * This file contain some function which will be helpful for user
 * as well as for the plugin use case
 * 
 */
function tcb_data(){
    $id = get_query_var( 'tcb_id', false );
    
    if( $id ){
        return   get_post_meta( $id, 'tcb_component_data',true);        
    }
    // by default return false
    return false;
}

/**
 * Render Edit Link
 * 
 */
function tcb_link(){
    $id = get_query_var( 'tcb_id', false );
    if($id){
        return "<a href='".get_edit_post_link($id)."' class='tcb_link tcb_component_edit_link'>Edit</a>";
    }
    return '';
}

/**
 * Component Class
 * This function will return necessary component class with user input
 * 
 */

function tcb_class($extra_class=""){
    $id = get_query_var( 'tcb_id', false );
    $cat_name =  get_query_var( 'tcb_cat', false ) ;

    $data = get_post_meta( $id, 'tcb_component_data',true);

    $class_name ="tcb_component {$cat_name} ";

    // if user provide any class name in the component css_class field
    if( $data != false ){
        $class_name .=  isset($data['css_class']) && !empty($data['css_class']) ? sanitize_html_class($data['css_class'])  : '';
    }
    return $class_name ." ". sanitize_html_class($extra_class);
}