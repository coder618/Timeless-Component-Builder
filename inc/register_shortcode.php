<?php 
/**
 * this function will register the shortcode in the wordpress system.
 * so that user can use it
 */

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
        $str = __('Please Create a file at ', "tcb") .": ". $file_path ;
        $str .= __(" To render the component", "tcb");
        return $str;
    }

}
add_shortcode( 'tcb_component' , 'tcb_shortcode' );