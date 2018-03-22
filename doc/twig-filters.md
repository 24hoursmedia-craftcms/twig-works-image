# Twig Works Image twig filters


#### Lightboxify images in HTML

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