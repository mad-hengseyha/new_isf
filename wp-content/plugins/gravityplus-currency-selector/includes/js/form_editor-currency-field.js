/**
 *
 */
jQuery( document ).ready( function ( jQuery ) {

	gform.addFilter('gform_form_editor_can_field_be_added', gform_form_editor_can_field_be_added_currency);
							  
	jQuery( document ).on( 'gform_load_field_settings', gform_load_field_settings_currency );

    jQuery('.gfield').on('click', ValidateCurrencyField );

    jQuery( document ).on('gform_field_added', gform_field_added_currency );

	}
);

function gform_form_editor_can_field_be_added_currency(canFieldBeAdded, type) {
	
	if ('currency' == type && GetFieldsByType(['currency']).length > 0) {

		alert( currency_field_vars.multiple_fields_not_allowed );
		
		canFieldBeAdded = false;
	}
	
	return canFieldBeAdded;
}

function gform_load_field_settings_currency( event, field, form ) {

	var inputType = GetInputType( field );

	if ( field.displayAllCurrencies ) {

		jQuery( "#gfield_currency_all" ).prop( "checked", true );

        SetDefaultCurrencyChoices( field );

        jQuery( '#gfield_settings_currency_container' ).hide();

	}
	else {

		jQuery( "#gfield_currency_select" ).prop( "checked", true );

        jQuery( '.gfield_currency_checkbox' ).each( function () {

            if ( field['choices'] ) {

                for ( var i = 0; i < field['choices'].length; i++ ) {

                    if ( this.value == field['choices'][i].value ) {

                        this.checked = true;

                        return;

                    }

                }

            }

            this.checked = false;

        } );

        jQuery( '#gfield_settings_currency_container' ).show();

	}

	if ( ( 'currency' === field.type ) && ( 'select' === inputType || 'radio' === inputType ) ) {

		var selectSettings = fieldSettings[field.inputType];

		var currencySettings = fieldSettings['currency'];

		jQuery( selectSettings ).hide();

		jQuery( currencySettings ).show();

	}

	jQuery( "#currency_field_type" ).val( field.inputType );
	
}

function ToggleCurrency( isInit ) {

	var speed = isInit ? '' : 'slow';

	if ( jQuery( '#gfield_currency_all' ).is( ':checked' ) ) {

		jQuery( '#gfield_settings_currency_container' ).hide( speed );

		SetFieldProperty( 'displayAllCurrencies', true );

        SetDefaultCurrencyChoices( GetSelectedField() );

        ResetSelectedCurrencies();

	}
	else {

		jQuery( '#gfield_settings_currency_container' ).show( speed );

		SetFieldProperty( 'displayAllCurrencies', false );

        SetFieldProperty( 'choices', new Array() );

	}

}

function SetSelectedCurrencies() {

	var field = GetSelectedField();

	field['choices'] = new Array();

	jQuery( '.gfield_currency_checkbox' ).each( function () {

		if ( this.checked ) {

            choice = new Choice( this.name, this.value );

            if ( form.currency === this.value ) {

                choice.isSelected = true;

            }

			field['choices'].push( choice );

		}

	} );

	field['choices'].sort( function ( a, b ) {

		return ( a['text'].toLowerCase() > b['text'].toLowerCase() );

	} );

}

function ResetSelectedCurrencies() {

    jQuery( '.gfield_currency_checkbox' ).each( function () {this.checked = false;} );
}

function SetDefaultValues_radio(field){

    field.displayAllCurrencies = true;

    ResetSelectedCurrencies();

    return SetDefaultCurrencyChoices( field );
}

function SetDefaultValues_select(field){

    field.displayAllCurrencies = true;

    ResetSelectedCurrencies();

    return SetDefaultCurrencyChoices( field );

}

function SetDefaultCurrencyChoices( field ) {

    if ( 'currency' == field.type ){

        field.choices = new Array();

        currency_field_vars.choices.forEach(function(element){

            choice = new Choice( element.text, element.value );

            if ( true === element.isSelected ) {

                choice.isSelected = true;

            }

            field.choices.push(choice);

        });

    }

    return field;
}

function ValidateCurrencyField( event ) {

    if ( jQuery(this).hasClass('field_hover') ) {

        var id = jQuery('.field_hover')[0].id.substr(6);

        var field = GetFieldById(id);

        if ('currency' == field.type ) {

            if (!field.displayAllCurrencies && 0 == field.choices.length) {

                alert(currency_field_vars.no_currencies_selected);

            }
        }
    }
}

function gform_field_added_currency( event, form, field ) {

    jQuery('#field_' + field.id).on('click', ValidateCurrencyField );
}