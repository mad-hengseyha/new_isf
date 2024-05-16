/**
 *
 */

var gf_money = fx.noConflict();
gf_money.base = gf_currency.base;
gf_money.rates = gf_currency.rates;

jQuery( document ).on( 'gform_post_render', gformAddCurrencyFieldAction );

function gformAddCurrencyFieldAction( event, form_id, current_page ) {

	var currency_field = jQuery( '#input_' + form_id + '_' + gf_currency.currency_field_id );

	if ( currency_field.length > 0 ) {

		var multiple_pages = false;

		var currency_field_page_id = currency_field.parents( '.gform_page' ).attr( 'id' );

		if ( 'undefined' !== typeof( currency_field_page_id ) && 0 < currency_field_page_id.length ) {

			currency_field_page_id = currency_field_page_id.split( '_' );

			var currency_field_page = currency_field_page_id[3];

			multiple_pages = true;

		}
		else {

			currency_field_page = current_page;

		}

		if ( currency_field_page == current_page ) {

			currency_field.on( 'change', {form_id: form_id}, gformStartUpdateCurrency );

			gform.addFilter( 'gform_merge_tag_value_pre_calculation', 'gform_merge_tag_value_pre_calculation_currency' );

			gform.addFilter('gform_product_total', 'gform_product_total_currency');

			gf_currency.converted_calc_fields = new Array();
			gf_currency.converted_calc_fields[form_id] = new Array();

			gf_currency.calc_field_base_price_converted = false;

            var form_content = jQuery('#gform_wrapper_' + form_id);

            var invalid = jQuery( '#gform_confirmation_wrapper_' + form_id).hasClass('gform_validation_error') || form_content.hasClass('gform_validation_error');

			if ( ( false == gformCurrencyIsPostback( form_id ) && ! multiple_pages ) || ( multiple_pages && ! invalid ) ) {

				gf_global.gf_currency_config['code'] = gf_currency.default_from;

				gf_global.default_currency_config = gf_global.gf_currency_config;


				var currency_code;

				var is_radio = currency_field.hasClass('gfield_radio');

				if( ! is_radio ) {

					currency_code = jQuery( this ).val();

				} else {

					var selectedRadio = currency_field.find('input[type="radio"]:checked');

					currency_code = selectedRadio[0].value;

				}


				if ( ( 0 < currency_code.length ) && ( gf_global.default_currency_config['code'] !== currency_code ) ) {

					currency_field.trigger( 'change' );

				}

			}

		}

	}

}

function gformStartUpdateCurrency( event ) {

	jQuery( this ).prop( 'disabled', true );

	gformAllProductFields( 'disable' );

	gformSubmitButtons( 'disable' );

	gf_currency.converted_calc_fields = new Array();
	gf_currency.converted_calc_fields[event.data.form_id] = new Array();

	jQuery( this ).after( '<img id="gform_ajax_spinner_currency_field"  class="gform_ajax_spinner" src="' + gf_currency.spinner_url + '" alt="" />' );

	if ( gformIsMultiPage( event.data.form_id ) ) {

		jQuery( '.ginput_total_' + event.data.form_id ).after( '<img id="gform_ajax_spinner_total_field"  class="gform_ajax_spinner" src="' + gf_currency.spinner_url + '" alt="" />' );

	}

	var currency_code = '';

	var selected = jQuery( this );

	var is_radio = selected.hasClass('gfield_radio');

	if( ! is_radio ) {

		currency_code = jQuery( this ).val();

	} else {

		var selectedRadio = selected.find('input[type="radio"]:checked');

		currency_code = selectedRadio[0].value;

	}
	

	var currency = gformGetCurrency( currency_code, event.data.form_id, this );

}

function gformAllProductFields( action ) {

	jQuery( '.gfield_price' ).each( function () {

		if ( 'disable' == action ) {

			jQuery( this ).find( "input[type=\"text\"], input[type=\"number\"], select" ).prop( 'disabled', true );
			jQuery( this ).find( "input[type=\"radio\"], input[type=\"checkbox\"]" ).prop( 'disabled', true );

		}
		else if ( 'enable' == action ) {

			jQuery( this ).find( "input[type=\"text\"], input[type=\"number\"], select" ).prop( 'disabled', false );
			jQuery( this ).find( "input[type=\"radio\"], input[type=\"checkbox\"]" ).prop( 'disabled', false );

		}

	} );

}

function gformSubmitButtons( action ) {

	if ( 'disable' == action ) {

		jQuery( '.gform_next_button' ).prop( 'disabled', true );
		jQuery( '.gform_previous_button' ).prop( 'disabled', true );
		jQuery( '.gform_button' ).prop( 'disabled', true );

	}
	else if ( 'enable' == action ) {

		jQuery( '.gform_next_button' ).prop( 'disabled', false );
		jQuery( '.gform_previous_button' ).prop( 'disabled', false );
		jQuery( '.gform_button' ).prop( 'disabled', false );

	}

}

function gformGetCurrency( currency_code, form_id, currency_field ) {

	var currency = '';

	var post_data = {
		action: 'gfp_currency_selector_get_currency',
		gfp_currency_selector_get_currency: gf_currency.nonce,
		currency: currency_code
	};

	jQuery.post( gf_currency.ajaxurl, post_data, function ( response ) {

		if ( true === response.success ) {

			currency = response.data;

			if ( currency && 0 !== currency.length ) {

				gformFinishUpdateCurrency( currency, form_id );

				jQuery( currency_field ).prop( 'disabled', false );

				gformAllProductFields( 'enable' );
				gformSubmitButtons( 'enable' );

			}

		}

		jQuery( '#gform_ajax_spinner_currency_field' ).remove();
		jQuery( '#gform_ajax_spinner_total_field' ).remove();

	} );

}

function gformFinishUpdateCurrency( currency, form_id ) {

	if ( gf_global.gf_currency_config['code'] !== currency['code'] ) {

		gf_global.prev_currency_config = gf_global.gf_currency_config;

		gf_currency.currency_config = currency;

		for ( var i = 0; i < _gformPriceFields[form_id].length; i++ ) {

			var product_field_id = _gformPriceFields[form_id][i];

			gformChangePriceDisplay( form_id, product_field_id );

			if ( jQuery( '#field_' + form_id + "_" + product_field_id ).hasClass( 'gfield_calculation' ) ) {

				gformChangeCalcFieldBasePrice( jQuery( '#ginput_base_price_' + form_id + '_' + product_field_id ) );

			}

		}

		gf_currency.calc_field_base_price_converted = false;

		gf_global.gf_currency_config = currency;

		for ( form_id in _gformPriceFields ) {

			if ( !_gformPriceFields.hasOwnProperty( form_id ) ) {

				continue;

			}

			gformCalculateTotalPrice( form_id );

		}

	}
}

/**
 * Field types:
 *
 * # Product
 * - single
 * - drop down TODO? the only thing to change is the input value and do we need to change it
 * - radio button TODO? the only thing to change is the input value and do we need to change it
 * - user-defined
 * - hidden
 * - calculation TODO
 *
 * # Option
 * - checkbox
 * - drop down
 * - radio button
 *
 * # Shipping
 * - single
 * - drop down
 * - radio button
 *
 * @param form_id
 * @param product_field_id
 */
function gformChangePriceDisplay( form_id, product_field_id ) {

	var suffix = "_" + form_id + "_" + product_field_id;

	var method = 'text';

	// User-defined and hidden product fields

	var price_element = jQuery( '.gfield_product' + suffix ).find( 'input.ginput_amount' );

	var price_element_disabled_quantity = jQuery( '.gfield_product' + suffix ).find( 'input.ginput_product_price' );

	if ( 0 < price_element.length ||  0 < price_element_disabled_quantity.length ) {

		method = 'val';

		if ( 0 < price_element.length) {

			gformUpdatePriceDisplay( method, price_element );

		} else {

			gformUpdatePriceDisplay( method, price_element_disabled_quantity, {'readonly':true,'suffix':suffix} );

		}

	}
	else {

		//single product fields, maybe calculation fields. Why don't we update base price, too?

		price_element = jQuery( '.gfield_product' + suffix ).find( 'span.ginput_product_price' );

		if ( 0 < price_element.length ) {

			gformUpdatePriceDisplay( method, price_element );

		}
		else {

			//Radio button and checkbox option fields, radio button & checkbox shipping fields

			price_element = jQuery( '.gfield_option' + suffix + ', .gfield_shipping_' + form_id ).find( 'span.ginput_price' );

			if ( 0 < price_element.length ) {

				price_element.each( function () {

					var price = jQuery( this ).text();

					price = price.trim();

					var first_char = price.charAt( 0 );

					if ( '+' == first_char || '-' == first_char ) {

						var new_price = first_char;

						price = price.replace( first_char, '' );

						new_price = new_price + gformCurrencyConvertPrice( price );

					}
					else {

						var new_price = gformCurrencyConvertPrice( price );

					}

					jQuery( this ).text( new_price );

				} );

			}
			else {

				//Dropdown option fields, dropdown shipping fields

				price_element = jQuery( '.gfield_option' + suffix + ', .gfield_shipping_' + form_id ).find( 'select' );

				if ( 0 < price_element.length ) {

					var selected_price = gformCurrencyGetPrice( price_element.val() );

					selected_price = gf_money( selected_price ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );

					price_element.children( 'option' ).each( function () {

						var choice_element = jQuery( this );

						var label = gformCurrencyGetOptionLabel( choice_element, choice_element.val(), selected_price, form_id, product_field_id );

						choice_element.html( label );

					} );

				}
				else {

					//single shipping field

					price_element = jQuery( '.gfield_shipping_' + form_id ).find( 'span.ginput_shipping_price' );

					if ( 0 < price_element.length ) {

						gformUpdatePriceDisplay( method, price_element );

					}

				}

			}

		}

	}

}

function gformUpdatePriceDisplay( method, element,  hiddenParameter = null  ) {

	if ( 'val' === method ) {

		var new_price = gformCurrencyConvertPrice( element.val() );


		if ( null != hiddenParameter && true === hiddenParameter.readonly ) {

			element.hide();

			var addedField = jQuery('#add_disabled_product_field_price'+hiddenParameter.suffix)

			if ( addedField.length ){

				new_price = gformCurrencyConvertPrice( addedField.text() );

				addedField.text(new_price);

			} else {

				element.after('<span id="add_disabled_product_field_price'+hiddenParameter.suffix+'">'+new_price+'</span>')

			}

		} else {

			element.val( new_price );

		}

	} else {

		var new_price = gformCurrencyConvertPrice( element.text() );

		element.text( new_price );

	}

}

function gformChangeCalcFieldBasePrice( base_price_field ) {

	if ( gf_currency.calc_field_base_price_converted && 0 < base_price_field.length ) {

		var base_price = base_price_field.val();

		var c = new Currency( gf_global.prev_currency_config ); //current currency of base price field, the currency we're switching from

		base_price = c.toNumber( base_price );

		base_price = ( base_price === false ) ? 0 : base_price;

		var converted_value = gf_money( base_price ).from( gf_global.prev_currency_config['code'] ).to( gf_global.default_currency_config['code'] );

		if ( 0 === gf_global.default_currency_config['decimals'] ) {

			converted_value = Math.round( converted_value );

		}
		else {

			converted_value = Math.round( converted_value * 100 ) / 100;

		}

		gf_global.gf_currency_config = gf_global.default_currency_config; //format in default currency

		var formatted_value = gformFormatMoney( converted_value ? converted_value : 0, true );

		gf_global.gf_currency_config = gf_global.prev_currency_config;

		base_price_field.val( formatted_value );

	}

}

function gformCurrencyGetPrice( text ) {

	var val = text.split( '|' );

	var currency = new Currency( gf_global.default_currency_config );

	if ( val.length > 1 && currency.toNumber( val[1] ) !== false ) {

		return currency.toNumber( val[1] );

	}

	return 0;

}

function gformCurrencyConvertPrice( price ) {

	var number = gformCurrencyToNumber( price, gf_global.gf_currency_config );

	number = gf_money( number ).from( gf_global.gf_currency_config['code'] ).to( gf_currency.currency_config['code'] );

	gf_global.gf_currency_config = gf_currency.currency_config;

	price = gformFormatMoney( number, true );

	gf_global.gf_currency_config = gf_global.prev_currency_config;

	return price;
}

function gformCurrencyToNumber( text, currency_config ) {

	if ( gformIsNumber( text ) ) {

		return parseFloat( text );

	}

	return gformCurrencyCleanNumber( text, currency_config['symbol_right'], currency_config['symbol_left'], currency_config['decimal_separator'] );

}

function gformCurrencyCleanNumber( text, symbol_right, symbol_left, decimal_separator ) {

	text = text + " ";

	text = text.replace( /&.*?;/, "", text );

	text = text.replace( symbol_right, "" );
	text = text.replace( symbol_left, "" );


	var clean_number = "";
	var is_negative = false;

	for ( var i = 0; i < text.length; i++ ) {

		var digit = text.substr( i, 1 );

		if ( parseInt( digit ) >= 0 && parseInt( digit ) <= 9 ) {

			clean_number += digit;

		}
		else if ( ( digit == decimal_separator ) && ( gformIsNumber( text.substr( i + 1, 1 ) ) || gformIsNumber( text.substr( i - 1, 1 ) ) ) ) {

			clean_number += digit;

		}
		else if ( digit == '-' ) {

			is_negative = true;

		}

	}

	var float_number = "";

	for ( var i = 0; i < clean_number.length; i++ ) {

		var char = clean_number.substr( i, 1 );

		if ( char >= '0' && char <= '9' ) {

			float_number += char;

		}
		else if ( char == decimal_separator ) {

			float_number += ".";

		}

	}

	if ( is_negative ) {

		float_number = "-" + float_number;

	}

	return gformIsNumber( float_number ) ? parseFloat( float_number ) : false;
}

function gformIsMultiPage( form_id ) {

	var is_multi_page = false;

	var target_page = jQuery( '#gform_target_page_number_' + form_id ).val();

	var source_page = jQuery( '#gform_source_page_number_' + form_id ).val();

	if ( 0 != target_page || 1 != source_page ) {

		is_multi_page = true;

	}

	return is_multi_page;
}

function gformCurrencyIsPostback( form_id ) {

	var is_postback = false;

	var ajax_contents = jQuery( '#gform_ajax_frame_' + form_id ).contents().find( '*' ).html();

	if ( 'undefined' !== typeof( ajax_contents ) ) {

	    is_postback = ( 0 < ajax_contents.indexOf( 'GF_AJAX_POSTBACK' ) ) ? true : ( 'undefined' !== typeof gf_currency.is_postback );

    }


	return is_postback;
}

/**
 * @see gformGetOptionLabel
 *
 * @param element
 * @param selected_value
 * @param current_price
 * @param form_id
 * @param field_id
 * @returns {string}
 */
function gformCurrencyGetOptionLabel( element, selected_value, current_price, form_id, field_id ) {

	element = jQuery( element );

	var price = gformCurrencyGetPrice( selected_value );

	price = gf_money( price ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );

	var current_diff = element.attr( 'price' );

	var original_label = element.html().replace( /<span(.*)<\/span>/i, "" ).replace( current_diff, "" );

	gf_global.gf_currency_config = gf_currency.currency_config;

	var diff = gformGetPriceDifference( current_price, price );

	diff = gformToNumber( diff ) == 0 ? "" : " " + diff;

	var price_label = element[0].tagName.toLowerCase() == "option" ? " " + diff : "<span class='ginput_price'>" + diff + "</span>";

	var label = original_label + price_label;

	//this is just a hook for custom formatting
	if ( window["gform_format_option_label"] ) {

		label = gform_format_option_label( label, original_label, price_label, current_price, price, form_id, field_id );

	}

	gf_global.gf_currency_config = gf_global.prev_currency_config;


	return label;
}

/**
 * This is run for each field tag in the formula
 *
 * We need to convert all but user-defined & hidden fields. TODO do we need to convert single shipping, too?
 * Only single product, single shipping, user-defined, and hidden product fields are money formatted w/ currency symbol that needs to be removed
 *
 * @param value
 * @param matches
 * @param isVisible
 * @param formulaField
 * @param formId
 * @returns {*}
 */
function gform_merge_tag_value_pre_calculation_currency( value, matches, isVisible, formulaField, formId ) {

	if ( '0' !== formId && 'undefined' !== typeof gf_currency.currency_config ) {

		//value = gformCurrencyToNumber( value, gf_global.default_currency_config );

		if ( /*0 < value &&*/ isVisible ) {

			var form_id = formId;
			var input_id = matches[1];
			var field_id = parseInt( input_id );

            var numberFormat = gf_get_field_number_format( field_id, form_id );

            if ( ! numberFormat ) {

            	return value;
			}

			var decimalSeparator = gformGetDecimalSeparator(numberFormat);

			var suffix = "_" + form_id + "_" + field_id;
			var product_field = jQuery( '.gfield_product' + suffix + ' .ginput_amount' ); //user-defined and hidden

			if ( product_field.length > 0 ) {
				//value has already been converted, but make sure it's in expected decimal separator so value is correct when it is cleaned in GFCalc.replaceFieldTags
				if ( (',' == decimalSeparator && ',' !== gf_currency.currency_config['decimal_separator'] ) || ( '.' == decimalSeparator && '.' !== gf_currency.currency_config['decimal_separator']) ) {

					value = value.replace( gf_currency.currency_config['decimal_separator'], decimalSeparator );
				}

			} else {
				//convert the value
				value = gformCurrencyToNumber( value, gf_global.default_currency_config );

				converted_value = gf_money( value ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );

				if ( 0 === gf_currency.currency_config['decimals'] ) {

					converted_value = Math.round( converted_value );

				}
				else {

					converted_value = Math.round( converted_value * 100 ) / 100;

				}

				value = converted_value;

				if ( -1 == gf_currency.converted_calc_fields[form_id].indexOf( formulaField.field_id ) ) {

					gf_currency.converted_calc_fields[form_id].push( formulaField.field_id );

					gf_currency.calc_field_base_price_converted = true;

				}

			}

		}

	}

	return value;
}

/**
 * @see gformCalculateTotalPrice
 * @see gformCalculateProductPrice
 *
 * @param price
 * @param formId
 * @returns {*}
 */
function gform_product_total_currency( price, formId ) {

	if ( '0' !== formId && 'undefined' !== typeof gf_currency.currency_config && ( 'undefined' == typeof(window["gf_submitting_" + formId ]) || false == window["gf_submitting_" + formId ] ) ) {

		gf_global.gf_currency_config = gf_global.default_currency_config;

		var final_price = 0, new_price = 0, product_price = 0;

		_anyProductSelected = false;

		for ( var i = 0; i < _gformPriceFields[formId].length; i++ ) {

			var form_id = formId;
			var productFieldId = _gformPriceFields[formId][i];

			gformCurrencyUpdateLabel( form_id, productFieldId );

			var suffix = "_" + form_id + "_" + productFieldId;
			var productField = jQuery( '.gfield_product' + suffix + ' .ginput_amount' );

			if ( productField.length > 0 ) {

				var field_val = productField.val();

				if ( gformIsHidden( productField ) ) {

					field_val = 0;

				}

				var c = new Currency( gf_currency.currency_config );

				field_val = c.toNumber( field_val );

				product_price = ( field_val === false ) ? 0 : field_val;

			}
			else {

				//if this is a calculation field & base price has already been converted & updated, get that base price
				if ( jQuery( '#field_' + form_id + "_" + productFieldId ).hasClass( 'gfield_calculation' ) && -1 != gf_currency.converted_calc_fields[form_id].indexOf( parseInt( productFieldId ) ) ) {

					var calc_product_base_price_field = jQuery( '#ginput_base_price' + suffix );

					if ( 0 < calc_product_base_price_field.length ) {

						var base_price = calc_product_base_price_field.val();

						var c = new Currency( gf_currency.currency_config );

						base_price = c.toNumber( base_price );

						product_price = ( base_price === false ) ? 0 : base_price;

					}

				}
				else {

					product_price = gf_money( gformGetBasePrice( form_id, productFieldId ) ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );

				}

			}

			var quantity = gformGetProductQuantity( form_id, productFieldId );

			//calculating options if quantity is more than 0 (a product was selected).
			if ( quantity > 0 ) {

				jQuery( ".gfield_option" + suffix ).find( "input:checked, select" ).each( function () {

					if ( !gformIsHidden( jQuery( this ) ) )

						product_price += gf_money( gformGetPrice( jQuery( this ).val() ) ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );

				} );

				_anyProductSelected = true;

			}

			product_price = product_price * quantity;
			product_price = Math.round( product_price * 100 ) / 100;

			new_price += product_price;

			product_price = 0;

		}

		if ( _anyProductSelected ) {

			var shipping = gformGetShippingPrice( formId );

			new_price += gf_money( shipping ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );

		}

		if ( 0 === gf_currency.currency_config['decimals'] ) {

			final_price = Math.round( new_price );

		}
		else {

			final_price = Math.round( new_price * 100 ) / 100;

			/*new_price = Math.round( new_price * 100 ) / 100;

			new_price = new_price.toString();

			for ( var j = 0; j < new_price.length; j++ ) {

				var char = new_price.substr( j, 1 );

				if ( gf_global.gf_currency_config['thousand_separator'] == char ) {

					final_price += gf_currency.currency_config['thousand_separator'];

				}
				else if ( gf_global.gf_currency_config['decimal_separator'] == char ) {

					final_price += gf_currency.currency_config['decimal_separator'];

				}
				else {

					final_price += char;

				}

			}*/

		}

		price = final_price;

		gf_global.gf_currency_config = gf_currency.currency_config;

	}

	return price;
}

/**
 * @see gformCalculateProductPrice
 *
 * @param form_id
 * @param productFieldId
 */
function gformCurrencyUpdateLabel( form_id, productFieldId ) {

	var suffix = "_" + form_id + "_" + productFieldId;


	if ( gformCurrencyIsPostback( form_id ) ) {

		var single_product = jQuery( '#ginput_base_price' + suffix );


		if ( 0 < single_product.length ) {

			var price = single_product.val();

			var c = new Currency( gf_global.gf_currency_config );


			price = c.toNumber( price );

			price = ( price === false ) ? 0 : price;

			price = gf_money( price ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );


			gf_global.gf_currency_config = gf_currency.currency_config;


			jQuery( '.gfield_product' + suffix ).find( 'span.ginput_product_price' ).text( gformFormatMoney( price, true ) );


			gf_global.gf_currency_config = gf_global.default_currency_config;

		}

	}

	jQuery( '.gfield_option' + suffix + ', .gfield_shipping_' + form_id ).find( 'select' ).each( function () {

		var dropdown_field = jQuery( this );

		var selected_price = gformGetPrice( dropdown_field.val() );


		selected_price = gf_money( selected_price ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );


		var field_id = dropdown_field.attr( 'id' ).split( '_' )[2];


		dropdown_field.children( 'option' ).each( function () {

			var choice_element = jQuery( this );

			var label = gform_product_total_currency_GetOptionLabel( choice_element, choice_element.val(), selected_price, form_id, field_id );


			choice_element.html( label );

		} );

	} );


	jQuery( '.gfield_option' + suffix ).find( '.gfield_checkbox' ).find( 'input' ).each( function () {

		var checkbox_item = jQuery( this );

		var id = checkbox_item.attr( 'id' );

		var field_id = id.split( '_' )[2];

		var label_id = id.replace( 'choice_', '#label_' );

		var label_element = jQuery( label_id );

		var label = gform_product_total_currency_GetOptionLabel( label_element, checkbox_item.val(), 0, form_id, field_id );


		label_element.html( label );

	} );


	jQuery( '.gfield_option' + suffix + ', .gfield_shipping_' + form_id ).find( '.gfield_radio' ).each( function () {

		var selected_price = 0;

		var radio_field = jQuery( this );

		var id = radio_field.attr( 'id' );

		var fieldId = id.split( "_" )[2];

		var selected_value = radio_field.find( 'input:checked' ).val();


		if ( selected_value ) {

			selected_price = gformGetPrice( selected_value );

			selected_price = gf_money( selected_price ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );

		}

		jQuery( this ).find( 'input' ).each( function () {

			var radio_item = jQuery( this );

			var label_id = radio_item.attr( 'id' ).replace( 'choice_', '#label_' );

			var label_element = jQuery( label_id );

			var label = gform_product_total_currency_GetOptionLabel( label_element, radio_item.val(), selected_price, form_id, fieldId );


			label_element.html( label );

		} );

	} );

}

function gform_product_total_currency_GetOptionLabel( element, selected_value, current_price, form_id, field_id ) {

	element = jQuery( element );


	var price = gformGetPrice( selected_value );


	price = gf_money( price ).from( gf_global.default_currency_config['code'] ).to( gf_currency.currency_config['code'] );


	var current_diff = element.attr( 'price' );

	var original_label = element.html().replace( /<span(.*)<\/span>/i, "" ).replace( current_diff, "" );


	gf_global.gf_currency_config = gf_currency.currency_config;


	var diff = gformGetPriceDifference( current_price, price );


	diff = gformToNumber( diff ) == 0 ? '' : ' ' + diff;

	element.attr( 'price', diff );


	gf_global.gf_currency_config = gf_global.default_currency_config;


	var price_label = element[0].tagName.toLowerCase() == 'option' ? ' ' + diff : "<span class='ginput_price'>" + diff + "</span>";

	var label = original_label + price_label;


	if ( window['gform_format_option_label'] ) {

		label = gform_format_option_label( label, original_label, price_label, current_price, price, form_id, field_id );

	}

	return label;
}