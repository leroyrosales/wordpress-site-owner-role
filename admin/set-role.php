<?php

// Add Site Owner role and capabilities
add_action('after_setup_theme', function (){

    if (!get_option('owner_role_created')) {
        $admin_capabilities = get_role('administrator')->capabilities;

        $unwanted_capabilities = [
            'install_plugins' => 1,
            'activate_plugins' => 1,
            'update_plugins' => 1,
            'delete_plugins' => 1,
            'edit_plugins' => 1,
            'install_themes' => 1,
            'update_themes' => 1,
            'delete_themes' => 1,
            'edit_themes' => 1,
            'update_core' => 1,
            'remove_users' => 1,
            'edit_users' => 1,
            'promote_users' => 1,
        ];

        $site_owner_capabilities = array_diff_key($admin_capabilities, $unwanted_capabilities);

        add_role('site_owner', 'Site Owner', $site_owner_capabilities);

        update_option('owner_role_created', true);
    };

});

// Remove menu access to themes
add_action( 'admin_menu', function() {

    remove_submenu_page( 'themes.php', 'themes.php' );

    // Ugly but works
    global $submenu;
    unset($submenu['themes.php'][6]); // customizer

}, 999 );


// Redirect any Site Owner role trying to access themes and customizer page
add_action( 'admin_init', function() {
	global $pagenow;
    $user = wp_get_current_user();

    if ( in_array( 'site_owner', (array) $user->roles ) ) {
        if ( $pagenow === 'themes.php' && $_SERVER['REQUEST_METHOD'] == 'GET' || $pagenow === 'customize.php' && $_SERVER['REQUEST_METHOD'] == 'GET' ) {
            wp_safe_redirect( admin_url(), 301 );
            exit;
        }
    }

});
