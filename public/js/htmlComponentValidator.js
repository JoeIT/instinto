/* This js needs the .css-input_text_error style set */

function validateInputText( inputComponent ) 
{
	var value = $(inputComponent).val();
	var typeValidation = $(inputComponent).attr('type_validation');
	var defaultValue = $(inputComponent).attr('default_value');
	var css_error = 'css-input_text_error';
	
	if( defaultValue != '' )
		
		
	var validations = typeValidation.split('-');
	
	for(var index = 0; index < validations.length; index++)
	{
		switch(validations[index])
		{
			case 'integer':
				if( !isInteger( value ) )
				{
					if( defaultValue != '' )
						$(inputComponent).val( defaultValue );
					
					if( $(inputComponent).hasClass(css_error) == false )
						$(inputComponent).toggleClass(css_error);
				}
				else if( $(inputComponent).hasClass(css_error) == true )
						$(inputComponent).toggleClass(css_error);
				
				break;
			case 'float':
				break;
			case 'positive':
				if( !isPositive( value ) )
				{
					if( defaultValue != '' )
						$(inputComponent).val( defaultValue );
					
					if($(inputComponent).hasClass(css_error) == false )
						$(inputComponent).toggleClass(css_error);
					
				}
				else if( $(inputComponent).hasClass(css_error) == true )
					$(inputComponent).toggleClass(css_error);
				
				break;
			case 'number':
				if( !isNumber( value ) )
				{
					if( defaultValue != '' )
						$(inputComponent).val( defaultValue );
					
					if($(inputComponent).hasClass(css_error) == false )
						$(inputComponent).toggleClass(css_error);
					
				}
				else if( $(inputComponent).hasClass(css_error) == true )
					$(inputComponent).toggleClass(css_error);
				
				break;
			default:
				break;
		}
	}
}

function isNumber( value ) {
	return $.isNumeric( value );
}

function isPositive( value )
{
	if( !isNumber( value ))
		return false;
	
	if(Number(value) < 0)
		return false;
	
	return true;
}

function isInteger( value ) {
	if( isNumber( value ) == false)
		return false;
	
	if(Math.floor(value) != value)
		return false;
	
	return true;
}

function isFloat( value ) {
	if(!isNumber( value ))
		return false;
	
	// Falta validacion de float
	
	return true;
}