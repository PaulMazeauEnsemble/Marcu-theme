<?php get_header(); ?>

<div id="primary" class="content bg-color-background pt-44">
    <main id="main" class="site-main ">
        <?php
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
        ?>
    </main>
</div>

<?php get_footer(); ?>