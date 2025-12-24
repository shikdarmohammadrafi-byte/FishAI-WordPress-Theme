<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( is_front_page() || is_home() ) : ?>
        <title><?php bloginfo( 'name' ); ?></title>
    <?php else : ?>
        <?php wp_title( '|', true, 'right' ); ?>
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-lg flex items-center justify-center">
                        <i class="fas fa-fish text-white text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-dark"><?php bloginfo( 'name' ); // FishAI ?></h1>
                </div>

                <div class="hidden md:flex space-x-8">
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s' ) ); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-dark hover:text-primary font-medium transition-colors">Home</a>
                    <?php endif; ?>
                </div>

                <button id="chatbotToggle" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                    <i class="fas fa-robot"></i>
                    <span>AI Assistant</span>
                </button>
            </div>
        </nav>
    </header>
