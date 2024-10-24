<?php
/*
Template Name: Savoir Faire
*/

include('header.php');

?>

<div class="content bg-color-background pt-20 md:pt-44">
    <?php if (have_rows('premiere_section')) : ?>
            <section class="hero-section grid grid-cols-12 pb-16 md:pb-24 px-4">

                <h1 class="font-tiempos font-light text-4xl md:text-6xl text-center col-span-10 col-start-2"><?php the_title(); ?></h1> <!-- Ajout du titre de la page -->
                <?php while (have_rows('premiere_section')) : the_row(); ?>

                    <?php 
                    // Affiche l'image de la section héros   
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                        <img class="col-span-12 md:col-span-6 md:col-start-4 pt-14 w-full" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>

                    <p class="font-untitled col-span-12 md:col-span-6 md:col-start-4 text-center pt-9 md:pt-14"><?php the_sub_field('description'); ?></p>

                <?php endwhile; ?>

            </section>
        <?php endif; ?>

        <?php if (have_rows('deuxieme_section')) : ?>
            <section class="description bg-color-secondary grid grid-cols-12 py-24 md:py-32 px-4">

                <?php while (have_rows('deuxieme_section')) : the_row(); ?>

                    <h3 class="col-span-12 md:col-span-5 font-tiempos font-light text-2xl md:text-4xl mb-9 md:mb-0"><?php the_sub_field('titre'); ?></h3>
                    <p class="col-span-12 md:col-span-4 md:col-start-7 font-untitled"><?php echo nl2br(get_sub_field('texte')); ?></p>

                <?php endwhile; ?>

            </section>
        <?php endif; ?>

        <?php if (have_rows('troisieme_section')) : ?>
            <section class="Marcu grid grid-cols-12 mx-4 mt-4 mb-12 md:m-0">

                <?php while (have_rows('troisieme_section')) : the_row(); ?>

                    <?php 
                    // Affiche la photo du portrait de Benoit
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                        <img class="order-1 md:order-2 col-span-12 md:col-span-6 md:col-start-7 w-full" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>

                    <div class="order-2 md:order-1 col-span-12 md:col-span-4 md:col-start-2 h-full flex flex-col justify-center mt-12 md:mt-0">
                        <h2 class="font-tiempos font-light text-4xl pb-14"><?php the_sub_field('titre'); ?></h2>
                        <p class="font-untitled text-base"><?php the_sub_field('texte'); ?></p>
                    </div>

                <?php endwhile; ?>

            </section>
        <?php endif; ?>
        <?php 
        // Récupère les publications de type 'savoir-faire'
        $args = array(
            'post_type' => 'savoir-faire',
            'posts_per_page' => -1,
        );
        $savoir_faire_query = new WP_Query($args);

        if ($savoir_faire_query->have_posts()) : ?>
            <section class="restaurations-et-creations bg-color-secondary">

                <h2 class="font-tiempos font-light text-4xl md:text-6xl pt-11 pb-9 md:pb-36 px-4">Nos Savoir-Faire</h2>
                
                <div class="flex overflow-x-auto gap-x-4 px-4 no-scrollbar pb-24">
                    <?php while ($savoir_faire_query->have_posts()) : $savoir_faire_query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="item flex-shrink-0 w-full md:w-fit max-w-96"> 
                            <?php 
                            $illustration = get_field('apercu');
                            if ($illustration) : ?>
                                <img class="col-span-6 col-start-4 w-full object-cover h-full max-h-96" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                            <?php endif; ?>

                            <h4 class="font-untitled font-medium text-base"><?php the_title(); ?></h4>
                            <p class="font-untitled text-base w-full md:w-3/5"><?php the_field('courte_description'); ?></p>
                        </a>
                    <?php endwhile; ?>
                </div>

            </section>
        <?php endif; 
        wp_reset_postdata(); // Réinitialise les données de la requête
        ?>
</div>

<?php
include('footer.php');
?>
