<?php 

class Bcs_fields{
    public $name;
    public $placeholder;
    public $value;
    public $label;
    public $type;

    // assign the data to the variable
    function __construct($data){ 
        $this->name = isset($data['field']) ? $data['field'] : '';
        $this->placeholder = isset($data['placeholder']) ? $data['placeholder'] : '';
        $this->value = isset($data['value']) ? $data['value'] : '';
        $this->label = isset($data['label']) ? $data['label'] : '';
        $this->type = isset($data['type']) ? $data['type'] : '';        
    }


    public function render_field(  ){       

        if( $this->type == 'textarea' ){
            echo $this->textarea();
        }

        if( $this->type == 'text' ){
            echo $this->text();
        }


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