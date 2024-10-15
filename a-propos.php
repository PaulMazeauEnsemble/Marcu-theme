<?php
/*
Template Name: A-propos
*/

get_header(); ?>

<div class="content">
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <div class="grid grid-cols-1 md:grid-cols-10 gap-4 h-auto md:h-screen pt-32 px-4 md:px-8">
            <div class="md:col-span-5">
                <h1 class="text-white text-4xl pb-16 font-Instrument"><?php the_field('titre'); ?></h1>
                <div class="text-white font-DM">
                    <?php 
                    $paragraphe = get_field('paragraphe');
                    $lines = explode("\n", $paragraphe); // Diviser le texte en lignes
                    foreach ($lines as $line) {
                        if (trim($line) === '') {
                            echo '<br>'; // Ajouter une balise <br> pour les lignes vides
                        } else {
                            echo '<p>' . esc_html($line) . '</p>'; // Envelopper les lignes non vides dans des balises <p>. Cela permet de bien gérer le cas des paragraphes via ACF.
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="md:col-span-5 flex justify-center items-center my-8 md:my-0">
                <?php 
                $portrait = get_field('portrait');
                $portrait_url = $portrait['url']; 
                ?>
                <img src="<?php echo esc_url($portrait_url); ?>" alt="Portrait" class="h-2/3">
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
