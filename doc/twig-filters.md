# Twig Works Image twig filters


#### work_images_lightboxify
*lightboxify images in HTML*

Add *data-toggle="lightbox"* and a max width of 100% to images in an html document.

Example:

```twig
{% set html = '<p>Image:<img src="...." width="200" style="border:1" /></p>' %}
{{ html | work_images_lightboxify | raw }}
```

This will:
- remove most attributes from images in the html
- embed the image in a link pointing to the full image
- add an attribute *data-toggle="lightbox"* to the image

(Note you will have to add your own lightbox script, for example in Bootstrap
http://ashleydw.github.io/lightbox/)

The result:

```html
<p>Image:<img src="...." data-toggle="lightbox" style="max-width: 100%" /></p>
```

#### work_images

*Apply various useful transformations to images in html*

Work images accepts a settings object for transformations to apply to images.

Example:

```twig
{# remove all attributes from image tags in an html block and add a class 'responsive' #}
{{ html | work_images({ 
    remove_attributes: true,
    image_attributes: {
        class: "responsive"
    }
}) }}
```

Available settings:

```
{
    remove_attributes: boolean  set to true to remove all attributes from images (except src)
    image_attributes: array     add these attributes to image tags (i.e. [{title:'test'},{style:''}])
    link: boolean               set to true to embed all images in a link with href the src of the image
    link_attributes: array      if images are linked, apply these attributes to the A tag
}
```

