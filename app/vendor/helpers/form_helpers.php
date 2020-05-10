<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-07
 * Time: 23:07
 */

function inputBlock($type,$label,$name,$name,$value,$input_attribute = [],$div_attributes= []){
    $div_attributes = stringfyAttributes($div_attributes);
    $input_attributes = stringfyAttributes($input_attribute);
    $html = "<div $div_attributes >";
    $html .= "<label for = '$name'>$label</label>";
    $html .= "<input type='$type' id = '' value = '$value' name = '$name' $input_attributes />";
    $html .= "</div>";

    return $html;
}

function stringfyAttributes($attributes){
    $string = '';
    foreach($attributes as $attribute_name => $attribute_value){
        $string .= ' '. $attribute_name . '="'. $attribute_value . '"';
    }
    return $string;
}

function submitButton($submitText, $input_attributes){
    $input_string_attr = stringfyAttributes($input_attributes);
    $html = "<input type = 'submit' value '$submitText'  $input_string_attr />";
    return $html;
}

function submitBlock($submitText,$inputAttr = [], $div_attr = []){

    $div_attributes = stringfyAttributes($div_attr);
    $input_attributes = stringfyAttributes($inputAttr);

    $html = "<div $div_attributes >";
    $html .= '<input type = "submit" value = "'.$submitText. ''.$input_attributes.'"  />';
    $html .= "</div>";

    return $html;

}