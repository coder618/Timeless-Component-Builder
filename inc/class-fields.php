<?php 

class Bcs_fields{
    public $name;
    public $placeholder;
    public $value;
    public $label;
    public $type;

    // assign the data to the variable
    function __construct($data,$meta_data){ 
        $this->name = isset($data['field']) ? $data['field'] : '';
        $this->placeholder = isset($data['placeholder']) ? $data['placeholder'] : '';
        $this->label = isset($data['label']) ? $data['label'] : '';
        $this->type = isset($data['type']) ? $data['type'] : '';   

        
        $this->value = isset($data['value']) ? $data['value'] : '';

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


    public function render_field(  ){       

        if( $this->type == 'textarea' ){
            echo $this->textarea();
        }

        if( $this->type == 'text' ){
            echo $this->text();
        }

        if( $this->type == 'file' ){
            echo $this->file_field();
        }


    }


    public function file_field(){

        return '
            <div class="single-field-wrapper">
                <label for="'.$this->name.'" >'.$this->label.'
                    <input type="hidden" name="'.$this->name.'" placeholder="'.$this->placeholder.'" value="'.$this->value.'" id="'.$this->name.'" />                     
                    <button type="button" class="button media-uplooad-btn" data-media-uploader-target="#'.$this->name.'">Upload Media</button>
                </label>
                <p class="selected-file">'.$this->value.'</p>
            </div>   
        ';

    }

    public function text(){
        return'
        <div class="single-field-wrapper">
            <label for="'.$this->name.'" >'.$this->label.'
                <input type="text" name="'.$this->name.'" placeholder="'.$this->placeholder.'" value="'.$this->value.'" /> 
            </label>
        </div>   
        ';

    }


    public function textarea(){

        return '
        <div class="single-field-wrapper">
            <label for="'.$this->name.'" >'.$this->label.'
                <textarea type="text" name="'.$this->name.'" placeholder="'.$this->placeholder.'" >'.$this->value.'</textarea>
            </label>
        </div>        
        ';        
    }

}