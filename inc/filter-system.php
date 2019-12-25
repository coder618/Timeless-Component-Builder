<?php 
function bcs_fields( $incoming_arg ){	
	return $arr;
}

add_filter( 'bcs_fields_filter' , 'bcs_fields' , 10, 1  );


