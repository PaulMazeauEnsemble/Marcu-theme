<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
   
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/styles.css">
    <style>
        .line {
            transition: all 0.5s ease-in-out;
            transform-origin: right center;
        }
        .menu-open .line-top {
            transform: translateY(-4px) rotate(-45deg);
        }
        .menu-open .line-middle {
            opacity: 0;
        }
        .menu-open .line-bottom {
            transform: translateY(4px) rotate(45deg);
        }
    </style>
</head>
<body <?php body_class(); ?>>
    <div class="fixed top-0 left-0 right-0 flex items-center justify-between bg-color-background z-50 px-4 py-3">
        <nav class="flex-1 hidden md:flex">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'left-menu',
                'container' => false,
                'menu_class' => 'flex space-x-4 text-base font-untitled font-light text-black'
            ));
            ?>
        </nav>
        <div id="logo" class="h-auto w-11 md:w-24 flex justify-center items-center transition-all duration-500 mx-auto">
            <?php the_custom_logo(); ?>
        </div>
        <nav class="flex-1 hidden md:flex justify-end">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'right-menu',
                'container' => false,
                'menu_class' => 'flex space-x-4 justify-end text-base font-untitled font-light text-black'
            ));
            ?>
        </nav>
    <!-- Menu Burger -->
    <div class="md:hidden absolute right-0 pr-4 flex items-center justify-center">
        <button id="menu-toggle" class="text-black focus:outline-none">
            <svg width="30" height="22" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="line line-top" d="M4 4H14" stroke="black" stroke-width="1"/>
                <path class="line line-middle" d="M4 7H14" stroke="black" stroke-width="1"/>
                <path class="line line-bottom" d="M4 10H14" stroke="black" stroke-width="1"/>
            </svg>
        </button>
    </div>
    </div>

    <!-- Menu déroulant -->
    <div id="mobile-menu" class="fixed left-0 right-0 sm:hidden bg-color-background z-40 transform translate-y-[-100%] transition-all duration-500 ease-in-out">
        <div class="flex flex-col py-12">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'left-menu',
                'container' => false,
                'menu_class' => 'flex flex-col space-y-2 text-xl font-untitled font-light text-black text-center gap-y-9 pb-9'
            ));
            wp_nav_menu(array(
                'theme_location' => 'right-menu',
                'container' => false,
                'menu_class' => 'flex flex-col space-y-2 text-xl font-untitled font-light text-black text-center gap-y-9'
            ));
            ?>
        </div>
    </div>

    <script>
        const logo = document.getElementById('logo');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuToggle = document.getElementById('menu-toggle');
        let isMenuOpen = false;

        function updateMobileMenuPosition() {
            const logoHeight = logo.offsetHeight;
            mobileMenu.style.top = `${logoHeight}px`;
        }

        function adjustLogoSize() {
            if (window.scrollY > window.innerHeight / 2 && !isMenuOpen) {
                logo.classList.add('h-auto', 'w-8', 'md:w-10');
                logo.classList.remove('h-auto', 'w-11', 'md:w-24');
            } else {
                logo.classList.add('h-auto', 'w-11', 'md:w-24');
                logo.classList.remove('h-auto', 'w-8', 'md:w-10');
            }
            updateMobileMenuPosition();
        }

        window.addEventListener('scroll', adjustLogoSize);
        window.addEventListener('resize', updateMobileMenuPosition);

        menuToggle.addEventListener('click', function() {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                mobileMenu.classList.remove('translate-y-[-100%]');
                menuToggle.classList.add('menu-open');
            } else {
                mobileMenu.classList.add('translate-y-[-100%]');
                menuToggle.classList.remove('menu-open');
            }
            adjustLogoSize();
        });

        // Initialisation
        updateMobileMenuPosition();
    </script>
</body>
</html>
