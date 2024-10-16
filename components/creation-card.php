<div class="creation-card">
    <h2><?php the_title(); ?></h2>
    <p><?php the_field('description'); ?></p>
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
    <div class="apercu">
        <?php 
        // Affiche l'image de la section héros   
        $apercu = get_field('apercu');
        if ($apercu) : ?>
            <img src="<?php echo esc_url($apercu['url']); ?>" alt="<?php echo esc_attr($apercu['alt']); ?>" />
        <?php endif; ?>
    </div>
</div>
