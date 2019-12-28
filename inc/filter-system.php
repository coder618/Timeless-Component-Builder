<?php 
/**
 * A filter for adding field in the component 
 * 
 */
function tcb_fields( $incoming_arg ){	
	return $arr;
}

add_filter( 'tcb_fields_filter' , 'tcb_fields' , 10, 1  );


