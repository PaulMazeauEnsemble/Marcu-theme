<?php
/*
Template Name: Projects
*/

$login_page = home_url('/inscription/');

if (!is_user_logged_in()) {
    wp_redirect($login_page);
    exit;
}

get_header(); ?>

<div class="content">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-4 px-4 md:px-8 pt-32 mb-10">
        <?php
        include get_template_directory() . '/components/project-cards.php';

        $args = array(
            'post_type' => 'projets',
            'posts_per_page' => -1,
        );
        $projects_query = new WP_Query($args);

        if ($projects_query->have_posts()) :
            while ($projects_query->have_posts()) : $projects_query->the_post();
                ?>
                <div class="col-span-1">
                    <?php display_project_card(get_the_ID()); ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Aucun projet trouvé.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
