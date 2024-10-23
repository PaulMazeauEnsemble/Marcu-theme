<div class="creation-card cursor-pointer" data-creation-id="<?php echo get_the_ID(); ?>">
    <div class="apercu overflow-hidden">
        <?php 
        // Affiche l'image de la section héros   
        $apercu = get_field('apercu');
        if ($apercu) : ?>
            <img class="w-full hover:scale-105 transition-all duration-1000" src="<?php echo esc_url($apercu['url']); ?>" alt="<?php echo esc_attr($apercu['alt']); ?>" />
        <?php endif; ?>
    </div>
    <h2 class="font-untitled font-medium text-sm pt-2"><?php the_title(); ?></h2>
    <p class="font-untitled font-regulartext-sm"><?php the_field('description'); ?></p>
   
</div>
