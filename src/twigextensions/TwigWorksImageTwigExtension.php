<?php
/**
 * TwigWorksImage plugin for Craft CMS 3.x
 *
 * twig image transforms
 *
 * @link      http://www.24hoursmedia.com
 * @copyright Copyright (c) 2018 24hoursmedia
 */

namespace twentyfourhoursmedia\twigworksimage\twigextensions;

use twentyfourhoursmedia\twigworksimage\services\TwigWorksImageService;
use twentyfourhoursmedia\twigworksimage\TwigWorksImage;

use Craft;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    24hoursmedia
 * @package   TwigWorksImage
 * @since     1.0.0
 */
class TwigWorksImageTwigExtension extends \Twig_Extension
{
    private $workImagesDefaultOptions = [
        'remove_attributes' => false,
        'image_attributes' => [],
        'link' => false,
        'link_attributes' => []
    ];

    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'TwigWorksImage';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('work_images', [$this, 'workImages']),
            new \Twig_SimpleFilter('work_images_lightboxify', [$this, 'workImagesLightboxify']),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('work_images', [$this, 'workImages']),
            new \Twig_SimpleFunction('work_images_lightboxify', [$this, 'workImagesLightboxify']),
        ];
    }

    /**
     * Does work on images
     *
     * @param null $text
     *
     * @return string
     */
    public function workImages($html = null, array $options = [])
    {

        /* @var $service TwigWorksImageService */
        $service = TwigWorksImage::$plugin->twigWorksImageService;
        $options = array_merge($this->workImagesDefaultOptions, $options);



        $container = $service->createDomContainerFromHtml($html);

        if ($options['remove_attributes']) {
            $service->removeImageAttributes($container);
        }

        $service->setImageAttributes($container, $options['image_attributes']);

        if ($options['link']) {
            $service->linkImages($container, $options['link_attributes']);
        }


        return $service->getHtmlFromDomContainer($container);
    }

    public function workImagesLightboxify($html = null, $attrName = 'data-toggle', $attrVal = 'lightbox')
    {
        $options = [
            'remove_attributes' => true,
            'image_attributes' => ['style' => 'max-width: 100%'],
            'link' => true,
            'link_attributes' => [$attrName => $attrVal]
        ];
        return $this->workImages($html, $options);
    }
}
