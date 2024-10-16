<?php
// footer.php
?>

<footer class="site-footer bg-color-background px-4 py-8">

    <div class="grid grid-cols-12 gap-x-4">
        <h1 class="font-tiempos font-light text-5xl col-span-6"><?php the_field('titre', 'option'); ?></h1>
        <p class="font-untitled font-light text-base col-span-3 col-start-7"><?php the_field('resume', 'option'); ?></p>

        <?php if (have_rows('adresse', 'option')) : ?>
            <?php while (have_rows('adresse', 'option')) : the_row(); ?>

                <div class="adresse-text col-span-2 col-start-10">
                    <p class="font-untitled font-light text-base"><?php the_sub_field('rue'); ?></p>
                    <p class="font-untitled font-light text-base"><?php the_sub_field('ville'); ?></p>
                    <p class="font-untitled font-light text-base"><?php the_sub_field('complement'); ?></p>
                </div>

            <?php endwhile; ?>
        <?php endif; ?>

        <?php 
        // Affiche l'image de la section héros   
        $illustration = get_field('logo', 'option');
        if ($illustration) : ?>
            <img class="col-span-1 col-start-12" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
        <?php endif; ?>
        
        <?php if (have_rows('liens', 'option')) : ?>
            <?php while (have_rows('liens', 'option')) : the_row(); ?>

                <div class="liens-text col-span-3 col-start-7 pt-5 flex flex-col">
                    <?php 
                    // Affiche le lien des mentions legales
                    $lien = get_sub_field('mentions_legales');
                    if ($lien) : ?>
                        <a class="font-untitled font-light text-base underline" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                            <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                    <?php 
                    // Affiche le lien de la politique de confidentialité
                    $lien = get_sub_field('politique_de_confidentialite');
                    if ($lien) : ?>
                        <a class="font-untitled font-light text-base underline" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                            <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                    <?php 
                    // Affiche le lien des CGU
                    $lien = get_sub_field('cgu');
                    if ($lien) : ?>
                        <a class="font-untitled font-light text-base underline" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                            <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>

            <?php endwhile; ?>
        <?php endif; ?>

        <?php if (have_rows('contact', 'option')) : ?>
            <?php while (have_rows('contact', 'option')) : the_row(); ?>

                <div class="contact-text col-span-2 col-start-10 flex flex-col pt-5">
                    <p class="font-untitled font-light text-base"><?php the_sub_field('telephone_1'); ?></p>
                    <p class="font-untitled font-light text-base"><?php the_sub_field('telephone_2'); ?></p>
                    <?php 
                    // Affiche le lien d'instagram
                    $lien = get_sub_field('instagram');
                    if ($lien) : ?>
                        <a class="font-untitled font-light text-base underline" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                            <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>

            <?php endwhile; ?>
        <?php endif; ?>
        
    </div>
</footer>

<?php

?>

