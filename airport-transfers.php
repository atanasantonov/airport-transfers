<?php
/*
Plugin Name: Airport Transfers
Plugin URI:  https://github.com/atanasantonov/airport-transfers
Description: Plugin delivers multilingual form for airport transfers
Version:     1.1.2
Author:      Atanas Antonov
Author URI:  https://unax.org
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: ns-airport-transfers
Domain Path: /languages/
*/

defined( 'ABSPATH' ) or die( 'I can\'t do anything alone! Sorry!' );

define( 'NS_AIRPORT_TRANSFERS_VERSION', '1.1.2' );
define( 'NS_AIRPORT_TRANSFERS_PATH', plugin_dir_path( __FILE__ ) );
define( 'NS_AIRPORT_TRANSFERS_URL', plugins_url( '/', __FILE__ ) );

load_plugin_textdomain('ns-airport-transfers', false, basename( dirname( __FILE__ ) ) . '/languages' );

require_once( NS_AIRPORT_TRANSFERS_PATH . 'functions.php' );
require_once( NS_AIRPORT_TRANSFERS_PATH . 'admin/class-airport-transfers-admin.php' );
require_once( NS_AIRPORT_TRANSFERS_PATH . 'public/class-airport-transfers.php' );

register_activation_hook( __FILE__, 'ns_airport_transfers_activate' );
register_deactivation_hook( __FILE__, 'ns_airport_transfers_uninstall' );

if ( is_admin() ) {
    \NS_Airport_Transfers_Admin::init();
    add_action( 'init', array( '\NS_Airport_Transfers_Admin', 'init' ) );
}

\NS_Airport_Transfers::init();
