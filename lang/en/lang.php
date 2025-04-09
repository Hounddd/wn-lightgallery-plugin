<?php

return [
    'plugin' => [
        'name' => 'lightGallery',
        'description' => 'Photos galleries with lightbox.',
    ],
    'menu' => [
        'new_gallery' => 'New gallery',
        'new_category' => 'New category',
    ],
    'common' => [
        'menu_label' => 'Galleries',
        'galleries' => 'Galleries',
        'gallery' => 'Gallery',
        'categories' => 'Categories',
        'category' => 'Category',
        'slug' => 'Slug',
        'name' => 'Name',
        'description' => 'Description',
        'created' => 'Created',
        'updated' => 'Updated',
        'published' => 'Published',
        'published_at' => 'Published at',
        'infos_published' => 'Published in :categories on :date.',
        'infos_published_no_categories' => 'Published on :date.',
        'date_format' => 'M d, Y',
        'yes' => 'Yes',
        'no' => 'No',
    ],

    'models' => [
        'general' => [
            'id' => 'ID',
            'created_at' => 'Created At',
            'description' => 'Description',
            'title' => 'Title',
            'updated_at' => 'Updated At',
        ],
        'image' => [
            'single' => 'Image',
            'plural' => 'Images',
            'link' => 'Link/Url',
            'title' => 'Gestion des images',
        ],
    ],

    'blocks' => [
        'images_gallery' => [
            'name' => 'Images gallery',
            'description' => 'Show a gallery of images',
            'display_mode' => 'Display mode',
            'gallery' => 'Choose the photo gallery to display',
            'maxImages' => 'Number of images to display',
            'no_pictures' => 'Photo gallery in progress',
            'zoom_message' => 'Click images to enlarge',
            'modes' => [
                'grid' => 'Grid',
                'grid_double' => 'Grid x2 thumbs',
                'inline' => 'Inline',
            ],
        ],
    ],

    'categories' => [
        'list_title' => 'Manage the galleries categories',
        'new_category' => 'New category',
        'update_category' => 'Update category',
        'preview_category' => 'Preview Category',
        'creating' => 'Creating Category...',
        'saving' => 'Saving Category...',
        'delete_confirm' => 'Delete this category?',
        'deleting' => 'Deleting Category...',
        'delete_success' => 'Successfully deleted those categories.',
        'return_to_list' => 'Return to categories list',
        'uncategorized' => 'Uncategorized',
    ],
    'category' => [
        'name_placeholder' => 'New category name',
        'slug_placeholder' => 'new-category-slug',
        'description_placeholder' => 'Category Description',
        'posts' => 'Posts',
        'return_to_categories' => 'Return to the galleries category list',
        'reorder' => 'Reorder Categories',
    ],
    'galleries' => [
        'list_title' => 'Manage the galleries',
        'new_gallery' => 'New gallery',
        'update_gallery' => 'Update gallery',
        'preview_gallery' => 'Preview Gallery',
        'creating' => 'Creating Gallery...',
        'saving' => 'Saving Gallery...',
        'delete' => 'Delete selected galleries',
        'delete_confirm' => 'Delete this gallery?',
        'delete_confirm_plural' => 'Delete selected galleries?',
        'deleting' => 'Deleting Gallery...',
        'delete_success' => 'Successfully deleted those gelleries.',
        'return_to_list' => 'Return to galleries list',
    ],
    'gallery' => [
        'name_placeholder' => 'New gallery name',
        'slug_placeholder' => 'new-gallery-slug',
        'description_placeholder' => 'Gallery Description',
        'complex_mode' => 'Complex mode',
        'complex_mode_comment' => 'complex mode allow you to define image with html description, link ...',
        'images' => 'Images',
        'images_comment' => 'Re-order images to show then in the desired order, give them a title and a description they will be displayed in the image viewer.<br /><b>The first image will be used as the main image of the gallery.</b>',
        'images_count' => 'Nb of images',
        'categories' => 'Categories',
        'categories_comment' => 'Select the categories this gallery belongs to.',
        'tabs' => [
           'images' => 'Images',
           'settings' => 'Settings',
        ],
    ],

    'permissions' => [
        'all' => 'Manage galleries',
    ],
    'settings' => [
        'gallerylist' => [
            'title' => 'Gallery list',
            'description' => 'Display list of galleries on the page',
            'no_galleries_message' => 'No galleries message',
            'no_galleries_message_description' => 'Message to shown in case of no galleries',
            'no_galleries_default' => 'No galleries found',
        ],
        'gallery' => [
            'description' => 'Display a gallery according to his id',
            'no_images_message' => 'No images message',
            'no_images_message_description' => 'Message to shown in case there is no images in the gallery',
            'no_images_default' => 'No images in this gallery',
            'slug' => 'Gallery slug',
            'slug_description' => 'Look up the gallery using the supplied slug value.',
        ],
        'groups' => [
            'links' => 'Links',
            'lightgallery' => 'lightGallery options',
            'plugins' => 'lightGallery plugins',
            'thumbs' => 'Thumbnail Options',
        ],
        'plugins' => [
            'lgAutoplay' => 'Automatic slideshow',
            'lgComment' => 'FaceBook and Disqus comments out of the box',
            'lgFullscreen' => 'Native HTML5 fullscreen',
            'lgHash' => 'Unique URLs for each gallery image',
            'lgMediumZoom' => 'Zooming experience as seen on medium',
            'lgPager' => 'Display dot for each image',
            'lgRotate' => 'Rotate features',
            'lgShare' => 'Social media share features',
            'lgThumbnail' => 'Thumbnail Preview',
            // 'lgVideo' => 'Display videos in lightGallery',
            'lgZoom' => 'Zoom features',
        ],
        'category_page' => 'Category page',
        'category_page_description' => 'Page where categories are displayed.',
        'counter_title' => 'Image Counter',
        'counter_description' => 'Shows total number of images and index number of current image',
        'controls_title' => 'Navigation Controls',
        'controls_description' => 'Whether to display PREV/NEXT buttons',
        'caption_title' => 'Image Caption',
        'caption_description' => 'Enables image captions',
        'download_title' => 'Download button',
        'download_description' => 'Display a download button for images',
        'escKey_title' => 'ESC Close',
        'escKey_description' => 'Whether gallery should be closed when user presses "Esc"',
        'gallery_page' => 'Gallery page',
        'gallery_page_description' => 'Page where a gallery is displayed.',
        'galleries_pagination' => 'Page number',
        'galleries_pagination_description' => 'This value is used to determine what page the user is on.',
        'galleries_per_page' => 'Galleries per page',
        'galleries_per_page_validation' => 'Invalid format of the galleries per page value',
        'gallery_show' => 'Display a gallery on the page',
        'inline' => 'Inline',
        'inline_description' => 'Gallery is shown inline in the page',
        'loop_title' => 'Loop',
        'loop_description' => 'Allows to go to the other end of the gallery at first/last image',
        'mode_title' => 'Transition',
        'mode_description' => 'Type of transition between images',
        'nextHtml_title' => 'Custom html for next control',
        'nextHtml_description' => 'Html code to replace next control content',
        'pause_title' => 'Pause Time',
        'pause_description' => 'Time (in ms) between each auto transition',
        'pause_validation' => 'Invalid format',
        'plugins_title' => 'lightGallery plugins',
        'plugins_description' => 'Activate lightGallery builtin plugins',
        'preload_title' => 'Preload Images',
        'preload_description' => 'Number of preload images before and after the current image',
        'preload_validation' => 'Invalid format',
        'prevHtml_title' => 'Custom html for prev control',
        'prevHtml_description' => 'Html code to replace prev control content',
        'speed_title' => 'Transition Speed',
        'speed_description' => 'Transition duration (in ms)',
        'speed_validation' => 'Invalid format',
        'resizer' => [
            'title' => 'Resizer Mode',
            'description' => 'How thumbnails should be resized',
            'height_title' => 'Thumbnail Height',
            'height_description' => 'Main thumbnail height in pixels',
            'height_validation' => 'Invalid format',
            'width_title' => 'Thumbnail Width',
            'width_description' => 'Main thumbnail width in pixels',
            'width_validation' => 'Invalid format',
            'options' => [
                'auto' => 'Auto',
                'exact' => 'Exact',
                'portrait' => 'Portrait',
                'landscape' => 'Landscape',
                'crop' => 'Crop',
            ],
        ],
    ],

    'exeptions' => [
        'publish_date_validation' => "Must specify a date",
    ],
    'sorting' => [
        'title_asc' => 'Title (ascending)',
        'title_desc' => 'Title (descending)',
        'created_asc' => 'Created (ascending)',
        'created_desc' => 'Created (descending)',
        'updated_asc' => 'Updated (ascending)',
        'updated_desc' => 'Updated (descending)',
        'published_asc' => 'Published (ascending)',
        'published_desc' => 'Published (descending)',
        'random' => 'Random',
    ],
    'reorder' => [
        'images' => 'Successfully reordered images'
    ],
];
