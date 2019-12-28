<?php 

class Bcs_fields{
    public $name;
    public $placeholder;
    public $value;
    public $label;
    public $type;
    public $repeating_fields;

    // assign the data to the variable
    function __construct($data,$meta_data){ 
        $this->name = isset($data['field']) ? $data['field'] : '';
        $this->placeholder = isset($data['placeholder']) ? $data['placeholder'] : '';
        $this->label = isset($data['label']) ? $data['label'] : '';
        $this->type = isset($data['type']) ? $data['type'] : '';   

        
        $this->repeating_fields = isset($data['fields']) ? $data['fields'] : [];   


        
        // // $this->value = isset($data['value']) ? $data['value'] : '';
        // if( $this->va )

        // isset($data['value'])


        $this->get_value($meta_data);



    }

    
    public function get_value ($saved_meta_data){       
            
        ## if have any old metadata saved
        if($saved_meta_data){                
            $saved_meta_data = unserialize($saved_meta_data);                
            $value = is_array($saved_meta_data) && count($saved_meta_data) > 0 && array_key_exists($this->name,$saved_meta_data )? $saved_meta_data[$this->name]: '';
            $this->value = $value;
        }
    }


    public function render_field( $a_type = false ){       
        $type = $a_type ? $a_type : $this->type;

        if( $this->type == 'textarea' ){
            return $this->textarea();
        }

        if( $this->type == 'text' ){
            return $this->text();
        }

        if( $this->type == 'file' ){
            return $this->file_field();
        }

        if( $this->type == 'repeater' ){
            return $this->repeater();
        }


    }

    function repeater(){

        $child_fields = '';        
        $items_currently_have  = is_array($this->value) ? count($this->value) : 1  ;
        $name = $this->name;
        
        
        // print_r($this->value);

        for( $i=0;  $items_currently_have > $i ; $i++ )  {
            $child_fields .= '<div class="single-item-wrapper" data-repeater-item>';
                foreach ($this->repeating_fields as $k => $single_field){
                    
                    // 
                    $c_name = $single_field['field'];

                    // modify the variable before print child component 
                    $single_field['field'] = "{$name}[$i][$c_name]";

                    if( isset($this->value[$i][$c_name]) ) {
                        $single_field['value'] = $this->value[$i][$c_name];
                    }else{
                        $single_field['value'] = "n";
                    }

                    if( $single_field['type'] == 'textarea' ){
                        $child_fields .= $this->textarea($single_field);
                    }
            
                    if( $single_field['type'] == 'text' ){
                        $child_fields .= $this->text($single_field);
                    }
                    if( $single_field['type'] == 'file' ){   
                        // var_dump($this->value);
                        $child_fields .= $this->file_field($single_field);
                    }
                    


                }
                $child_fields .='<input data-repeater-delete type="button" value="Delete"/>';

            $child_fields .= '</div>';

        }

        $html = '
            <div class="repeater-fileds">
                <input type="hidden" name="'.$this->name.'_count" value="'.$items_currently_have.'" />
                <div class="multiple-fileds-wrapper" data-repeater-list="'.$this->name.'">
                    '.$child_fields.'            
                </div>
                <input data-repeater-create type="button" value="Add"/>
            </div>        
        ';
        return $html;
        
    }


    public function file_field($field_data = []){

        $name = isset( $field_data['field'] ) ? $field_data['field'] : $this->name;
        $value = isset( $field_data['value'] ) ? $field_data['value'] : $this->value;
        // $placeholder = isset( $field_data['placeholder'] ) ? $field_data['placeholder'] : $this->placeholder;
        $label = isset( $field_data['label'] ) ? $field_data['label'] : $this->label;

        

        return '
            <div class="single-field-wrapper">
                <label for="'.$name.'" >'.$label.'
                    <input type="hidden" name="'.$name.'" value="'.$value.'" id="'.$name.'" />                     
                    <button type="button" class="button media-uplooad-btn">Upload Media</button>
                </label>
                <p class="selected-file">'.$value.'</p>
            </div>   
        ';

    }

    public function text( $field_data = [] ){

        $name = isset( $field_data['field'] ) ? $field_data['field'] : $this->name;
        $value = isset( $field_data['value'] ) ? $field_data['value'] : $this->value;
        $placeholder = isset( $field_data['placeholder'] ) ? $field_data['placeholder'] : $this->placeholder;
        $label = isset( $field_data['label'] ) ? $field_data['label'] : $this->label;




        return'
        <div class="single-field-wrapper">
            <label for="'.$name.'" >'.$label.'
                <input type="text" name="'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'" /> 
            </label>
        </div>   
        ';
    }


    public function textarea($field_data = []){
        $name = isset( $field_data['field'] ) ? $field_data['field'] : $this->name;
        $value = isset( $field_data['value'] ) ? $field_data['value'] : $this->value;
        $placeholder = isset( $field_data['placeholder'] ) ? $field_data['placeholder'] : $this->placeholder;
        $label = isset( $field_data['label'] ) ? $field_data['label'] : $this->label;

        return '
        <div class="single-field-wrapper">
            <label for="'.$name.'" >'.$label.'
                <textarea type="text" name="'.$name.'" placeholder="'.$placeholder.'" >'.$value.'</textarea>
            </label>
        </div>        
        ';        
    }

}