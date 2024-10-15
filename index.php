<?php
/*
Template Name: HomePage
*/

include('header.php');

?>

<div class="content">
    <?php if (have_rows('hero_section')) : ?>
        <section class="hero-section">

            <?php while (have_rows('hero_section')) : the_row(); ?>

                <?php 
                // Affiche le lien de la section héros 
                    $lien = get_sub_field('lien');
                    if ($lien) : ?>
                        <a href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                            <?php echo esc_html($lien['title']); ?>
                        </a>
                <?php endif; ?>

                <?php 
                // Affiche l'image de la section héros   
                $illustration = get_sub_field('illustration_hero_section');
                if ($illustration) : ?>
                    <img src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                <?php endif; ?>

            <?php endwhile; ?>

        </section>
    <?php endif; ?>

        <section class="presentation">
            <p><?php the_field('presentation'); ?></p>
        </section>

    <?php if (have_rows('notre_savoir_faire')) : ?>
        <section class="notre-savoir-faire">

            <?php while (have_rows('notre_savoir_faire')) : the_row(); ?>

                <h2><?php the_sub_field('titre'); ?></h2>

                <?php 
                // Affiche le lien de la section notre savoir faire
                $lien = get_sub_field('lien');
                if ($lien) : ?>
                    <a href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                        <?php echo esc_html($lien['title']); ?>
                    </a>
                <?php endif; ?>

                <?php 
                // Affiche l'image de la section notre savoir faire
                $illustration = get_sub_field('illustration');
                if ($illustration) : ?>
                    <img src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                <?php endif; ?>
            <?php endwhile; ?>

        </section>
    <?php endif; ?>

    <?php if (have_rows('section_restaurations_et_creations')) : ?>
        <section class="restaurations-et-creations">

            <?php while (have_rows('section_restaurations_et_creations')) : the_row(); ?>

                <h2><?php the_sub_field('presentation'); ?></h2>

                <?php 
                // Affiche le lien de la section restaurations et creations
                $lien = get_sub_field('lien');
                if ($lien) : ?>
                    <a href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                        <?php echo esc_html($lien['title']); ?>
                    </a>
                <?php endif; ?>

                <?php 
                // Affiche l'image de la section restaurations et creations
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
