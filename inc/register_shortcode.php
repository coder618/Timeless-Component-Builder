<?php 

 // this function will register shortcode
function tcb_shortcode($atts=[]) {
    $html = '';
    $func_name = '';
    $id = '';
    $cat_name = '';

    if( is_array($atts) ){
        if(array_key_exists('cat', $atts) && !empty($atts['cat'])){
            $cat_name = $atts['cat'];        
        }
    }   
    
    ## check the file existency
    $file_path = get_template_directory() .'/tcb/component-'. $cat_name.'.php';
    
    $file = file_exists($file_path);
    if( $file){
        ob_start();        
        set_query_var( 'tcb_id',$atts['id'] ) ;
        get_template_part( 'tcb/component-'. $cat_name );
        return ob_get_clean();
    }else{
        return "Please Create a file at (". $file_path . ') To render the component';
    }

}
add_shortcode( 'tcb_component' , 'tcb_shortcode' );