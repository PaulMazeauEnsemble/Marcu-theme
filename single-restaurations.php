<?php
get_header();
?>

<div class="content pt-44 bg-color-background">
    <div class="container mx-auto px-4">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('pb-12'); ?>>
                <header class="entry-header mb-8">
                    <h1 class="font-tiempos font-light text-5xl mb-4"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php
                    $apercu = get_field('apercu');
                    if ($apercu) :
                    ?>
                        <div class="mt-8">
                            <img src="<?php echo esc_url($apercu['url']); ?>" alt="<?php echo esc_attr($apercu['alt']); ?>" class="w-full h-auto">
                        </div>
                    <?php endif; ?>

                    <?php
                    $description = get_field('description');
                    if ($description) :
                    ?>
                        <div class="mt-8">
                            <h2 class="font-tiempos font-light text-3xl mb-4">Description</h2>
                            <p class="font-untitled text-base"><?php echo esc_html($description); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php 
                        $galerie_photos = get_field('galerie_photo');
                        if ($galerie_photos): ?>
                            <div class="galerie-photo">
                        <?php foreach ($galerie_photos as $image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Aucune image trouvée.</p>
                    <?php endif; ?>
                </div>
            </article>
        <?php
        endwhile;
        ?>
    </div>
</div>

<?php
get_footer();
?>

