<?php
/**
 * Meta box organization details
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 */

declare(strict_types=1);

namespace Pronamic\Orbis\Organizations;

/**
 * Post.
 *
 * @var \WP_Post $post
 */

$get_meta = static function ( string $key ) use ( $post ): string {
	$value = \get_post_meta( $post->ID, $key, true );

	return \is_string( $value ) ? $value : '';
};

$orbis_id = $get_meta( '_orbis_organization_id' );

$kvk_number = $get_meta( '_orbis_kvk_number' );
$vat_number = $get_meta( '_orbis_vat_number' );

$email             = $get_meta( '_orbis_email' );
$accounting_email  = $get_meta( '_orbis_accounting_email' );
$invoice_email     = $get_meta( '_orbis_invoice_email' );
$invoice_reference = $get_meta( '_orbis_invoice_reference' );
$website           = $get_meta( '_orbis_website' );

$address  = $get_meta( '_orbis_address' );
$postcode = $get_meta( '_orbis_postcode' );
$city     = $get_meta( '_orbis_city' );
$country  = $get_meta( '_orbis_country' );

$iban = $get_meta( '_orbis_iban' );

$twitter  = $get_meta( '_orbis_twitter' );
$facebook = $get_meta( '_orbis_facebook' );
$linkedin = $get_meta( '_orbis_linkedin' );

\wp_nonce_field( 'orbis_save_organization_details', 'orbis_organization_details_meta_box_nonce' );

?>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="orbis_organization_id"><?php \esc_html_e( 'Orbis ID', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input id="orbis_organization_id" name="_orbis_organization_id" value="<?php echo \esc_attr( $orbis_id ); ?>" type="text" class="regular-text" readonly="readonly" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="orbis_organization_kvk_number"><?php \esc_html_e( 'Registration Number', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input id="orbis_organization_kvk_number" name="_orbis_kvk_number" value="<?php echo \esc_attr( $kvk_number ); ?>" type="text" size="20" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="orbis_organization_vat_number"><?php \esc_html_e( 'VAT Number', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input id="orbis_organization_vat_number" name="_orbis_vat_number" value="<?php echo \esc_attr( $vat_number ); ?>" type="text" size="20" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="orbis_organization_email"><?php \esc_html_e( 'E-Mail', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input id="orbis_organization_email" name="_orbis_email" value="<?php echo \esc_attr( $email ); ?>" type="email" size="42" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="_orbis_accounting_email"><?php \esc_html_e( 'Accounting E-Mail', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input id="_orbis_accounting_email" name="_orbis_accounting_email" value="<?php echo \esc_attr( $accounting_email ); ?>" type="email" size="42" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="_orbis_invoice_email"><?php \esc_html_e( 'Invoice E-Mail', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input id="_orbis_invoice_email" name="_orbis_invoice_email" value="<?php echo \esc_attr( $invoice_email ); ?>" type="email" size="42" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="_orbis_invoice_reference"><?php \esc_html_e( 'Invoice reference', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<textarea id="_orbis_invoice_reference" name="_orbis_invoice_reference" rows="2" cols="60"><?php echo \esc_textarea( $invoice_reference ); ?></textarea>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="orbis_organization_website"><?php \esc_html_e( 'Website', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input id="orbis_organization_website" name="_orbis_website" value="<?php echo \esc_attr( $website ); ?>" type="url" size="42" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="orbis_organization_address"><?php \esc_html_e( 'Address', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input id="orbis_organization_address" name="_orbis_address" placeholder="<?php echo \esc_attr( \__( 'Address', 'orbis-organizations' ) ); ?>" value="<?php echo \esc_attr( $address ); ?>" type="text" size="42" />
				<br />
				<input id="orbis_organization_postcode" name="_orbis_postcode" placeholder="<?php echo \esc_attr( \__( 'Postcode', 'orbis-organizations' ) ); ?>" value="<?php echo \esc_attr( $postcode ); ?>" type="text" size="10" />
				<input id="orbis_organization_city" name="_orbis_city" placeholder="<?php echo \esc_attr( \__( 'City', 'orbis-organizations' ) ); ?>" value="<?php echo \esc_attr( $city ); ?>" type="text" size="25" />
				<br />
				<input id="orbis_organization_country" name="_orbis_country" placeholder="<?php echo \esc_attr( \__( 'Country', 'orbis-organizations' ) ); ?>" value="<?php echo \esc_attr( $country ); ?>" type="text" size="42" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="orbis_iban"><?php \esc_html_e( 'IBAN', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input type="text" id="orbis_iban" name="_orbis_iban" value="<?php echo \esc_attr( $iban ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="orbis_organization_twitter"><?php \esc_html_e( 'Twitter Username:', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input type="text" id="orbis_organization_twitter" name="_orbis_twitter" value="<?php echo \esc_attr( $twitter ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="orbis_organization_facebook"><?php \esc_html_e( 'Facebook URL:', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input type="text" id="orbis_organization_facebook" name="_orbis_facebook" value="<?php echo \esc_attr( $facebook ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="orbis_organization_linkedin"><?php \esc_html_e( 'LinkedIn URL:', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<input type="text" id="orbis_organization_linkedin" name="_orbis_linkedin" value="<?php echo \esc_attr( $linkedin ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="orbis_organization_payment_method"><?php \esc_html_e( 'Payment Method', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<?php

				$terms = \get_the_terms( $post->ID, 'orbis_payment_method' );

				$payment_method_term = \is_array( $terms ) ? \reset( $terms ) : false;

				\wp_dropdown_categories(
					[
						'name'             => 'tax_input[orbis_payment_method]',
						'show_option_none' => \__( '— Select Payment Method —', 'orbis-organizations' ),
						'hide_empty'       => false,
						'selected'         => $payment_method_term instanceof \WP_Term ? $payment_method_term->term_id : 0,
						'taxonomy'         => 'orbis_payment_method',
					] 
				);

				?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="orbis_organization_invoice_shipping_method"><?php \esc_html_e( 'Invoice Shipping Method', 'orbis-organizations' ); ?></label>
			</th>
			<td>
				<?php

				$terms = \get_the_terms( $post->ID, 'orbis_invoice_shipping_method' );

				$shipping_method_term = \is_array( $terms ) ? \reset( $terms ) : false;

				\wp_dropdown_categories(
					[
						'name'             => 'tax_input[orbis_invoice_shipping_method]',
						'show_option_none' => \__( '— Select Invoice Shipping Method —', 'orbis-organizations' ),
						'hide_empty'       => false,
						'selected'         => $shipping_method_term instanceof \WP_Term ? $shipping_method_term->term_id : 0,
						'taxonomy'         => 'orbis_invoice_shipping_method',
					] 
				);

				?>
			</td>
		</tr>
	</tbody>
</table>
