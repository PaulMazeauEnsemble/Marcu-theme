<?php
get_header();

if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="savoir-faire-article pt-44 grid grid-cols-12 bg-color-background">
        <div class="col-span-6 col-start-4">
            <?php 
                // Affiche l'image de la section héros   
                $apercu = get_field('apercu');
                if ($apercu) : ?>
                <img class="col-span-6 col-start-4 w-full" src="<?php echo esc_url($apercu['url']); ?>" alt="<?php echo esc_attr($apercu['alt']); ?>" />
            <?php endif; ?>

            <h1 class="font-tiempos font-light text-6xl mb-4 py-14"><?php the_title(); ?></h1>

            <div class="font-untitled text-base mb-8">
                <?php the_field('texte'); ?>
            </div>

            <?php 
                $images = get_field('galerie');
                if( $images ): ?>
                    <ul>
                        <?php foreach( $images as $image ): ?>
                            <li>
                                <a href="<?php echo esc_url($image['url']); ?>">
                                    <img class="w-full object-contain py-14" src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                </a>
                                <p><?php echo esc_html($image['caption']); ?></p>
                            </li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </article>
<?php endwhile; endif;

get_footer();
?>