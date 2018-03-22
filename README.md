# TwigWorksImage plugin for Craft CMS 3.x

*This plugin will cost $6.99 once Craft 3 GA is released.*

![Screenshot](resources/img/icon.svg)

Image Twig filter for Craft CMS.

* Lightboxify images in HTML

[See all available twig filters](doc/twig-filters.md)



## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require 24hoursmedia-craftcms/twig-works-image

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for TwigWorksImage.

## TwigWorksImage Overview

* Lightboxify images in an html document

## Configuring TwigWorksImage

Currently there is no configuration.

## Using TwigWorksImage

[See all available twig filters and examples](doc/twig-filters.md)

**Lightboxify images in HTML**

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






Brought to you by [24hoursmedia](http://www.24hoursmedia.com)
