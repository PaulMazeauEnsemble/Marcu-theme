<?php
/*
Template Name: Restauration
*/

include('header.php');
?>

<div class="content pt-44 bg-color-background">
    <section class="hero grid grid-cols-12 gap-x-4 px-4 pb-8">
        <div class="hero-text col-span-6 col-start-1 flex flex-col justify-between">
            <h1 class="font-tiempos font-light text-5xl col-span-10 col-start-2"><?php the_field('titre'); ?></h1>
            <p class="font-untitled col-span-10 col-start-2 text-2xl"><?php echo nl2br(get_field('description')); ?></p>
        </div>

        <div class="hero-image col-start-7 col-span-6">
            <?php 
            // Affiche l'image de la section notre savoir faire
            $image = get_field('image');
            if ($image) : ?>
                <img class="w-full" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>
    </section>


<div class="">
    <div class="filter pb-4 pt-20 px-4 h-32 sticky top-0">
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black border-2 border-black bg-color-background focus:outline-nonefont-untitled font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center w-fit" type="button">Filtres <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>

    <div id="dropdown" class="z-50 hidden border-t-0 border-2 border-black bg-color-background divide-y divide-gray-100 rounded-b-lg shadow w-fit dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li><a href="#" class="block px-4 py-2 filter-btn" data-filter="all">Tous</a></li>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'categorie-restauration',
                'hide_empty' => false,
            ));

            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $category) {
                    echo '<li>';
                    echo '<a href="#" class="block px-4 py-2 filter-btn" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</a>';
                    echo '</li>';
                }
            } else {
                echo '<li><p class="block px-4 py-2">Aucune catégorie trouvée.</p></li>';
            }
            ?>
        </ul>
    </div>
    </div>

    <div id="restaurations-grid" class="grid grid-cols-12">
        <?php
        $args = array(
            'post_type' => 'restaurations',
            'posts_per_page' => -1
        );
        $restaurations_query = new WP_Query($args);

        // Récupérer les citations du champ répéteur
        $citations = get_field('citations');
        $citation_index = 0;

        if ($restaurations_query->have_posts()) :
            $count = 0;
            $line_items = 0;
            $line_count = 0;

            while ($restaurations_query->have_posts()) : $restaurations_query->the_post();

                if ($line_items == 0) : // Début d'une nouvelle ligne
                    $empty_position = rand(1, 2); // Position aléatoire pour l'espace vide (2ème ou 3ème position)
                    $line_count++;

                    // Afficher une citation seulement après la première ligne
                    if ($line_count > 1 && $citation_index < count($citations) && rand(0, 1) == 1) :
                        echo '<div class="col-span-7 col-start-5 py-8">';
                        echo '<p class="font-tiempos text-4xl">' . nl2br(esc_html($citations[$citation_index]['citation'])) . '</p>';
                        echo '</div>';
                        $citation_index++;
                    endif;
                endif;

                if ($line_items == $empty_position) :
                    echo '<div class="col-span-3"></div>'; // Espace vide
                    $line_items++;
                endif;

                if ($line_items < 4) :
        ?>
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'categorie-restauration');
                    $category_classes = '';
                    if ($categories && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            $category_classes .= ' ' . $category->slug;
                        }
                    }
                    ?>
                    <div class="col-span-3 p-4<?php echo esc_attr($category_classes); ?>">
                        <?php include('components/restauration-card.php'); ?>
                    </div>
        <?php
                    $line_items++;
                endif;

                $count++;

                if ($line_items == 4) :
                    echo '<div class="col-span-12"></div>'; // Forcer une nouvelle ligne
                    $line_items = 0;
                endif;

            endwhile;

            // Afficher les citations restantes à la fin si nécessaire
            while ($citation_index < count($citations)) :
                echo '<div class="col-span-12 py-8">';
                echo '<p class="font-tiempos text-4xl flex justify-center">' . nl2br(esc_html($citations[$citation_index]['citation'])) . '</p>';
                echo '</div>';
                $citation_index++;
            endwhile;

            wp_reset_postdata();
        else :
            echo '<p>Aucune restauration trouvée.</p>';
        endif;
        ?>

        <?php
        // Récupérer les termes de la taxonomie 'categorie-restauration'
        $categories = get_terms(array(
            'taxonomy' => 'categorie-restauration',
            'hide_empty' => false,
        ));

        ?>
    </div>
</div>
</div>

<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>
<div id="restaurationModal" class="fixed inset-y-0 right-0 w-4/6 bg-color-background-bright shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto z-50">
    <div>
        <div id="modalContent"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownDefaultButton');
    const dropdownMenu = document.getElementById('dropdown');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const restaurationItems = document.querySelectorAll('.col-span-3');

    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });

    filterButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const filter = button.getAttribute('data-filter');

            restaurationItems.forEach(item => {
                if (filter === 'all' || item.classList.contains(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });

            // Fermer le menu déroulant après la sélection
            dropdownMenu.classList.add('hidden');
        });
    });
});
</script>

<?php
get_footer();
?>
