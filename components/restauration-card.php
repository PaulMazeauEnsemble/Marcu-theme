<div class="restauration-card">
    <div class="apercu">
        <?php 
        // Affiche l'image de la section héros   
        $apercu = get_field('apercu');
        if ($apercu) : ?>
            <img src="<?php echo esc_url($apercu['url']); ?>" alt="<?php echo esc_attr($apercu['alt']); ?>" />
        <?php endif; ?>
    </div>
    <h2 class="font-untitled font-medium text-sm pt-2"><?php the_title(); ?></h2>
    <p class="font-untitled font-regulartext-sm"><?php the_field('description'); ?></p>
   
</div>
