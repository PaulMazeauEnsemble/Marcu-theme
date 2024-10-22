<?php
get_header();
?>

<div class="content bg-color-background pt-44 pb-14 grid grid-cols-12">
        <?php 
        $image = get_field('apercu');
        if ($image) : ?>
            <img class="col-span-6 col-start-4 w-full" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
        <h1 class="font-tiempos font-light text-6xl col-span-6 col-start-4 my-14"><?php the_title(); ?></h1>
        <p class="font-untitled text-base col-span-6 col-start-4"><?php the_field('texte'); ?></p>
</div>

<?php
get_footer();
?>

