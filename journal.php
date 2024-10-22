<?php
/*
Template Name: Journal
*/

include('header.php');
?>

<div class="content bg-color-background pt-44">
    <div class="pb-36 border-b grid grid-cols-12">
        <h1 class="font-tiempos font-light text-6xl text-center col-span-6 col-start-4 pb-14"><?php the_title(); ?></h1>
        <p class="font-untitled text-base text-center col-span-6 col-start-4"><?php the_field('texte'); ?></p>
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
                    <div class="py-10 grid grid-cols-12 border-b px-4">
                        <h2 class="font-tiempos font-medium text-4xl col-span-3"><?php the_title(); ?></h2>
                    <div class="article-image col-span-4 col-start-5">
                        <?php 
                        $image = get_field('apercu');
                        if ($image) : ?>
                            <img class="w-full" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <p class="font-untitled text-base col-span-3 col-start-10"><?php the_field('extrait'); ?></p>
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
