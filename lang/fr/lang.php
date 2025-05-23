<?php

return [
    'plugin' => [
        'name' => 'lightGallery',
        'description' => 'Galeries de photos avec lightbox.',
    ],
    'menu' => [
        'new_gallery' => 'Nouvelle galerie',
        'new_category' => 'Nouvelle catégorie',
    ],
    'common' => [
        'menu_label' => 'Galeries',
        'galleries' => 'Galeries',
        'gallery' => 'Galerie',
        'categories' => 'Catégories',
        'category' => 'Catégorie',
        'slug' => 'Slug',
        'name' => 'Nom',
        'description' => 'Description',
        'created' => 'Créé le',
        'updated' => 'Mise à jour le',
        'published' => 'Publié',
        'published_at' => 'Publié le',
        'infos_published' => 'Publié dans :categories le :date.',
        'infos_published_no_categories' => 'Publié le :date.',
        'date_format' => 'd M Y',
        'yes' => 'Oui',
        'no' => 'Non',
    ],

    'models' => [
        'general' => [
            'id' => 'ID',
            'created_at' => 'Created At',
            'description' => 'Description',
            'title' => 'Titre',
            'updated_at' => 'Updated At',
        ],
        'image' => [
            'single' => 'Image',
            'plural' => 'Images',
            'link' => 'Lien/Url',
            'title' => 'Gestion des images',
        ],
    ],

    'blocks' => [
        'images_gallery' => [
            'name' => 'Galerie d’images',
            'description' => 'Afficher une galerie d’images',
            'display_mode' => 'Mode d’affichage',
            'gallery' => 'Choisissez la galerie de photos à afficher',
            'maxImages' => 'Nombre d’images à afficher',
            'no_pictures' => 'Galerie photo en cours de réalisation',
            'zoom_message' => 'Cliquez les images pour agrandir',
            'modes' => [
                'grid' => 'Grille',
                'grid_double' => 'Grille x2 miniatures',
                'inline' => 'En ligne',
            ],
        ],
    ],

    'categories' => [
        'list_title' => 'Gérer les catégories de galerie',
        'new_category' => 'Nouvelle catégorie',
        'update_category' => 'Modifier une catégorie',
        'preview_category' => 'Aperçu de la catégorie',
        'creating' => 'Création d’une catégorie...',
        'saving' => 'Mise à jour de la catégorie...',
        'delete_confirm' => 'Confirmez-vous la suppression de cette catégorie ?',
        'deleting' => 'Suppression de la catégorie...',
        'delete_success' => 'Catégories ont été supprimés avec succès.',
        'return_to_list' => 'Retour à la liste des catégories',
        'uncategorized' => 'Non catégorisé',
    ],
    'category' => [
        'name_placeholder' => 'Nom de la nouvelle catégorie',
        'slug_placeholder' => 'adresse-de-la-nouvelle-categorie',
        'description_placeholder' => 'Description de la catégorie',
        'posts' => 'Articles',
        'return_to_categories' => 'Retour à la liste des catégories',
        'reorder' => 'Réorganiser les catégories',
    ],
    'galleries' => [
        'list_title' => 'Gérer les galeries',
        'new_gallery' => 'Nouvelle galerie',
        'update_gallery' => 'Mise à jour de la galerie',
        'preview_gallery' => 'Aperçu de la galerie',
        'creating' => 'Création de la galerie...',
        'saving' => 'Sauvegarde de la galerie...',
        'delete' => 'Supprimer les galeries sélectionnées',
        'delete_confirm_plural' => 'Supprimer les galeries sélectionnées ?',
        'delete_confirm' => 'Supprimer cette galerie ?',
        'deleting' => 'Suppression de la galerie...',
        'delete_success' => 'Suppression réussie de ces gelleries.',
        'return_to_list' => 'Retour à la liste des galeries',
    ],
    'gallery' => [
        'name_placeholder' => 'Nom de la nouvelle galerie',
        'slug_placeholder' => 'adresse-de-la-nouvelle-galerie',
        'description_placeholder' => 'Description de la galerie',
        'complex_mode' => 'Mode complexe',
        'complex_mode_comment' => 'Le mode complexe vous permet de définir une image avec une description html, un lien ...',
        'images' => 'Images',
        'images_comment' => 'Réorganisez les images pour les afficher dans l’ordre souhaité, donnez-leur un titre et une description qui s’afficherons dans le visionneur d’images.<br /><b>La première image sera utilisée comme image principale de la galerie.</b>',
        'images_count' => 'Nb d’images',
        'categories' => 'Catégories',
        'categories_comment' => 'Sélectionnez les catégories auxquelles appartient cette galerie.',
        'tabs' => [
            'images' => 'Images',
            'settings' => 'Paramètres',
        ],
    ],

    'permissions' => [
        'all' => 'Gérer les galeries',
    ],
    'settings' => [
        'gallerylist' => [
            'title' => 'Liste de galeries',
            'description' => 'Affiche la liste des galeries dans la page',
            'no_galleries_message' => 'Message d’absence de galeries',
            'no_galleries_message_description' => 'Message à afficher en cas d’absence de galeries',
            'no_galleries_default' => 'Aucune galerie trouvée',
        ],
        'gallery' => [
            'description' => 'Affiche une galerie en fonction de son identifiant',
            'no_images_message' => 'Message d’absence d’images',
            'no_images_message_description' => 'Message à afficher au cas où il n’y aurait pas d’images dans la galerie',
            'no_images_default' => 'Aucune image dans cette galerie',
            'slug' => 'Adresse URL de la galerie',
            'slug_description' => 'Recherchez la galerie en utilisant la valeur d’adresse fournie.',
        ],
        'groups' => [
            'links' => 'Liens',
            'lightgallery' => 'Options lightGallery',
            'plugins' => 'Plugins lightGallery',
            'thumbs' => 'Options miniatures',
        ],
        'plugins' => [
            'lgAutoplay' => 'Diaporama automatique',
            'lgComment' => 'Commentaires FaceBook et Disqus prêts à l’emploi',
            'lgFullscreen' => 'Plein écran natif HTML5',
            'lgHash' => 'URL unique pour chaque image de la galerie',
            'lgMediumZoom' => 'Expérience de zoom comme vu Medium',
            'lgPager' => 'Affichage d’un point pour chaque image',
            'lgRotate' => 'Fonctions de rotation',
            'lgShare' => 'Fonctions de partage pour médias sociaux',
            'lgThumbnail' => 'Aperçu miniature',

            // 'lgVideo' => 'Afficher les vidéos dans lightGallery',

            'lgZoom' => 'Fonctionnalités de zoom',
        ],
        'category_page' => 'Page de catégorie',
        'category_page_description' => 'Page où les catégories sont affichées.',
        'controls_title' => 'Contrôles de navigation',
        'controls_description' => 'Afficher ou non les boutons PREC/SUIV',
        'counter_title' => 'Compteur d’images',
        'counter_description' => 'Affiche le nombre total d’images et le numéro de l’image actuelle.',
        'caption_title' => 'Légende de l’image',
        'caption_description' => 'Active les légendes d’images',
        'download_title' => 'Bouton de téléchargement',
        'download_description' => 'Afficher un bouton de téléchargement pour les images ?',
        'escKey_title' => 'ESC pour fermer',
        'escKey_description' => 'La galerie doit-elle être fermée lorsque l’utilisateur appuie sur "Esc".',
        'gallery_page' => 'Page de la galerie',
        'gallery_page_description' => 'Page où une galerie est affichée.',
        'galleries_pagination' => 'Numéro de page',
        'galleries_pagination_description' => 'Cette valeur est utilisée pour déterminer sur quelle page se trouve l’utilisateur.',
        'galleries_per_page' => 'Galeries par page',
        'galleries_per_page_validation' => 'Format non valide de la valeur des galeries par page',
        'gallery_show' => 'Affiche une galerie dans la page',
        'inline' => 'En ligne',
        'inline_description' => 'La galerie est affichée en ligne dans la page',
        'loop_title' => 'Boucle',
        'loop_description' => 'Permet d’aller à l’autre bout de la galerie à la première/dernière image.',
        'mode_title' => 'Transition',
        'mode_description' => 'Type de transition entre les images',
        'nextHtml_title' => 'HTML bouton "suivant"',
        'nextHtml_description' => 'Code html pour remplacer le contenu du bouton "suivant"',
        'pause_title' => 'Temps de pause',
        'pause_description' => 'Temps (en ms) entre chaque transition automatique',
        'pause_validation' => 'Format non valide',
        'plugins_title' => 'Plugins lightGallery',
        'plugins_description' => 'Activer les plugins intégrés de lightGallery',
        'preload_title' => 'Précharger des images',
        'preload_description' => 'Nombre d’images préchargées avant et après l’image actuelle.',
        'preload_validation' => 'Format non valide',
        'prevHtml_title' => 'HTML bouton "précédent"',
        'prevHtml_description' => 'Code html pour remplacer le contenu du bouton "précédent"',
        'speed_title' => 'Vitesse de transition',
        'speed_description' => 'Durée de la transition (en ms)',
        'speed_validation' => 'Format non valide',
        'resizer' => [
            'title' => 'Mode de redimensionnement',
            'description' => 'Comment redimensionner les vignettes',
            'height_title' => 'Hauteur de la vignette',
            'height_description' => 'Hauteur de la vignette principale en pixels',
            'height_validation' => 'Format non valide',
            'width_title' => 'Largeur de la vignette',
            'width_description' => 'Largeur de la vignette principale en pixels',
            'width_validation' => 'Format non valide',
            'options' => [
                'auto' => 'Auto',
                'exact' => 'Exact',
                'portrait' => 'Portrait',
                'landscape' => 'Paysage',
                'crop' => 'Recadrer',
            ],
        ],
    ],

    'exeptions' => [
        'publish_date_validation' => "Vous devez préciser une date de publication",
    ],
    'sorting' => [
        'title_asc' => 'Titre (ascendant)',
        'title_desc' => 'Titre (descendant)',
        'created_asc' => 'Création le (ascendant)',
        'created_desc' => 'Création (descendant)',
        'updated_asc' => 'Mise à jour (ascendant)',
        'updated_desc' => 'Mise à jour (descendant)',
        'published_asc' => 'Publication (ascendant)',
        'published_desc' => 'Publication (descendant)',
        'random' => 'Aléatoire',
    ],
    'reorder' => [
        'images' => 'Images réordonnées avec succès'
    ],
];
