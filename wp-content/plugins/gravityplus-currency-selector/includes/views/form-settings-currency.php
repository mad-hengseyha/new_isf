<?php
?>
<table class="gforms_form_settings" cellspacing="0" cellpadding="0">
		<tr>
			<th><?php _e( 'Form Currency', 'gravityplus-currency-selector' ) ?></th>
			<td><?php GFP_Currency_Selector_Helper::dropdown_currencies( array( 'selected' => $selected, 'id' => 'form_currency', 'name' => 'form_currency' ) ); ?></td>
		</tr>
	</table>