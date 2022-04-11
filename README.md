# LightGallery Plugin for Winter
Create stunning images ~~and videos~~ galleries for your WinterCMS website in minutes. Responsive, touch-friendly, and easy to use.  

***
This plugin use <a href="https://www.lightgalleryjs.com/" target="_blank">lightGallery script</a>.
***

## Features
* Create galleries of images organized in categories
* A gallery can be shown either as thumbnails or as an inline lightbox
* Compatible page snippet for [Winter Pages plugin](https://github.com/wintercms/wn-pages-plugin)
* Fully translate

### lightGallery script features
* **Vanilla javascript**, no dependencies required, not even jquery
* Fully responsive.
* Modular architecture with built in plugins.
* Highly optimized for touch devices.
* Mouse drag supports for desktops.
* Double-click/Double-tap to see actual size of the image.
* Animated thumbnails.
* Social sharing.
* YouTube Vimeo Wistia and html5 videos Support.
* 20+ Hardware-Accelerated CSS3 transitions.
* Dynamic mode.
* Inline gallery
* Full screen support.
* Zoom in/out, Pinch to zoom.
* Swipe/Drag up/down support to close gallery
* Browser history API(deep linking).
* Responsive images.
* HTML iframe support.
* Multiple instances on one page.
* Easily customizable via CSS (SCSS) and Settings.
* Smart image preloading and code optimization.
* Keyboard Navigation for desktop.
* SVG icons.
* Accessibility support.
* Rotate, flip images.
* And many more.

## Installation
*Let assume you're in the root of your wintercms installation*  

### Using composer
Just run this command
```bash
composer require hounddd/wn-lightgallery
```

### Clone
Clone this repo into your winter plugins folder.

```bash
cd plugins
mkdir hounddd && cd hounddd
git clone https://github.com/Hounddd/wn-lightgallery-plugin lightgallery
```

> **Note**:   
> Run `php artisan winter:up` command  
> Add `{% styles %}` and `{% scripts %}` placeholders in your layout or page `<header>` tag, if it is not already the case.


## Components
This plugin offer 2 components and 1 static page snippet.
* `galleriesList` component, display list of galleries
* `gallerySlug` component, display in a page a gallery based on his URL
* `galleryId` page snippet, display in a page a gallery based on his ID

### Galleries list

Use the `galleryList` component to display a list of latest galleries on a page. The component has the following properties:
* **galleryPage** - path to the gallery details page. The default value is galleries/gallery - it matches the pages/galleries/gallery.htm file in the theme directory. This property is used in the default component partial for creating links to the gallery images.
* **categoryPage** - path to the category page. The default value is galleries/category - it matches the pages/galleries/category.htm file in the theme directory. This property is used in the default component partial for creating links to the gallery images.
* **galleriesPerPage** - how many galleries to display on a single page (the pagination is supported automatically). The default value is 9.
* **pageNumber** - this value is used to determine what page the user is on, it should be a routing parameter for the default markup. The default value is {{ :page }} to obtain the value from the route parameter :page.
* **noGalleriesMessage** - message to display in on empty galleries list.

The galleryList component injects the following variables to the page where it's used:

* **galleries** - a list of galleries loaded from the database.
* **category** - the galleries category object loaded from the database. If the category is not found, the variable value is **null**.
* **galleryPage** - contains the value of the `galleryPage` component's property.
* **categoryPage** - contains the value of the `categoryPage` component's property.
* **pageParam** - contains the value of the current viewing page.
* **noPostsMessage** - contains the value of the `noPostsMessage` component's property.

The component supports pagination and reads the current page index from the :page URL parameter. The next example shows the basic component usage:

```twig	
title = "Show galleries"
url = "/galleries/:page?"
layout = "default"
is_hidden = 1

[viewBag]
localeUrl[fr] = "/galeries/:page?"
localeTitle[fr] = "Affiche une liste de galleries"

[galleriesList]
galleryPage = "galleries/gallery"
categoryPage = "galleries/category"
galleriesPerPage = 6
pageNumber = "{{ :page }}"
noGalleriesMessage = "No gallery found"
==
{% component 'galleriesList' %}
```
The next example shows the basic component usage with the category filter:

```twig
title = "Galleries Category"
url = "/galleries/category/:slug/:page?"

[galleriesList]
categoryFilter = "{{ :slug }}"
==
function onEnd()
{
    // Optional - set the page title to the category name
    if ($this->category)
        $this->page->title = $this->category->name;
}
==
{% if not category %}
    <h2>Category not found</h2>
{% else %}
    <h2>{{ category.name }}</h2>

    {% component 'galleriesList' %}
{% endif %}
```

The galleries and the pagination are coded in the default component partial `plugins/hounddd/lightgallery/components/galleries/default.htm`. If the default markup is not suitable for your website, feel free to copy it from the default partial and replace the {% component %} call in the example above with the partial contents.

### Gallery (by slug)
Use the `gallerySlug` component to display a gallery on a page.  
The component has the following properties:

* **inline** - the display mode of the gallery.
* **noImagesMessage** - message to display in an empty gallery.
* **plugins** - the plugins used by lightGallery script.
* **preload** - the number of preload slides.
* **mode** - the ype of transition between images.
* **speed** - the transition duration (in ms).
* **loop** - the ability to loop back to the beginning of the gallery from the last slide.
* **pause** - the the time (in ms) between each auto transition.
* **counter** - whether to show total number of images and index number of currently displayed image.
* **controls** - whether or not to display the prev/next buttons.
* **download** - whether or not to display the download button.
* **escKey** - whether the LightGallery could be closed by pressing the "Esc" key.
* **prevHtml** - custom html for prev control.
* **nextHtml** - custom html for next control.
* **width** - the width of the thumbnails to be displayed in the gallery.
* **height** - the height of the thumbnails to be displayed in the gallery.
* **resizer** - how the image should be fitted to dimensions.
* categoryPage - path to the category page. The default value is galleries/category - it matches the pages/galleries/category.htm file in the theme directory. This property is used in the default component partial for creating links to the gallery images.  

The gallerySlug component injects the following variables to the page where it's used:

* **gallery** - the gallery object loaded from the database. If the post is not found, the variable value is null.
* **noImagesMessage** - contains the value of the `noImagesMessage` component's property.

The next example shows the basic component usage on the gallery page:  

```twig
title = "Display a gallery"
url = "/gallery/:slug"
layout = "default"
is_hidden = 1

[viewBag]
localeUrl[en] = "/galerie/:slug"
localeTitle[fr] = "Affiche une galerie"

[gallerySlug]
slug = "{{:slug}}"
inline = "false"
noImagesMessage = "No images in this gallery"
plugins[] = "lgThumbnail"
plugins[] = "lgZoom"
preload = 2
mode = "lg-slide"
speed = 600
loop = "true"
pause = 5000
counter = "true"
controls = "true"
download = "true"
escKey = "true"
width = 300
height = 300
resizer = "auto"
==
{% component 'gallerySlug' %}
```

The gallery details are coded in the component partials wich are shared between `gallerySlug` component and `galleryId` page snippet.
* `plugins/hounddd/lightgallery/components/partials/gallery.htm` for thumbs view launching lightbox on click.
* `plugins/hounddd/lightgallery/components/partials/gallery_inline.htm` for inline lightbox view.

## Notes

### 🔑 Licence key
If you want to use lightGallery to develop commercial sites, themes, projects,
and applications, the Commercial license is the appropriate license. With this
option, your source code is kept proprietary.  
<a href="https://www.lightgalleryjs.com/license/" target="_blank">Read more about the commercial license</a>

### 🏆 Credits
This plugin is inspired by <a href="https://github.com/rjchauhan/RJGallery-for-OctoberCMS" target="_blank">rjchauhan /
RJGallery-for-OctoberCMS</a> of which it can be a replacement*.  
Besides the removal of jQuery from the dependencies, it brings some new features compared to the source plugin: 

 - Update to last stable version of LightGallery script (v2.4.0)
 - Default image for galleries
 - Use external CSS with class selectors
 - Add real anchor link to large file
 - Customisables "prev" and "next" buttons


\* It may have some breaking changes as the component Gallery doesn't exist anymore.

***
Make awesome sites with ❄ [WinterCMS](https://wintercms.com)!