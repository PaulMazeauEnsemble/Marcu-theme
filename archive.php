<?php get_header(); ?>

<div class="content-area">
    <main class="site-main">
        <?php
        global $wp_query;
        var_dump($wp_query->query_vars); // Affiche les variables de la requête
        if (have_posts()) : ?>
            <header class="archive-header">
                <h1 class="archive-title">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        single_tag_title();
                    } elseif (is_author()) {
                        the_post();
                        echo 'Auteur : ' . get_the_author();
                        rewind_posts();
                    } elseif (is_day()) {
                        echo 'Archives pour ' . get_the_date();
                    } elseif (is_month()) {
                        echo 'Archives pour ' . get_the_date('F Y');
                    } elseif (is_year()) {
                        echo 'Archives pour ' . get_the_date('Y');
                    } else {
                        echo 'Archives';
                    }
                    ?>
                </h1>
            </header>

            <div class="archive-posts">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h2>
                        </header>

                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>

                <div class="pagination">
                    <?php
                    // Pagination
                    the_posts_pagination(array(
                        'prev_text' => __('Précédent', 'textdomain'),
                        'next_text' => __('Suivant', 'textdomain'),
                    ));
                    ?>
                </div>
            </div>
        <?php else : ?>
            <p>Aucun contenu trouvé pour cette archive.</p>
        <?php endif; ?>
    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
