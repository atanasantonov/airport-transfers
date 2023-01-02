<?php defined( 'ABSPATH' ) or die( 'I can\'t do anything alone! Sorry!' );

if( ! class_exists( 'NS_Airport_Transfers' ) ) {

    class NS_Airport_Transfers {

        private static $initiated = false;

        /**
    	 * Init.
    	 */
    	public static function init() {
      		if( ! self::$initiated ) {
    			self::init_hooks();
    		}
    	}


        /**
         * Register hooks.
         */
        private static function init_hooks() {
            // Enqueue scripts.
            add_action( 'wp_enqueue_scripts', array( '\NS_Airport_Transfers', 'enqueue_scripts' ) );

            // Register ajax functions for the fronend.
    		add_action( 'wp_ajax_send', array( '\NS_Airport_Transfers', 'send' ) );
    		add_action( 'wp_ajax_nopriv_send', array( '\NS_Airport_Transfers', 'send' ) );

            // Shortcodes.
            add_shortcode('airport-transfers-form', array( '\NS_Airport_Transfers', 'form' ) );

            self::$initiated = true;
        }


        /**
         * Enqueue scripts.
         */
        public static function enqueue_scripts() {
            // Load css.
            wp_enqueue_style( 'bootstrap', NS_AIRPORT_TRANSFERS_URL . 'assets/bootstrap/css/bootstrap.min.css', array(), '3.3.7' );
            wp_enqueue_style( 'jquery-ui', NS_AIRPORT_TRANSFERS_URL . 'assets/jquery-ui/jquery-ui.min.css', array(), '1.12.1' );
            wp_enqueue_style( 'ns-airport-transfers',  NS_AIRPORT_TRANSFERS_URL . 'assets/css/styles.css', array( 'bootstrap', 'jquery-ui' ), NS_AIRPORT_TRANSFERS_VERSION );

            // Load scripts.
            wp_enqueue_script( 'bootstrap', NS_AIRPORT_TRANSFERS_URL . 'assets/bootstrap/js/bootstrap.min.js', array( 'jquery', 'jquery-ui-datepicker' ), '3.3.7', true );
            wp_enqueue_script( 'ns-airport-transfers', NS_AIRPORT_TRANSFERS_URL . 'assets/js/index.js', array( 'bootstrap' ), NS_AIRPORT_TRANSFERS_VERSION, true );
            wp_localize_script(
                'ns-airport-transfers',
                'nsAirportTransfers',
                array(
                    'adminUrl' => admin_url( 'admin-ajax.php' ),
                    'texts' => array(
                        'yourName' => esc_html__( 'Your Name', 'ns-airport-transfers' ),
                        'emailAddress' => esc_html__( 'Email Address', 'ns-airport-transfers' ),
                        'mobile' => esc_html__( 'Mobile', 'ns-airport-transfers' ),
                        'MandatoryField' => esc_html__( 'Mandatory Field', 'ns-airport-transfers' ),
                        'SystemError' => esc_html__( 'System Error', 'ns-airport-transfers' ),
                    )
                )
            );
        }


        /**
         * Main function to display and process the form.
         *
         * Option provided are:
         *      resort - if summer [no. of ski] field is skipped,
         *      country - concatenated with [Addres in] label, default is [add country option please]
         *      time-format - if 12 we use the 12 Hour format, default is 24
         *
         * @param array $atts    Array of options.
         * @param sring $content Content provides comma separeted airports for the dropdown, default is one option [add Airports in content please].
         *
         * @return string
         */
        public static function form( $atts, $content = '' ) {

          $params = shortcode_atts( array(
            'resort' => get_option( 'ns-airport-transfers-resort' ),
            'time-format' => get_option( 'ns-airport-transfers-time-format' ),
            'show-contacts' => '1'
          ), $atts );

          // Adjust dropdowns depending on Time format (12 or 24 Hours).
          if( strtolower( $params['time-format']) === '12' ) :
            for($i=1; $i<=12; $i++) :
              $hours[] = strval($i);
            endfor;
            $am_pm = '<option>AM/PM</option>
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>';
          else :
            for($i=0; $i<=23; $i++) :
              $hours[] = ($i<10) ? '0' . strval($i) : strval($i);
            endfor;
            $am_pm = FALSE;
          endif;

          // Adjust minutes dropdown.
          for($i=0; $i<=55; $i++) :
            if($i%5===0) :
              $minutes[] = ($i<10) ? '0' . strval($i) : strval($i);
            endif;
          endfor;

          // Process the content from the shortcode.
          $options = explode(",", $content);
          $options = (sizeof($options)>0) ? $options : array();

          array_map( 'trim', $options );

          ob_start();

          require_once( NS_AIRPORT_TRANSFERS_PATH . 'public/views/form.php' );
          require_once( NS_AIRPORT_TRANSFERS_PATH . 'public/views/modal-error.php' );

          return ob_get_clean();
        }


        /**
         * Ajax form handler.
         */
        public static function send() {
          try {
            // Check post at all.
            if( empty( $_POST ) ) {
                throw new \Exception( esc_html__( 'Incorrect data!', 'ns-airport-transfers' ) );
            }

            // Check email.
            $email = filter_var( sanitize_email( $_POST['email'] ), FILTER_VALIDATE_EMAIL );
            if ( ! $email ) {
              throw new \Exception(esc_html__( 'Invalid email address!', 'ns-airport-transfers' ) );
            }

            // Subject.
            $subject  = esc_html__( 'Request', 'ns-airport-transfers' );

            // Message.
            $message = '';

            // Information.
            $message .= esc_html__( 'Your Name', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['name'] ) ) . PHP_EOL;
            $message .= esc_html__( 'Email Address', 'ns-airport-transfers' ).": " . $email . PHP_EOL;
            $message .= esc_html__( 'Mobile', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field($_POST['phone'] ) ) . PHP_EOL;
            $message .= esc_html__( 'I would like to', 'ns-airport-transfers' ).": ".sanitize_text_field( $_POST['like_to'] ) . PHP_EOL;
            $message .= esc_html__( 'Transfer type', 'ns-airport-transfers' ).": " . sanitize_text_field( $_POST['transfer_type'] ) . PHP_EOL;
            $message .= esc_html__( 'No. of adults', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['adults'] ) ) . PHP_EOL;
            $message .= esc_html__( 'No. of children', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['children'] ) ) . PHP_EOL;
            $message .= esc_html__( 'No. of koffers', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['koffers'] ) ) . PHP_EOL;
            if(sanitize_text_field( $_POST['resort'])==='winter' ) {
              $message .= esc_html__( 'No. of ski/snowboards', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field($_POST['ski'] ) ) . PHP_EOL;
            }

            $message .= PHP_EOL;

            // transfer_type
            $transfer_type = sanitize_text_field( $_POST['transfer_type'] );

            // time format
            $time_format = sanitize_text_field( $_POST['time_format']);

            // arrival
            $post_arrival_us_time = sanitize_text_field( $_POST['arrival_us_time']);
            $arrival_us_time = ($time_format==='12'&&$post_arrival_us_time!=='') ? $post_arrival_us_time : '';
            if($transfer_type==='two_way' || $transfer_type==='from_airport') {
              $message .= esc_html__( 'Date of arrival', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['arrival_date'] ) ) . PHP_EOL;
              $message .= esc_html__( 'Time of arrival', 'ns-airport-transfers' ).": " . sanitize_text_field(  $_POST['arrival_hour'] ) . ':' . sanitize_text_field(  $_POST['arrival_minutes']).$arrival_us_time . PHP_EOL;
              $message .= esc_html__( 'Airport', 'ns-airport-transfers' ).": ".sanitize_text_field(  $_POST['arrival_airport'] ) . PHP_EOL;
              $message .= esc_html__( 'Flight number', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field(  $_POST['arrival_flight'] ) ) . PHP_EOL;
              $message .= PHP_EOL;
            }

            // departure
            $post_out_us_time = sanitize_text_field(  $_POST['out_us_time'] );
            $out_us_time = ($time_format==='12'&&$post_out_us_time!=='') ? $post_out_us_time : '';
            if($transfer_type==='two_way' || $transfer_type==='to_airport') {
              $message .= esc_html__( 'Date of departure', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['out_date'])) . PHP_EOL;
              $message .= esc_html__( 'Time of departure', 'ns-airport-transfers' ).": ".sanitize_text_field( $_POST['out_hour']).':'.sanitize_text_field( $_POST['out_minutes']).$out_us_time . PHP_EOL;
              $message .= esc_html__( 'Airport', 'ns-airport-transfers' ).": ".sanitize_text_field( $_POST['out_airport']) . PHP_EOL;
              $message .= esc_html__( 'Flight number', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['out_flight'])) . PHP_EOL;
              $message .= PHP_EOL;
            }

            // address in destination country
            $message .= esc_html__( 'Address in', 'ns-airport-transfers' ).' '.esc_html__( get_option( 'ns-airport-transfers-country' ), 'ns-airport-transfers' ) . PHP_EOL;
            $message .= esc_html__( 'Address of hotel/accommodation', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['adress'])) . PHP_EOL;

            // instructions
            $message .= esc_html__( 'Remarks/instructions', 'ns-airport-transfers' ).": " . airport_transfers_check_val( sanitize_text_field( $_POST['instructions'])) . PHP_EOL;

            // Headers
            $headers  = 'MIME-Version: 1.0' . PHP_EOL;
            $headers .= 'Content-type: text/plain; charset=utf-8' . PHP_EOL;
            $headers .= 'Content-Transfer-Encoding: 7bit' . PHP_EOL;
            $headers .= 'Message-ID: <' . time() . '-'. md5($email).'>' . PHP_EOL;
            $headers .= 'From: '.get_option('blogname').' <'.get_option('admin_email').'>' . PHP_EOL;
            $headers .= 'Return-Path: <'.get_option('admin_email').'>' . PHP_EOL;

            // get administrative emails for the form
            if( ! wp_mail( get_option('ns-airport-transfers-admin-email'), $subject, $message, $headers ) ) {
              throw new \Exception(esc_html__( 'System Error!', 'ns-airport-transfers' ));
            }

            $result['status'] = 'success';
            $result['data'] = esc_html__( 'Thank you for your submission! We will answer as soon as possible!', 'ns-airport-transfers' );

          } catch (Exception $e) {
            $result['status'] = 'error';
            $result['data'] = $e->getMessage();

            $error_message  = 'Sending mail failed!'.PHP_EOL . PHP_EOL;
            $error_message .= 'Form message:'.PHP_EOL . PHP_EOL;
            $error_message .= print_r($e->getMessage(),TRUE) . PHP_EOL;

            wp_mail( get_option('admin_email'), 'Airport Transfers Error', $error_message, $headers );
          } finally {
            echo json_encode($result);
          }
          wp_die();
        }

    }
}
