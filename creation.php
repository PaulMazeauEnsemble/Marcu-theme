<?php
/*
Template Name: Création
*/

include('header.php');
?>

<div class="content pt-20 md:pt-44 bg-color-background">
    <section class="hero grid grid-cols-1 md:grid-cols-12 gap-x-4 px-4 pb-8">
        <div class="hero-text col-span-1 md:col-span-6 flex flex-col justify-between order-2 md:order-none">
            <h1 class="font-tiempos font-light text-4xl md:text-5xl mt-3 mb-9 md:mt-0 md:mb-0"><?php the_field('titre'); ?></h1>
            <p class="font-untitled text-xl md:text-2xl"><?php echo nl2br(get_field('description')); ?></p>
        </div>

        <div class="hero-image col-span-1 md:col-start-7 md:col-span-6">
            <?php 
            $image = get_field('image');
            if ($image) : ?>
                <img class="w-full order-1 md:order-none" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>
    </section>


<div class="">
    <div class="filter pb-4 pt-16 md:pt-20 px-4 h-32 sticky top-0 z-20">    
    <div class="relative inline-block text-left">
    <button id="dropdownButton" 
            class="inline-flex gap-3 justify-between items-center w-full px-5 py-2.5 text-sm font-medium text-black border-2 border-black bg-color-background rounded-t-lg shadow-sm"
            onclick="toggleDropdown()">
      <p class="font-untitled pr-2">Filtres</p>

      <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 4H14" stroke="black"/>
            <path d="M4 7H14" stroke="black"/>
            <path d="M4 10H14" stroke="black"/>
        </svg>
    </button>

    <div id="dropdownMenu" 
         class="hidden mt-0 w-full border-2 border-black bg-color-background rounded-b-lg shadow-lg border-t-0 ">
      <ul class="py-2 text-sm text-gray-700">
        <li class="px-4 py-2 cursor-pointer">
            <a href="#" class="filter-btn" data-filter="all">Tous</a>
        </li>
        <?php
            $categories = get_terms(array(
                'taxonomy' => 'categorie-creation',
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
    </div>

    <div id="creations-grid" class="grid grid-cols-1 md:grid-cols-12 relative z-10">
        <?php
        $args = array(
            'post_type' => 'creations',
            'posts_per_page' => -1
        );
        $creations_query = new WP_Query($args);

        // Récupérer les citations du champ répéteur
        $citations = get_field('citations');
        $citation_index = 0;

        if ($creations_query->have_posts()) :
            $count = 0;
            $line_items = 0;
            $line_count = 0;

            while ($creations_query->have_posts()) : $creations_query->the_post();

                if ($line_items == 0) : // Début d'une nouvelle ligne
                    $empty_position = rand(1, 2); // Position aléatoire pour l'espace vide (2ème ou 3ème position)
                    $line_count++;

                    // Afficher une citation seulement après la première ligne et si des citations existent
                    if (!empty($citations) && $line_count > 1 && $citation_index < count($citations) && rand(0, 1) == 1) :
                        echo '<div class="col-span-1 md:col-span-7 md:col-start-5 py-8 citation-item">';
                        echo '<p class="font-tiempos text-2xl md:text-4xl flex justify-center md:block ">' . nl2br(esc_html($citations[$citation_index]['citation'])) . '</p>';
                        echo '</div>';
                        $citation_index++;
                    endif;
                endif;

                if ($line_items == $empty_position) :
                    echo '<div id="creations-Items" class="col-span-1 md:col-span-3"></div>'; // Espace vide
                    $line_items++;
                endif;

                if ($line_items < 4) :
?>
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'categorie-creation');
                    $category_classes = '';
                    if ($categories && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            $category_classes .= ' ' . $category->slug;
                        }
                    }
                    ?>
                    <div id="creations-Items" class="col-span-1 md:col-span-3 p-4 opacity-0 transform translate-y-4 transition-all duration-1000 ease-in-out <?php echo esc_attr($category_classes); ?>">
                        <?php include('components/creation-card.php'); ?>
                    </div>
<?php
                    $line_items++;
                endif;

                $count++;

                if ($line_items == 4) :
                    echo '<div class="col-span-1 md:col-span-12"></div>'; // Forcer une nouvelle ligne
                    $line_items = 0;
                endif;

            endwhile;

            // Afficher les citations restantes à la fin si nécessaire
            if (!empty($citations)) {
                while ($citation_index < count($citations)) :
                    echo '<div class="col-span-1 md:col-span-12 py-8">';
                    echo '<p class="font-tiempos text-2xl md:text-4xl flex justify-center">' . nl2br(esc_html($citations[$citation_index]['citation'])) . '</p>';
                    echo '</div>';
                    $citation_index++;
                endwhile;
            }

            wp_reset_postdata();
        else :
            echo '<p>Aucune création trouvée.</p>';
        endif;
        ?>

        <?php
        // Récupérer les termes de la taxonomie 'categorie-creation'
        $categories = get_terms(array(
            'taxonomy' => 'categorie-creation',
            'hide_empty' => false,
        ));

        ?>
    </div>
</div>
</div>

<style>
.hidden-item {
    display: none;
}
</style>

<script>
      function toggleDropdown() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
  }


document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdown');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const creationItems = document.querySelectorAll('#creations-grid > .col-span-1, #creations-grid > .md\\:col-span-3');
    const citationItems = document.querySelectorAll('#creations-grid > .citation-item');

    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });

    filterButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const filter = button.getAttribute('data-filter');

            creationItems.forEach(item => {
                if (filter === 'all' || item.classList.contains(filter)) {
                    item.classList.remove('hidden-item');
                } else {
                    item.classList.add('hidden-item');
                }
            });

            // Assurez-vous que les citations restent visibles
            citationItems.forEach(citation => {
                citation.classList.remove('hidden-item');
            });

            // Fermer le menu déroulant après la sélection
            dropdownMenu.classList.add('hidden');
        });
    });

    // Intersection Observer for fade-in animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-4');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('#creations-grid > .col-span-1, #creations-grid > .md\\:col-span-3').forEach(item => {
        observer.observe(item);
    });

    

});
</script>

<?php
get_footer();
?>
