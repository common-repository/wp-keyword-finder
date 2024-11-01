<?php

add_action('admin_init', 'WPKF_print_admin_style');
function WPKF_print_admin_style() {
    wp_enqueue_style( 'WPKF-admin-style', WPKF_URL."admin/style.css",array(), "1.0" );
}
