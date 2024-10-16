<?php
/*
Template Name: Création
*/

include('header.php');
?>

<div class="content">
    <h1>Page création</h1>

    <?php
    // Début de la boucle WordPress pour les posts de type 'restaurations'
    $args = array(
        'post_type' => 'creations',
        'posts_per_page' => -1 // Récupérer tous les posts
    );
    $restaurations_query = new WP_Query($args);

    if ($restaurations_query->have_posts()) :
        while ($restaurations_query->have_posts()) : $restaurations_query->the_post();
            // Inclure le composant restauration-card.php
            include('components/creation-card.php');
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Aucune création trouvée.</p>';
    endif;
    ?>
</div>

<?php
include('footer.php');
?>
