<?php
/*
Template Name: Création
*/

include('header.php');
?>

<div class="content pt-44 bg-color-background">
        <section class="hero grid grid-cols-12 gap-x-4 px-4 pb-8">

            <div class="hero-text col-span-6 col-start-1 flex flex-col justify-between">
                <h1 class="font-tiempos font-light text-5xl col-span-10 col-start-2"><?php the_field('titre'); ?></h1>
                <p class="font-untitled text-base col-span-10 col-start-2"><?php echo nl2br(get_field('description')); ?></p>
            </div>

            <div class="hero-image col-start-7 col-span-6">
                <?php 
                // Affiche l'image de la section notre savoir faire
                $image = get_field('image');
                if ($image) : ?>
                    <img class="w-full" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
            </div>

        </section>

        <div class="filter pb-4 pt-20">
            <p>Filtrer</p>
        </div>
    <?php
    // Début de la boucle WordPress pour les posts de type 'creations'
    $args = array(
        'post_type' => 'creations',
        'posts_per_page' => -1 // Récupérer tous les posts
    );
    $creations_query = new WP_Query($args);

    if ($creations_query->have_posts()) :
        while ($creations_query->have_posts()) : $creations_query->the_post();
            // Inclure le composant restauration-card.php
            include('components/creation-card.php');
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Aucune création trouvée.</p>';
    endif;
    ?>
</div>

<?php
include('footer.php');
?>
