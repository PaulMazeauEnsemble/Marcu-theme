<?php
/*
Template Name: Restauration
*/

include('header.php');
?>

<div class="content pt-44 bg-color-background">
        <section class="hero grid grid-cols-12 gap-x-4 px-4 pb-8">

            <div class="hero-text col-span-6 col-start-1 flex flex-col justify-between">
                <h1 class="font-tiempos font-light text-5xl col-span-10 col-start-2"><?php the_field('titre'); ?></h1>
                <p class="font-untitled col-span-10 col-start-2 text-2xl"><?php echo nl2br(get_field('description')); ?></p>
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

        <div class="grid grid-cols-12">
            <?php
            $args = array(
                'post_type' => 'restaurations',
                'posts_per_page' => -1
            );
            $restaurations_query = new WP_Query($args);

            if ($restaurations_query->have_posts()) :
                $count = 0;
                $line_items = 0;

                while ($restaurations_query->have_posts()) : $restaurations_query->the_post();

                    if ($line_items == 0) : // Début d'une nouvelle ligne
                        $empty_position = rand(1, 2); // Position aléatoire pour l'espace vide (2ème ou 3ème position)
                    endif;

                    if ($line_items == $empty_position) :
                        echo '<div class="col-span-3"></div>'; // Espace vide
                        $line_items++;
                    endif;

                    if ($line_items < 4) :
    ?>
                        <div class="col-span-3 p-4">
                            <?php include('components/restauration-card.php'); ?>
                        </div>
    <?php
                        $line_items++;
                    endif;

                    $count++;

                    if ($line_items == 4) :
                        echo '<div class="col-span-12"></div>'; // Forcer une nouvelle ligne
                        $line_items = 0;
                    endif;

                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Aucune restauration trouvée.</p>';
            endif;
            ?>
        </div>
    <?php
    ?>
</div>

<?php
include('footer.php');
?>
