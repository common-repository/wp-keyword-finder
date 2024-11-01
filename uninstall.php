<?php

// when uninstall

if( !defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') ) exit;

delete_option("WPKF_default_country");
delete_option("WPKF_default_language");