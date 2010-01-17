<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('formtext')) {
    function formtext($desc, $name, $initval = null, $extra = null)
    {
        if (is_array($name)) {
            return '<div class="l">
						<label for="' . $name['name'] . '">' . stripslashes($desc) .'</label>
					</div> 
					<div>' . form_input($name) .'</div><div style="clear:both;float:none;"></div>';
        } else {
            return '<div class="l"><label for="' . $name . '">' . stripslashes($desc) .
		                '</label>
					</div> 
					<div>' . form_input(array(
						'name' => $name, 
						'id' => $name,
						'value' => set_value($name, $initval))) .
                	'</div>
				<div style="clear:both;float:none;"></div>';
        }
    }
} 
if (!function_exists('formpassword')) {
    function formpassword($desc, $name, $initval = null, $extra = null)
    {
        if (is_array($name)) {
            return '<div class="l">
						<label class="l" for="' . $name['name'] . '">' . stripslashes($desc) .'</label>
					</div> 
					<div>' . form_password($name) .'</div><div style="clear:both;float:none;"></div>';
        } else {
            return '<div class="l"><label class="l" for="' . $name . '">' . stripslashes($desc) .
		                '</label>
					</div> 
					<div>' . form_password(array(
						'name' => $name, 
						'id' => $name,
						'value' => set_value($name, $initval))) .
                	'</div>
				<div style="clear:both;float:none;"></div>';
        }
    }
}     
		
if (!function_exists('formdrop')) {
    function formdrop($desc, $name, $options)
    {
        if (is_array($name)) { // dees is zoda als ge nen id,name, value wilt meegeven
            return '<div class="l">
						<label for="' . $name['name'] . '">' . stripslashes($desc) .'</label>
					</div> 
					<div>' . form_dropdown($name,$options) .'</div><div style="clear:both;float:none;"></div>';
        } else {
            return '<div class="l"><label for="' . $name . '">' . stripslashes($desc) .
		                '</label>
					</div> 
					<div>' . form_dropdown($name,$options) .
                	'</div>
				<div style="clear:both;float:none;"></div>';
        }
    }
} 
if (!function_exists('formcaptcha')) {
    function formcaptcha($name)
    {
       return '<div class="l"></div> 
		<div>'.$name.'</div>
		<div style="clear:both;float:none;"></div>';   
    }
} 
if (!function_exists('formajax')) {
    function formajax($name)
    {
       return '<div class="l"></div> 
		<div>'.$name.'</div>
		<div style="clear:both;float:none;"></div>';   
    }
} 
if (!function_exists('formfile')) {
    function formfile($desc, $name)
    {
       
            return '<div class="l"><label for="' . $name . '">' . $desc .
		                '</label>
					</div> 
					<div>' . form_upload('files[]') .
                	'</div>
				<div style="clear:both;float:none;"></div>';
        
    }
} 

