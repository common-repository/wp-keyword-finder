<?php
if ( !function_exists( 'add_action' ) ) {
    echo 'You are not allowed to enter.';
    exit;
}

//create menu
add_action( 'admin_menu', 'WPKF_menu' );
function WPKF_menu(){
	add_options_page( 'Keyword Finder', 'Keyword Finder', 'manage_options', 'wpkf_keyword_finder_dashboard', 'wpkf_keyword_finder_dashboard', 7);
}

require_once WPKF_DIR . 'admin/admin.php';