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


<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script chargé');
    const cards = document.querySelectorAll('.restauration-card');
    const modal = document.getElementById('restaurationModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const modalContent = document.getElementById('modalContent');

    function openModal() {
        modal.classList.remove('translate-x-full');
        modalOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModalFunction() {
        modal.classList.add('translate-x-full');
        modalOverlay.classList.add('hidden');
        setTimeout(() => {
            document.body.style.overflow = '';
        }, 300);
    }

    cards.forEach(card => {
        card.addEventListener('click', function() {
            const restaurationId = this.dataset.restaurationId;
            fetch(`/marcu/wp-json/wp/v2/restaurations/${restaurationId}`)                
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur réseau: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const nombrePhotos = data.acf.galerie_photo.length;
                modalContent.innerHTML = `
                    <div class="galerie-photo overflow-x-auto flex flex-nowrap h-[44vh] gap-0 no-scrollbar">
                        ${data.acf.galerie_photo.map(image => `
                            <img src="${image.url}" alt="${image.alt}" class="h-full w-auto object-contain flex-shrink-0" />
                        `).join('')}
                    </div>

                    <div class="flex flex-row items-center justify-between w-full mt-4 px-4 mb-4">
                        <div class="flex flex-row items-center gap-1">
                            <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.5 1.33398L1 4.33398L4.5 7.33398" stroke="black"/>
                            </svg>
                            <button id="closeModal" class="font-untitled font-light text-sm uppercase">Retour</button>
                            <button id="infoButton" class="font-untitled font-light text-sm uppercase pl-2">Infos</button>
                        </div>
                        
                        <div class="flex flex-row items-center gap-4">
                            <span class="font-untitled font-light text-sm uppercase">${nombrePhotos} photos</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4 px-4">
                        <div class="col-span-2">
                            <p class="font-untitled text-base">${data.acf.description}</p>
                        </div>
                        <div id="infoContent" class="col-span-6 col-start-6 transition-all duration-300 ease-out max-h-0 opacity-0 overflow-hidden">
                            <p class="font-untitled text-base transform translate-y-8 transition-transform duration-400 ease-out">${data.acf.information || ''}</p>
                        </div>
                    </div>
                    <h1 class="font-tiempos font-light text-6xl mb-4 absolute bottom-0 left-4">${data.title.rendered}</h1>
                `;
                openModal();

                const closeModalButton = document.getElementById('closeModal');
                closeModalButton.addEventListener('click', closeModalFunction);

                const infoButton = document.getElementById('infoButton');
                const infoContent = document.getElementById('infoContent');
                infoButton.addEventListener('click', function() {
                    infoContent.classList.toggle('max-h-0');
                    infoContent.classList.toggle('max-h-96');
                    infoContent.classList.toggle('opacity-0');
                    infoContent.classList.toggle('opacity-100');
                    
                    const infoText = infoContent.querySelector('p');
                    infoText.classList.toggle('translate-y-8');
                    infoText.classList.toggle('translate-y-0');
                    
                    infoButton.textContent = infoContent.classList.contains('max-h-0') ? 'Infos' : 'Fermer';
                });
            })
            .catch(error => {
                console.error('Erreur détaillée:', error);
                modalContent.innerHTML = `<p>Une erreur est survenue lors du chargement des données: ${error.message}</p>`;
                openModal();
            });
        });
    });

    modalOverlay.addEventListener('click', closeModalFunction);
});

document.addEventListener('DOMContentLoaded', function() {
    console.log('Script chargé');
    const cards = document.querySelectorAll('.creation-card');
    const modal = document.getElementById('creationModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const modalContent = document.getElementById('modalContent');

    function openModal() {
        modal.classList.remove('translate-x-full');
        modalOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModalFunction() {
        modal.classList.add('translate-x-full');
        modalOverlay.classList.add('hidden');
        setTimeout(() => {
            document.body.style.overflow = '';
        }, 300);
    }

    cards.forEach(card => {
        card.addEventListener('click', function() {
            const creationId = this.dataset.creationId;
            fetch(`/marcu/wp-json/wp/v2/creations/${creationId}`)                
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur réseau: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const nombrePhotos = data.acf.galerie_photo.length;
                modalContent.innerHTML = `
                    <div class="galerie-photo overflow-x-auto flex flex-nowrap h-[44vh] gap-0 no-scrollbar">
                        ${data.acf.galerie_photo.map(image => `
                            <img src="${image.url}" alt="${image.alt}" class="h-full w-auto object-contain flex-shrink-0" />
                        `).join('')}
                    </div>

                    <div class="flex flex-row items-center justify-between w-full mt-4 px-4 mb-4">
                        <div class="flex flex-row items-center gap-1">
                            <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.5 1.33398L1 4.33398L4.5 7.33398" stroke="black"/>
                            </svg>
                            <button id="closeModal" class="font-untitled font-light text-sm uppercase">Retour</button>
                            <button id="infoButton" class="font-untitled font-light text-sm uppercase pl-2">Infos</button>
                        </div>
                        
                        <div class="flex flex-row items-center gap-4">
                            <span class="font-untitled font-light text-sm uppercase">${nombrePhotos} photos</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4 px-4">
                        <div class="col-span-2">
                            <p class="font-untitled text-base">${data.acf.description}</p>
                        </div>
                        <div id="infoContent" class="col-span-6 col-start-6 transition-all duration-300 ease-out max-h-0 opacity-0 overflow-hidden">
                            <p class="font-untitled text-base transform translate-y-8 transition-transform duration-400 ease-out">${data.acf.information || ''}</p>
                        </div>
                    </div>
                    <h1 class="font-tiempos font-light text-6xl mb-4 absolute bottom-0 left-4">${data.title.rendered}</h1>
                `;
                openModal();

                const closeModalButton = document.getElementById('closeModal');
                closeModalButton.addEventListener('click', closeModalFunction);

                const infoButton = document.getElementById('infoButton');
                const infoContent = document.getElementById('infoContent');
                infoButton.addEventListener('click', function() {
                    infoContent.classList.toggle('max-h-0');
                    infoContent.classList.toggle('max-h-96');
                    infoContent.classList.toggle('opacity-0');
                    infoContent.classList.toggle('opacity-100');
                    
                    const infoText = infoContent.querySelector('p');
                    infoText.classList.toggle('translate-y-8');
                    infoText.classList.toggle('translate-y-0');
                    
                    infoButton.textContent = infoContent.classList.contains('max-h-0') ? 'Infos' : 'Fermer';
                });
            })
            .catch(error => {
                console.error('Erreur détaillée:', error);
                modalContent.innerHTML = `<p>Une erreur est survenue lors du chargement des données: ${error.message}</p>`;
                openModal();
            });
        });
    });

    modalOverlay.addEventListener('click', closeModalFunction);
});
</script>

