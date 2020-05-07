<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-07
 * Time: 23:07
 */

function inputBlock($type,$label,$name,$name,$value,$input,$input_attribute = [],$div_attributes= []){
    $attributes = stringfyAttributes($div_attributes);
    $html = "<div $attributes >";
    $html .= "<label for = '$name'>$label</label>";
    $html .= "<input type='$type' id = '' value = '$value' name = '$name' $attributes />";
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