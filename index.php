<?php
/*
Template Name: HomePage
*/

include('header.php');

?>

<div class="content bg-color-background pt-44">
    <?php if (have_rows('hero_section')) : ?>
        <section class="hero-section grid grid-cols-12 gap-x-4 px-4">

            <?php while (have_rows('hero_section')) : the_row(); ?>

                <div class="hero-section-content col-span-6">
                    <?php 
                    // Affiche l'image de la section héros   
                    $illustration = get_sub_field('illustration_hero_section');
                    if ($illustration) : ?>
                        <img class="w-full" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>

                    <?php 
                    // Affiche le lien de la section héros 
                        $lien = get_sub_field('lien');
                        if ($lien) : ?>
                            <a class="font-tiempos font-light text-6xl mt-4" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                                <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>

            <?php endwhile; ?>

        </section>
    <?php endif; ?>

        <section class="presentation grid grid-cols-12 gap-x-4 my-44">
            <h1 class="font-tiempos font-light text-5xl text-center col-span-10 col-start-2"><?php the_field('presentation'); ?></h1>
        </section>

    <?php if (have_rows('notre_savoir_faire')) : ?>
        <section class="notre-savoir-faire bg-color-primary grid grid-cols-12 gap-x-4 pt-44">

            <?php while (have_rows('notre_savoir_faire')) : the_row(); ?>

                <div class="notre-savoir-faire-text col-span-5 col-start-1 pl-16 pb-10 flex flex-col justify-end">
                    <h2 class="font-tiempos font-light text-4xl"><?php the_sub_field('titre'); ?></h2>

                    <?php 
                    // Affiche le lien de la section notre savoir faire
                    $lien = get_sub_field('lien');
                    if ($lien) : ?>
                        <a class="font-untitled font-light text-base underline pt-11" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                            <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="notre-savoir-faire-image col-span-6 col-start-7">
                    <?php 
                    // Affiche l'image de la section notre savoir faire
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                        <img class="w-full" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>
                </div>

            <?php endwhile; ?>

        </section>
    <?php endif; ?>

    <?php if (have_rows('section_restaurations_et_creations')) : ?>
        <section class="restaurations-et-creations grid grid-cols-12 py-32">

            <?php $index = 0; //Je veux que le premier élément soit en position 2 et le second en position 8?>
            <?php while (have_rows('section_restaurations_et_creations')) : the_row(); ?>

                <div class="restaurations-et-creations-content col-span-4 <?php echo $index === 0 ? 'col-start-2' : 'col-start-8'; ?>">
                    <?php 
                    // Affiche l'image de la section restaurations et creations
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                    <img class="w-full" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                <?php endif; ?>

                <div class="restaurations-et-creations-text pt-4">
                    <p class="font-untitled font-light text-base"><?php the_sub_field('presentation'); ?></p>

                <?php 
                // Affiche le lien de la section restaurations et creations
                $lien = get_sub_field('lien');
                if ($lien) : ?>
                    <a class="font-untitled font-light text-base underline" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                        <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
                </div>

                <?php $index++; ?>
            <?php endwhile; ?>

        </section>
    <?php endif; ?>

    <?php 
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 7,
        );
        $savoir_faire_query = new WP_Query($args);

        if ($savoir_faire_query->have_posts()) : ?>
            <section class="Journal bg-color-secondary">

            <div class="flex justify-between items-end w-full pt-11 pb-14 px-4">
                <h2 class="font-tiempos font-light text-6xl">Journal</h2>
                <div class="flex gap-x-1 items-center">
                    <a class="font-untitled font-light text-[14px] underline" href="<?php echo esc_url(get_permalink(get_page_by_path('journal'))); ?>">Voir toutes les publications</a>
                    <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.5 7.00781L4 4.00781L0.500001 1.00781" stroke="black"/>
                    </svg>
                </div>
            </div>

                <div class="flex overflow-x-auto gap-x-4 px-4 no-scrollbar pb-24">
                    <?php while ($savoir_faire_query->have_posts()) : $savoir_faire_query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="item flex-shrink-0 w-fit max-w-96"> 
                            
                        <?php 
                        $illustration = get_field('apercu');
                        if ($illustration) : ?>
                            <img class="col-span-6 col-start-4 w-full object-cover h-full max-h-96" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                        <?php endif; ?>

                            <h4 class="font-untitled font-medium text-base"><?php the_title(); ?></h4>
                            <p class="font-untitled text-base w-3/5"><?php the_field('extrait'); ?></p>
                        </a>
                    <?php endwhile; ?>
                </div>

            </section>
        <?php endif; 
        wp_reset_postdata(); 
        ?>

<?php
include('footer.php');
?>
