<?php
/**
 * Plugin Name:       Armstrong Find a Rep Plugin
 * Plugin URI:        https://github.com/JackRie/armstrong-find-a-rep
 * Description:       This plugin provides a form for users to fill out. Once the form is completed it checks Armstrong's Salesforce CRM and sends back the rep that best matches the user's needs.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Fairly Painless
 * Author URI:        https://fairlypainless.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/JackRie/armstrong-find-a-rep
 * Text Domain:       arm-fr
 * Domain Path:       /languages
 */

if( ! defined('ABSPATH') ) exit; //Exit if accessed directly

//  Define plugin constants
define('ARMFR_PATH', trailingslashit( plugin_dir_path(__FILE__) ));
define('ARMFR_URL', trailingslashit( plugins_url('/', __FILE__) ));

class ArmstrongFindARep {
    function __construct() {
        add_action('init', array($this, 'styles_and_scripts'));
        add_action('admin_menu', array($this, 'add_admin_page'));
        add_action('admin_init', array($this, 'settings_fields') );
        add_shortcode( 'find-a-rep-form', array($this, 'form_shortcode') );
        add_action('rest_api_init', array($this, 'create_rest_route'));
    }

    function styles_and_scripts() {
        wp_register_script('arm-fr-script', ARMFR_URL . '/build/index.js', array('wp-element'), 1.2, true);
        wp_localize_script('arm-fr-script', 'armObj', array(
            'urls' => array(
                'proxyTest' => rest_url('armstrong-international/v1/proxy-token'),
                'proxy'     => rest_url('armstrong-international/v1/proxy'),
              ),
              'nonce' => wp_create_nonce('wp_rest'),
              'productLines' => get_option('arm-fr-product-line'),
              'industries' => get_option('arm-fr-industry')
        ));
        wp_register_style('arm-fr-style', ARMFR_URL . '/build/index.css');
    }

    function settings_fields() {
        // API Call Settings
        add_settings_section( 'arm-fr_section', "API Settings", null, 'arm-fr-settings-page' );
        // Grant Type
        add_settings_field('arm-fr-grant-type', 'Grant Type', array($this, 'textInputHtml'), 'arm-fr-settings-page', 'arm-fr_section', array('name' => 'arm-fr-grant-type'));
        register_setting('armfrplugin', 'arm-fr-grant-type', array('sanitize_callback' => 'sanitize_text_field', 'default' => NULL));
        // Client ID
        add_settings_field('arm-fr-client-id', 'Client ID', array($this, 'textInputHtml'), 'arm-fr-settings-page', 'arm-fr_section', array('name' => 'arm-fr-client-id'));
        register_setting('armfrplugin', 'arm-fr-client-id', array('sanitize_callback' => 'sanitize_text_field', 'default' => NULL));
        // Client Secret
        add_settings_field('arm-fr-client-secret', 'Client Secret', array($this, 'textInputHtml'), 'arm-fr-settings-page', 'arm-fr_section', array('name' => 'arm-fr-client-secret'));
        register_setting('armfrplugin', 'arm-fr-client-secret', array('sanitize_callback' => 'sanitize_text_field', 'default' => NULL));
        // Username
        add_settings_field('arm-fr-username', 'Username', array($this, 'usernameHtml'), 'arm-fr-settings-page', 'arm-fr_section');
        register_setting('armfrplugin', 'arm-fr-username', array('sanitize_callback' => 'sanitize_email', 'default' => NULL));
        // Password
        add_settings_field('arm-fr-password', 'Password', array($this, 'textInputHtml'), 'arm-fr-settings-page', 'arm-fr_section', array('name' => 'arm-fr-password'));
        register_setting('armfrplugin', 'arm-fr-password', array('sanitize_callback' => 'sanitize_text_field', 'default' => NULL));

        // Form Settings
        add_settings_section( 'arm-fr_section_form', 'Form Settings', null, 'arm-fr-settings-page' );
        // Product Line 
        add_settings_field('arm-fr-product-line', 'Product Lines', array($this, 'productLineHTML'), 'arm-fr-settings-page', 'arm-fr_section_form', array('productLineValues' => array('Ancillary Products', 'Flow Measurement', 'Heat Transfer', 'Hot Water', 'Humidification', 'Pressure & Temperature / Control Valves', 'Service', 'Smart Product', 'Steam & Condensate') ));
        register_setting('armfrplugin', 'arm-fr-product-line', array($this, 'validateOptions'));
        // Industries
        add_settings_field('arm-fr-industry', 'Industries', array($this, 'industriesHTML'), 'arm-fr-settings-page', 'arm-fr_section_form', array('industryValues' => array('Cannabis', 'Chemical Refining', 'Data Center', 'Education', 'Food & Beverage', 'Government', 'Healthcare', 'Hospitality', 'Pharmaceutical', 'Other') ));
        register_setting('armfrplugin', 'arm-fr-industry', array($this, 'validateOptions'));
    }

    function textInputHtml($args) { ?>
        <input type="text" name="<?php echo $args['name']?>" value="<?php echo esc_attr(get_option($args['name']));?>">
    <?php
    }

    function usernameHtml() { ?>
        <input type="email" name="arm-fr-username" value="<?php echo esc_attr(get_option('arm-fr-username'));?>">
    <?php
    }

    function productLineHTML($args) { 
        $prod_options = $args['productLineValues'];
        $options = get_option('arm-fr-product-line');
        $arm_fr_product_line = isset( $options )
        ? (array) $options : [];

        foreach($prod_options as $checkbox) { ?>
            <div>
                <label>
                    <input type="checkbox" name="arm-fr-product-line[]" value="<?php echo $checkbox; ?>" <?php checked(in_array($checkbox, $arm_fr_product_line), 1) ?> >
                <?php echo $checkbox; ?></label>
            </div>
    <?php
        }
    }

    function industriesHTML($args) { 
        $ind_options = $args['industryValues'];
        $options = get_option('arm-fr-industry');
        $arm_fr_industry = isset( $options )
        ? (array) $options : [];

        foreach($ind_options as $checkbox) { ?>
            <div>
                <label>
                    <input type="checkbox" name="arm-fr-industry[]" value="<?php echo $checkbox; ?>" <?php checked(in_array($checkbox, $arm_fr_industry), 1) ?> >
                <?php echo $checkbox; ?></label>
            </div>
    <?php
        }
    }

    function validateOptions($inputs) {
        $sanitized_input = array();
        foreach($inputs as $input) {
            array_push($sanitized_input, sanitize_text_field( $input ));
        }
        return $sanitized_input;
    }

    function add_admin_page() {
        add_options_page( 'Armstrong Find A Rep Settings', __('Armstrong Find A Rep', 'arm-fr'), 'manage_options', 'arm-fr-settings-page', array($this, 'add_admin_html') );
    }

    function add_admin_html() { ?>
        <div class="wrap">
            <h2><?php _e("Armstrong Find A Rep Settings") ?></h2>
            <h3>Use the fields below to set up creditials for Salesforce API Call.</h3>
            <form action="options.php" method="POST">
                <?php 
                settings_fields('armfrplugin');
                do_settings_sections('arm-fr-settings-page'); 
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }

    function form_shortcode() {
        $output = '<div id="find-a-rep"></div>';
        wp_enqueue_script('arm-fr-script', ARMFR_URL . '/build/index.js', array('wp-element'), 1.2, true);
        wp_enqueue_style('arm-fr-style', ARMFR_URL . '/build/index.css');
        return $output;
    }

    //Helpful Article: https://ghostinspector.com/blog/develop-wordpress-plugin-with-webpack-and-react/
    function build_proxy_token(WP_REST_Request $request) {
        // Setup Query Params for API Call To Get Salesforce Token
        $params['grant_type'] = get_option('arm-fr-grant-type');
        $params['client_id'] = get_option('arm-fr-client-id');
        $params['client_secret'] = get_option('arm-fr-client-secret');
        $params['username'] = get_option('arm-fr-username');
        $params['password'] = get_option('arm-fr-password');
        // Build HTTP Query With Above Params
        $paramaters = http_build_query($params);
        // URL Decode So Special Characters Don't Appear
        $query = urldecode($paramaters);
        // Create Remote Post To Recieve Token
        $getToken = wp_remote_post( 'https://login.salesforce.com/services/oauth2/token?', 
        array(
            'headers' => array(
                'Cookie'       => 'BrowserId=unsAxTdPEeyddq_3TSkKyg; CookieConsentPolicy=0:0; LSKey-c$CookieConsentPolicy=0:0',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ), 
            'body' => $query,
            'data' => ''
        ));
        // Return Token
        return json_decode(wp_remote_retrieve_body($getToken), true);                               
    }

    function build_proxy(WP_REST_Request $request) {
        // Get Data From Our WP REST POST Request
        $body = $request->get_params();
        // JSON Encode To Use In Body Of Request Below
        $acctInfo = json_encode($body['data']);
        // Grab Token From Body
        $token = $body['token'];
        // Create Remote Post To Receive Response For Reps
        $request = wp_remote_post( $token['instance_url'] . '/services/apexrest/FindAccountRepService/V1', 
        array(
            'headers' => array(
                'Authorization' => $token['token_type'] . ' ' . $token['access_token'],
                'Cookie'        => 'BrowserId=unsAxTdPEeyddq_3TSkKyg; CookieConsentPolicy=0:0; LSKey-c$CookieConsentPolicy=0:0',
                'Content-Type'  => 'application/json'
            ),
            'body' => $acctInfo
        ));
        // Return Rep Repsonse
        return json_decode(wp_remote_retrieve_body($request));
    }

    // Set Up Our Own Rest Routes To Call Armstrong's Saleforce API
    function create_rest_route() {
        register_rest_route( 'armstrong-international/v1', '/proxy-token', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => array($this, 'build_proxy_token'),
        ) );
        register_rest_route( 'armstrong-international/v1', '/proxy', array(
            'methods'  => WP_REST_Server::EDITABLE,
            'callback' => array($this, 'build_proxy'),
        ) );
    }

}

$armstrongFindARep = new ArmstrongFindARep();