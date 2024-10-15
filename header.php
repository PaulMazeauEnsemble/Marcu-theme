<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
   
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=Instrument+Serif:ital@0;1&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
</head>
<body <?php body_class(); ?>>
    <div class="flex items-center justify-between">
        <nav class="flex-1">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'left-menu',
                'container' => false,
                'menu_class' => 'flex space-x-4'
            ));
            ?>
        </nav>
        <div class="h-20 w-20 flex justify-center">
            <?php the_custom_logo(); ?>
        </div>
        <nav class="flex-1 text-right">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'right-menu',
                'container' => false,
                'menu_class' => 'flex space-x-4 justify-end'
            ));
            ?>
        </nav>
    </div>
</body>
</html>
