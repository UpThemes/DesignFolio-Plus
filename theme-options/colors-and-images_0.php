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

		array(  "name" => "Logo",
				"desc" => "Enter the relative or absolute path to an image you would like to use as the logo.",
				"id" => "logo",
				"type" => "image",
				"value" => "Upload Logo"),
			
		array(  "name" => "Link Color",
				"desc" => "Select a color to replace the default hyperlink color.",
				"id" => "linkcolor",
				"type" => "colorpicker",
				"value" => ""),
		
		array(  "name" => "Hover Link Color",
				"desc" => "Select a color to replace the default link hover color.",
				"id" => "hovercolor",
				"type" => "colorpicker",
				"value" => ""),
		
		array(  "name" => "Active Link Color",
				"desc" => "Select a color to replace the default link active color.",
				"id" => "activecolor",
				"type" => "colorpicker",
				"value" => ""),
		
		array(  "name" => "Stripe Background Color",
				"desc" => "Select a color to replace the default background stripe color.",
				"id" => "bgcolor",
				"type" => "colorpicker",
				"value" => ""),
	
		array(  "name" => "Welcome Text Color",
				"desc" => "Select a color to replace the default welcome text color.",
				"id" => "welcome_text_color",
				"type" => "colorpicker",
				"value" => ""),

		array(  "name" => "Stripe Background Image (on homepage)",
				"desc" => "Enter the relative or absolute path to an image you would like to use as the background for the middle stripe on the homepage.",
				"id" => "bgimage_homepage",
				"type" => "image",
				"value" => "Upload an Image"),

		array(  "name" => "Stripe Background Image (on interior page)",
				"desc" => "Enter the relative or absolute path to an image you would like to use as the background for the stripe on interior pages.",
				"id" => "bgimage_inner",
				"type" => "image",
				"value" => "Upload an Image")
		
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