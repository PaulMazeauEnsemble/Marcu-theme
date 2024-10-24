<?php
/*
Template Name: Journal
*/

include('header.php');
?>

<div class="content bg-color-background pt-20 md:pt-44">
    <div class="pb-24 md:pb-36 border-b grid grid-cols-1 md:grid-cols-12">
        <h1 class="font-tiempos font-light text-4xl md:text-6xl text-center col-span-6 col-start-4 pb-9 md:pb-14"><?php the_title(); ?></h1>
        <p class="font-untitled text-base md:text-base text-center col-span-6 col-start-4 px-4 md:px-0"><?php the_field('texte'); ?></p>
    </div>
    <div class="articles-list">
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1 
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                <a href="<?php the_permalink(); ?>" class="article-item">
                    <div class="py-10 grid grid-cols-12 border-b px-4 md:grid-cols-12 md:grid-flow-col">
                        <div class="article-image col-span-12 md:col-span-4 md:col-start-5 order-1 md:order-none">
                            <?php 
                            $image = get_field('apercu');
                            if ($image) : ?>
                                <img class="w-full" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                        </div>
                        <h2 class="font-tiempos font-medium text-4xl col-span-12 md:col-span-3 order-2 md:order-none my-6 md:my-0"><?php the_title(); ?></h2>
                        <p class="font-untitled text-base col-span-12 md:col-span-3 md:col-start-10 order-3 md:order-none"><?php the_field('extrait'); ?></p>
                    </div>
                </a>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Aucun article trouvé.</p>';
        endif;
        ?>
    </div>
</div>

<?php
get_footer();
?>
