<?php
/*  Array Options:
   
   name (string)
   desc (string)
   id (string)
   type (string) - text, color, image, select, multiple, textarea, page, pages, category, categories
   value (string) - default value - replaced when custom value is entered - (text, color, select, textarea, page, category)
   options (array)
   attr (array) - any form field attributes
   url (string) - for image type only - defines the default image
    
*/

$options = array (

    array(  "name" => "Homepage Slider Category",
            "desc" => "Select a category to show on the homepage slider.",
            "id" => "portfolio",
            "type" => "category"),
    
    array(  "name" => "Number of Homepage Slider Items",
            "desc" => "Select the number of slider items to display on the homepage.",
            "id" => "portfolio_number",
            "type" => "select",
            "options" => array(
            "1"=>"1",
            "2"=>"2",
            "3"=>"3",
            "4"=>"4",
            "5"=>"5",
            "6"=>"6",
            "7"=>"7",
            "8"=>"8",
            "9"=>"9",
            "10"=>"10",
            "11"=>"11",
            "12"=>"12",
            "13"=>"13",
            "14"=>"14",
            "15"=>"15"            
            ),
            "default_text" => "Unlimited"),
    
    array(  "name" => "Footer Text",
            "desc" => "Enter text to display in the bottom right of the footer.",
            "id" => "footer_text",
            "value" => "Copyright ".date('Y')." Me. All Rights Reserved.",
            "type" => "text")

);

/* ------------ Do not edit below this line ----------- */

//Check if theme options set
global $default_check;
global $default_options;

if(!$default_check):
    foreach($options as $option):
        if($option['type'] != 'image'):
            $default_options[$option['id']] = $option['value'];
        else:
            $default_options[$option['id']] = $option['url'];
        endif;
    endforeach;
    $update_option = get_option('up_themes_'.UPTHEMES_SHORT_NAME);
    if(is_array($update_option)):
        $update_option = array_merge($update_option, $default_options);
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $update_option);
    else:
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $default_options);
    endif;
endif;

render_options($options);
?>