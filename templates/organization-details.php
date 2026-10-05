<?php
/**
 * Organization details
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 */

namespace Pronamic\Orbis\Organizations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$get_meta = static function ( string $key ): string {
	$value = \get_post_meta( (int) \get_the_ID(), $key, true );

	return \is_string( $value ) ? $value : '';
};

$kvk_number = $get_meta( '_orbis_kvk_number' );
$vat_number = $get_meta( '_orbis_vat_number' );

$email   = $get_meta( '_orbis_email' );
$website = $get_meta( '_orbis_website' );

$address  = $get_meta( '_orbis_address' );
$postcode = $get_meta( '_orbis_postcode' );
$city     = $get_meta( '_orbis_city' );
$country  = $get_meta( '_orbis_country' );

$accounting_email = $get_meta( '_orbis_accounting_email' );

$invoice_email     = $get_meta( '_orbis_invoice_email' );
$invoice_reference = $get_meta( '_orbis_invoice_reference' );

$iban = $get_meta( '_orbis_iban' );

?>
<dl>
	<?php if ( '' !== $address || '' !== $postcode || '' !== $city || '' !== $country ) : ?>

		<dt><?php \esc_html_e( 'Address', 'orbis-organizations' ); ?></dt>
		<dd>
			<?php echo \esc_html( $address ); ?><br />
			<?php echo \esc_html( \trim( $postcode . ' ' . $city ) ); ?><br />
			<?php echo \esc_html( $country ); ?>
		</dd>

	<?php endif; ?>

	<?php if ( '' !== $website ) : ?>

		<dt><?php \esc_html_e( 'Website', 'orbis-organizations' ); ?></dt>
		<dd>
			<a href="<?php echo \esc_url( $website ); ?>" target="_blank"><?php echo \esc_html( $website ); ?></a>
		</dd>

	<?php endif; ?>

	<?php if ( '' !== $email ) : ?>

		<dt><?php \esc_html_e( 'E-Mail', 'orbis-organizations' ); ?></dt>
		<dd>
			<a href="<?php echo \esc_url( 'mailto:' . $email ); ?>"><?php echo \esc_html( $email ); ?></a>
		</dd>

	<?php endif; ?>

	<?php if ( '' !== $accounting_email ) : ?>

		<dt><?php \esc_html_e( 'Accounting E-Mail', 'orbis-organizations' ); ?></dt>
		<dd>
			<a href="<?php echo \esc_url( 'mailto:' . $accounting_email ); ?>"><?php echo \esc_html( $accounting_email ); ?></a>
		</dd>

	<?php endif; ?>

	<?php if ( '' !== $invoice_email ) : ?>

		<dt><?php \esc_html_e( 'Invoice E-Mail', 'orbis-organizations' ); ?></dt>
		<dd>
			<a href="<?php echo \esc_url( 'mailto:' . $invoice_email ); ?>"><?php echo \esc_html( $invoice_email ); ?></a>
		</dd>

	<?php endif; ?>

	<?php if ( '' !== $invoice_reference ) : ?>

		<dt><?php \esc_html_e( 'Invoice reference', 'orbis-organizations' ); ?></dt>
		<dd><?php echo \nl2br( \esc_html( $invoice_reference ) ); ?></dd>

	<?php endif; ?>

	<?php if ( '' !== $kvk_number ) : ?>

		<dt><?php \esc_html_e( 'Registration Number', 'orbis-organizations' ); ?></dt>
		<dd>
			<?php echo \esc_html( $kvk_number ); ?>

			<?php

			$url_open_kvk = \add_query_arg(
				[
					'q' => $kvk_number,
				],
				'https://openkvk.nl/search'
			);

			$url_kvk = \add_query_arg(
				[
					'kvknummer'         => $kvk_number,
					'hoofdvestiging'    => '1',
					'rechtspersoon'     => '1',
					'nevenvestiging'    => '1',
					'zoekvervallen'     => '1',
					'zoekuitgeschreven' => '1',
				],
				'https://www.kvk.nl/zoeken/handelsregister/'
			);

			?>
			<a class="badge text-bg-info" href="<?php echo \esc_url( $url_open_kvk ); ?>" target="_blank">openkvk.nl</a>
			<a class="badge text-bg-info" href="<?php echo \esc_url( $url_kvk ); ?>" target="_blank">kvk.nl</a>
		</dd>

	<?php endif; ?>

	<?php if ( '' !== $vat_number ) : ?>

		<dt><?php \esc_html_e( 'VAT Number', 'orbis-organizations' ); ?></dt>
		<dd><?php echo \esc_html( $vat_number ); ?></dd>

	<?php endif; ?>

	<?php if ( '' !== $iban ) : ?>

		<dt><?php \esc_html_e( 'IBAN', 'orbis-organizations' ); ?></dt>
		<dd><?php echo \esc_html( $iban ); ?></dd>

	<?php endif; ?>

	<?php if ( \taxonomy_exists( 'orbis_payment_method' ) && \has_term( '', 'orbis_payment_method' ) ) : ?>

		<dt><?php \esc_html_e( 'Payment Method', 'orbis-organizations' ); ?></dt>
		<dd><?php \the_terms( (int) \get_the_ID(), 'orbis_payment_method' ); ?></dd>

	<?php endif; ?>

	<?php if ( \taxonomy_exists( 'orbis_invoice_shipping_method' ) && \has_term( '', 'orbis_invoice_shipping_method' ) ) : ?>

		<dt><?php \esc_html_e( 'Invoice Shipping Method', 'orbis-organizations' ); ?></dt>
		<dd><?php \the_terms( (int) \get_the_ID(), 'orbis_invoice_shipping_method' ); ?></dd>

	<?php endif; ?>
</dl>
