<?php
// Define ACF Path and URL
define( 'ARMFR_INC_PATH', plugin_dir_path( __FILE__ ));
define( 'ARMFR_ACF_PATH', plugin_dir_path( __FILE__ ) . 'lib/advanced-custom-fields/');
define( 'ARMFR_ACF_URL', plugin_dir_url( __FILE__ ) . 'lib/advanced-custom-fields/');

// Include ACF in our plugin
include_once( ARMFR_ACF_PATH . 'acf.php' );
// Check if ACF is already installed on site
$armfr_show_acf_admin = false;
if(class_exists('ACF')) {
    $armfr_show_acf_admin = true;
}
add_filter('acf/settings/url', 'armfr_acf_settings_url');
add_filter('acf/settings/show_admin', 'armfr_acf_show_admin');

function armfr_acf_settings_url( $url ) {
    return ARMFR_ACF_URL;
}
// Hide from admin column unless ACF is already installed on site
function armfr_acf_show_admin( $show_admin ) {
    global $armfr_show_acf_admin;
    return $armfr_show_acf_admin;
}

// Warn if ACF is already installed and is outdated compared to the version we included
add_action('views_edit-armfr-event', 'armfr_older_acf_warning');

function armfr_older_acf_warning( $views ) {
    global $acf;
    $acf_ver = (float)$acf->settings['version'];
    $acf_ver_req = 5.8;

    if( $acf_ver < $acf_ver_req ) {
        echo '<div class="update-nag notice notice-warning inline"><p>You are using an older version of Advanced Custom Fields. Fairly Painless Events Plugin plugin requires ' . $acf_ver_req . ' or higher. Some features of this plugin may not work until Advanced Custom Fields is updated.</p></div>';
    }
    
    return $views;

}

// Indlude Our ACF Field Settings
include(  ARMFR_INC_PATH . 'field-settings.php');