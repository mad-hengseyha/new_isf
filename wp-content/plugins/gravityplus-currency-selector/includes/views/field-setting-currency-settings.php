<?php
?>
<li class="currency_setting field_setting">
	<label for="field_currency">
		<?php _e( 'Currency', 'gravityplus-currency-selector' ); ?>
		<?php gform_tooltip( 'form_field_currency' ) ?>
	</label>
	<?php GFP_Currency_Selector_Helper::dropdown_currencies( array( 'selected' => $currency, 'id' => 'field_currency', 'name' => 'field_currency' ) ); ?>
</li>

<li class="currency_field_type_setting field_setting">
	<label for="currency_field_type">
		<?php _e( 'Field Type', 'gravityplus-currency-selector' ); ?>
		<?php gform_tooltip( 'form_field_type' ) ?>
	</label> 
	<select id="currency_field_type"
					 onchange="if(jQuery(this).val() == '') return; jQuery('#field_settings').slideUp(function(){StartChangeInputType( jQuery('#currency_field_type').val(), GetSelectedField() );});">
		<option value="select"><?php _e( 'Drop Down', 'gravityplus-currency-selector' ); ?></option>
		<option value="radio"><?php _e( 'Radio Buttons', 'gravityplus-currency-selector' ); ?></option>
	</select>
</li>

<li class="currency_checkbox_setting field_setting">
	<label for="field_currency">
		<?php _e( 'Currency', 'gravityplus-currency-selector' ); ?>
		<?php gform_tooltip( 'form_field_currency_selection' ) ?>
	</label>

	<input type="radio" id="gfield_currency_all" name="gfield_currency" value="all" onclick="ToggleCurrency();"/> 
	<label for="gfield_currency_all" class="inline"><?php _e( 'All Currencies', 'gravityplus-currency-selector' ); ?></label> 
	&nbsp;&nbsp; 
	<input type="radio" id="gfield_currency_select" name="gfield_currency" value="select" onclick="ToggleCurrency();"/> 
	<label for="gfield_currency_select" class="inline"><?php _e( 'Select Currencies', 'gravityplus-currency-selector' ); ?></label>

	<div id="gfield_settings_currency_container">
		<table cellpadding="0" cellspacing="5">
			<?php
			$currencies = GFP_Currency_Selector_Helper::get_currencies();
			$count = 0;
			$currency_rows = '';

			echo $this->currency_rows( $currencies, $count, $currency_rows );
			?>
		</table>
	</div>
</li>