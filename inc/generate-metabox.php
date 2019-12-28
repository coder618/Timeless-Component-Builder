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

            $saved_meta_data = get_post_meta( $post_id  ,'bcs_component_data', true );
            
            # Get assigned component fields from the array
            $c_bcs_fileds = $bcs_fileds[$component_cat];

            ## Add nonce field
            echo '<input type="hidden" name="bcs_nonce" id="bcs_nonce" value="'.wp_create_nonce( 'bcs_nonce'.$post->ID ).'" />';

            ## generate meta box based on assigned field and 
            foreach($c_bcs_fileds as $field):                
                $fields_class = new Bcs_fields($field, $saved_meta_data);
                echo $fields_class->render_field();
            endforeach;
        }

    }

    // print_r(get_post_meta( $post_id, 'bcs_component_data',true));


}



function bcs_generate_shortcode(){
    global  $post ;
    $cat_attr = "";
    $cats = get_the_terms( $post->ID, 'component_type' );
    
    if( is_array( $cats ) && count($cats) > 0 ){
        $cat_name = $cats[0]->slug;
        $cat_attr = 'cat="'.$cat_name.'"';
    }

    echo '
        <h4> Shortcode: <pre>[bcs_component id="'.$post->ID.'" '.$cat_attr.' ]</pre> </h4> 
    ';

}