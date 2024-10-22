<?php get_header(); ?>

<div id="primary" class="content bg-color-background pt-44 min-h-[calc(100vh-215px)] grid grid-cols-12">
    <main id="main" class="site-main col-span-6 col-start-4">
        <?php
        while ( have_posts() ) :
            the_post(); 
            the_content();
        endwhile;
        ?>
    </main>
</div>

<?php get_footer(); ?>