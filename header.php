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
    <div class="fixed top-0 left-0 right-0 flex items-center justify-between bg-color-background z-50 px-4 py-3">
        <nav class="flex-1">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'left-menu',
                'container' => false,
                'menu_class' => 'flex space-x-4 text-base font-untitled font-light text-gray-400'
            ));
            ?>
        </nav>
        <div id="logo" class="h-auto w-24 flex justify-center items-center transition-all duration-500 ">
            <?php the_custom_logo(); ?>
        </div>
        <nav class="flex-1 text-right">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'right-menu',
                'container' => false,
                'menu_class' => 'flex space-x-4 justify-end text-base font-untitled font-light text-gray-400'
            ));
            ?>
        </nav>
    </div>

    <script>
        window.addEventListener('scroll', function() {
            const logo = document.getElementById('logo');
            if (window.scrollY > window.innerHeight) {
                logo.classList.add('h-auto', 'w-10');
                logo.classList.remove('h-auto', 'w-24');
            } else {
                logo.classList.add('h-auto', 'w-24');
                logo.classList.remove('h-auto', 'w-10');
            }
        });
    </script>
</body>
</html>
