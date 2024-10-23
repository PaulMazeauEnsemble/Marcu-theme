<?php
/*
Template Name: HomePage
*/

include('header.php');

?>

<div class="content bg-color-background pt-20 md:pt-44">
    <?php if (have_rows('hero_section')) : ?>
        <section class="hero-section grid grid-cols-1 md:grid-cols-12 gap-x-4 px-4">
            <?php while (have_rows('hero_section')) : the_row(); ?>
                <div class="hero-section-content col-span-1 md:col-span-6 mb-6 md:mb-0">
                    <?php 
                    $illustration = get_sub_field('illustration_hero_section');
                    $lien = get_sub_field('lien');
                    if ($illustration) : ?>
                        <?php if ($lien) : ?>
                            <a href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                        <?php endif; ?>
                            <img class="w-full mb-3" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                        <?php if ($lien) : ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php 
                    if ($lien) : ?>
                        <a class="font-tiempos font-light text-4xl md:text-6xl" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                            <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

    <section class="presentation grid grid-cols-1 md:grid-cols-12 gap-x-4 my-24 md:my-44">
        <h1 class="font-tiempos font-light text-3xl md:text-5xl text-center col-span-10 col-start-1 md:col-start-2 px-4 md:px-0"><?php the_field('presentation'); ?></h1>
    </section>

    <?php if (have_rows('notre_savoir_faire')) : ?>
        <section class="notre-savoir-faire bg-color-primary grid grid-cols-1 md:grid-cols-12 gap-x-4 pt-44">
            <?php while (have_rows('notre_savoir_faire')) : the_row(); ?>
                <div class="notre-savoir-faire-text col-span-1 md:col-span-5 col-start-1 px-4 md:pl-16 pb-10 flex flex-col justify-end">
                    <h2 class="font-tiempos font-light text-3xl md:text-4xl"><?php the_sub_field('titre'); ?></h2>
                    <?php 
                    $lien = get_sub_field('lien');
                    if ($lien) : ?>
                        <a class="font-untitled font-light text-base underline pt-11" href="<?php echo esc_url($lien['url']); ?>" target="<?php echo esc_attr($lien['target'] ?: '_self'); ?>">
                            <?php echo esc_html($lien['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="notre-savoir-faire-image col-span-1 md:col-span-6 col-start-1 md:col-start-7">
                    <?php 
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                        <img class="w-full" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

    <?php if (have_rows('section_restaurations_et_creations')) : ?>
        <section class="restaurations-et-creations grid grid-cols-1 md:grid-cols-12 py-32 px-4 md:px-0 gap-y-16 md:gap-y-0">
            <?php $index = 0; ?>
            <?php while (have_rows('section_restaurations_et_creations')) : the_row(); ?>
                <div class="restaurations-et-creations-content col-span-1 md:col-span-4 <?php echo $index === 0 ? 'md:col-start-2' : 'md:col-start-8'; ?>">
                    <?php 
                    $illustration = get_sub_field('illustration');
                    if ($illustration) : ?>
                        <img class="w-full" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                    <?php endif; ?>

                    <div class="restaurations-et-creations-text pt-4">
                        <p class="font-untitled font-light text-base"><?php the_sub_field('presentation'); ?></p>
                        <?php 
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
                <div class="flex flex-col md:flex-row justify-between md:items-end w-full pt-11 pb-14 px-4">
                    <h2 class="font-tiempos font-light text-4xl md:text-6xl mb-9 md:mb-0">Journal</h2>
                    <div class="flex gap-x-1 items-center">
                        <a class="font-untitled font-light text-[14px] underline" href="<?php echo esc_url(get_permalink(get_page_by_path('journal'))); ?>">Voir toutes les publications</a>
                        <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.5 7.00781L4 4.00781L0.500001 1.00781" stroke="black"/>
                        </svg>
                    </div>
                </div>

                <div class="flex overflow-x-auto gap-x-4 px-4 no-scrollbar pb-24">
                    <?php while ($savoir_faire_query->have_posts()) : $savoir_faire_query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="item flex-shrink-0 w-full md:w-fit max-w-96"> 
                            <?php 
                            $illustration = get_field('apercu');
                            if ($illustration) : ?>
                                <img class="col-span-6 col-start-4 w-full object-cover h-full max-h-96" src="<?php echo esc_url($illustration['url']); ?>" alt="<?php echo esc_attr($illustration['alt']); ?>" />
                            <?php endif; ?>

                            <h4 class="font-untitled font-medium text-base"><?php the_title(); ?></h4>
                            <p class="font-untitled text-base w-full md:w-3/5"><?php the_field('extrait'); ?></p>
                        </a>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; 
        wp_reset_postdata(); 
    ?>
</div>

<?php
include('footer.php');
?>
