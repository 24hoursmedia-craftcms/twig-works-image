<?php
/**
 * TwigWorksImage plugin for Craft CMS 3.x
 *
 * twig image transforms
 *
 * @link      http://www.24hoursmedia.com
 * @copyright Copyright (c) 2018 24hoursmedia
 */

namespace twentyfourhoursmedia\twigworksimage\services;

use twentyfourhoursmedia\twigworksimage\dom\DomContainer;
use twentyfourhoursmedia\twigworksimage\TwigWorksImage;

use Craft;
use craft\base\Component;

/**
 * TwigWorksImageService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    24hoursmedia
 * @package   TwigWorksImage
 * @since     1.0.0
 */
class TwigWorksImageService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     TwigWorksImage::$plugin->twigWorksImageService->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (TwigWorksImage::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }

    /**
     * @param $html
     *
     * @return DomContainer
     */
    public function createDomContainerFromHtml($html)
    {
        return DomContainer::fromHtml($html);
        
    }

    public function getHtmlFromDomContainer(DomContainer $container)
    {
        return $container->getHtml();

    }

    public function removeImageAttributes(DomContainer $container, $preserveAttributes = ['src', 'title', 'alt'])
    {
        foreach ($container->imageElements as $imageElement) {
            foreach ($imageElement->attributes as $attribute) {
                /* @var $attribute \DOMAttr */
                if (!in_array($attribute->name, $preserveAttributes)) {
                    $imageElement->removeAttributeNode($attribute);
                }
            }
        }
        return $this;
    }

    public function setImageAttributes(DomContainer $container, $attributes = [])
    {
        if (!count($attributes)) {
            return $this;
        }
        foreach ($container->imageElements as $imageElement) {
            foreach ($attributes as $name => $value) {
                $imageElement->setAttribute($name, $value);
            }
        }
        return $this;
    }

    public function linkImages(DomContainer $container, $linkAttributes = [])
    {
        foreach ($container->imageElements as $imageElement) {
            if (!$container->hasParentTag($imageElement, 'a')) {

                $src = $imageElement->getAttribute('src');
                $linkElement = $container->doc->createElement('a');
                $linkElement->setAttribute('href', $src);
                foreach ($linkAttributes as $name => $value) {
                    $linkElement->setAttribute($name, $value);
                }

                //$linkNode->setAttribute('target', '_blank');
                //$linkNode->setAttribute('rel', 'ext-image');
                $imageElement->parentNode->replaceChild($linkElement, $imageElement);
                $linkElement->appendChild($imageElement);
            }
        }

    }

}
