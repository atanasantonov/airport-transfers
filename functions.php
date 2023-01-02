<?php

/**
 * Add the options defaults.
 */
function ns_airport_transfers_activate() {
    add_option( 'ns-airport-transfers-admin-email', get_option('admin_email') ); // Admin email delivery and contact address
    add_option( 'ns-airport-transfers-contact-email', '' ); // Contant email
    add_option( 'ns-airport-transfers-contact-phone', '' ); // Contant phone
    add_option( 'ns-airport-transfers-country', 'Earthsea' ); // Can be set in plugin's settings page or trough the shortcode
    add_option( 'ns-airport-transfers-resort', 'summer' );  // Include ski field or not. Can be set in plugin's settings page or trough the shortcode
    add_option( 'ns-airport-transfers-time-format', '24' );  // 12 or 24 Hours time format. Can be set in plugin's settings page or trough the shortcode
}


/**
 * Delete the unnecessary options from the database.
 */
function ns_airport_transfers_uninstall() {
    delete_option('ns-airport-transfers-admin-email');
    delete_option('ns-airport-transfers-contact-email');
    delete_option('ns-airport-transfers-contact-phone');
    delete_option('ns-airport-transfers-country');
    delete_option('ns-airport-transfers-resort');
    delete_option('ns-airport-transfers-time-format');
}


/**
 * Airport transfers check value.
 *
 * @param string $string
 * @return string
*/
function airport_transfers_check_val( $string='' ) {
    $string = ($string!='') ? $string : '-';

    return $string;
}
