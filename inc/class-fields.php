<?php 

class Bcs_fields{




    public static function text( $data ){
        $name = isset($data['field']) ? $data['field'] : '';
        $placeholder = isset($data['placeholder']) ? $data['placeholder'] : '';
        $value = isset($data['value']) ? $data['value'] : '';
        $label = isset($data['label']) ? $data['label'] : '';

        echo '
        <div class="single-field-wrapper">
            <label for="'.$name.'" >'.$label.'
                <input type="text" name="'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'" /> 
            </label>
        </div>        
        ';
    }

    public static function textarea( $data ){
        $name = isset($data['field']) ? $data['field'] : '';
        $placeholder = isset($data['placeholder']) ? $data['placeholder'] : '';
        $value = isset($data['value']) ? $data['value'] : '';
        $label = isset($data['label']) ? $data['label'] : '';

        echo '
        <div class="single-field-wrapper">
            <label for="'.$name.'" >'.$label.'
                <textarea type="text" name="'.$name.'" placeholder="'.$placeholder.'" >'.$value.'</textarea>
            </label>
        </div>        
        ';        
    }

}