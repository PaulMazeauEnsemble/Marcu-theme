<?php
/*
Template Name: Savoir Faire
*/

include('header.php');

?>

<div class="content">
    <?php if (have_rows('premiere_section')) : ?>
            <section class="hero-section">

                <?php while (have_rows('premiere_section')) : the_row(); ?>

                    <?php 
                    // Affiche l'image de la section héros   
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                        <img src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>

                    <p><?php the_sub_field('description'); ?></p>

                <?php endwhile; ?>

            </section>
        <?php endif; ?>

        <?php if (have_rows('deuxieme_section')) : ?>
            <section class="description">

                <?php while (have_rows('deuxieme_section')) : the_row(); ?>

                    <p><?php the_sub_field('titre'); ?></p>
                    <p><?php the_sub_field('texte'); ?></p>

                <?php endwhile; ?>

            </section>
        <?php endif; ?>

        <?php if (have_rows('troisieme_section')) : ?>
            <section class="notre-savoir-faire">

                <?php while (have_rows('troisieme_section')) : the_row(); ?>

                    <h2><?php the_sub_field('titre'); ?></h2>
                    <p><?php the_sub_field('texte'); ?></p>

                    <?php 
                    // Affiche la photo du portrait de Benoit
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                        <img src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>
                <?php endwhile; ?>

            </section>
        <?php endif; ?>

        <?php if (have_rows('quatrieme_section')) : ?>
            <section class="restaurations-et-creations">

                <?php while (have_rows('quatrieme_section')) : the_row(); ?>

                    <h2><?php the_sub_field('titre'); ?></h2>
                    <p><?php the_sub_field('description'); ?></p>

                    <?php 
                    // Affiche les photo des restaurations et creations
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                        <img src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>
                    
                <?php endwhile; ?>

            </section>
    <?php endif; ?>
</div>

<?php
include('footer.php');
?>
