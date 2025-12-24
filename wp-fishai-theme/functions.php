<?php
// Theme setup
function fishai_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array( 'primary' => __( 'Primary Menu', 'fishai' ) ) );
}
add_action( 'after_setup_theme', 'fishai_theme_setup' );

// Enqueue scripts and styles
function fishai_enqueue_assets() {
    // Font Awesome
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3' );

    // Tailwind CDN (loads in head)
    wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false );

    // Add inline tailwind config
    $tailwind_config = "tailwind.config = {\n            theme: {\n                extend: {\n                    colors: {\n                        primary: '#1e40af',\n                        secondary: '#0ea5e9',\n                        accent: '#10b981',\n                        dark: '#1e293b',\n                        light: '#f8fafc'\n                    },\n                    animation: {\n                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',\n                        'float': 'float 6s ease-in-out infinite',\n                    },\n                    keyframes: {\n                        float: {\n                            '0%, 100%': { transform: 'translateY(0px)' },\n                            '50%': { transform: 'translateY(-20px)' },\n                        }\n                    }\n                }\n            }\n        };";
    wp_add_inline_script( 'tailwind-cdn', $tailwind_config );

    // Theme custom styles
    wp_enqueue_style( 'fishai-style', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0' );

    // Main JS
    wp_enqueue_script( 'fishai-js', get_template_directory_uri() . '/assets/js/fishai.js', array(), '1.0', true );

    // Provide useful data to JS
    wp_localize_script( 'fishai-js', 'fishaiData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'themeUrl' => get_template_directory_uri(),
    ) );
}
add_action( 'wp_enqueue_scripts', 'fishai_enqueue_assets' );
