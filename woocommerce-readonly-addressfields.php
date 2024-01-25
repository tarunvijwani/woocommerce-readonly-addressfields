<?php
/**
 * Plugin Name:       WooCommerce Readonly Address Fields
 * Description:       This is POC plugin to set Readonly Address Fields
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            WooCommerce
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       woocommerce-readonly-addressfields
 *
 * @package           woocommerce-readonly-addressfields
 */

add_action ( 'woocommerce_blocks_loaded', 'woocommerce_readonly_addressfields_init');

function woocommerce_readonly_addressfields_init()
{
	set_customer_addressfields();
	woocommerce_readonly_addressfields_enqueue_scripts();

}

// Set fixed billing and shipping addresses.
function set_customer_addressfields() {
	/**
	 * Sets fixed billing and shipping addresses to a given WC_Order or WC_Customer object.
	 *
	 * @param WC_Order|WC_Customer $object The WooCommerce Order or Customer object.
	 */
	function set_fixed_addresses( $object ) {
		// Define the fixed address details.
		$fixed_address = array(
			'first_name' => 'John',
			'last_name'  => 'Doe',
			'company'    => 'Company Name',
			'address_1'  => '123 Main St',
			'address_2'  => 'Apt 1',
			'city'       => 'Townsville',
			'state'      => 'NY',
			'postcode'   => '12345',
			'country'    => 'US',
			'email'      => 'john.doe@example.com',
			'phone'      => '555-555-5555'
		);

		// Loop through the address details and set them.
		foreach ( $fixed_address as $key => $value ) {
			if ( is_callable( [ $object, "set_billing_$key" ] ) ) {
				$object->{"set_billing_$key"}( $value );
			}
			if ( is_callable( [ $object, "set_shipping_$key" ] ) ) {
				$object->{"set_shipping_$key"}( $value );
			}
		}

		// Save the changes to the object.
		$object->save();
	}

	/**
	 * Hook: Set fixed billing and shipping addresses when the checkout is processed.
	 * This is a additional layer of security to prevent unwanted address manupilation.
	 */
	add_action( 'woocommerce_store_api_checkout_update_order_meta', function( $order ) {
		if ( $order instanceof WC_Order ) {
			set_fixed_addresses( $order );
		}
	});

	/**
	 * Hook: Set fixed billing and shipping addresses when a user logs in.
	 */
	add_action( 'wp_login', function( $user_login, $user ) {
		$customer = new WC_Customer( $user->ID );
		set_fixed_addresses( $customer );
	}, 10, 2 );
}

function woocommerce_readonly_addressfields_enqueue_scripts() {
    wp_enqueue_script(
        'woocommerce-readonly-addressfields-script',
        plugin_dir_url( __FILE__ ) . 'src/js/hide-edit-button-checkout.js',
        array(),
        '1.0.0',
        true
    );
	add_action('wp_enqueue_scripts', 'woocommerce_readonly_addressfields_enqueue_scripts');

}


