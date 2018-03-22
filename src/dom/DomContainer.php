<?php
/**
 * Date: 19/03/2018
 */
namespace twentyfourhoursmedia\twigworksimage\dom;
class DomContainer
{

    private $wrapperId = 'd1415242-4f16-4223-a9e8-6e6120b3b866';

    private $encoding = 'utf-8';

    /**
     * @var \DOMDocument
     */
    public $doc;

    /**
     * @var \DOMElement
     */
    private $wrapperElement;

    /**
     * @var \DOMElement[]
     */
    public $imageElements = [];

    private function __construct()
    {
        $this->wrapperId = uniqid('wrapper_', false);
    }

    public static function fromHtml($html, $encoding = 'utf-8') {
        $container = new self();
        $container->encoding = $encoding;
        $container->doc = new \DOMDocument();
        $container->doc->loadHTML('<?xml encoding="' . $encoding . '" ?><div id="' . $container->wrapperId . '">'.trim($html).'</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $container->wrapperNode = $container->doc->getElementById($container->wrapperId);

        $container->hydrateImages();

        return $container;
    }

    public function hydrateImages()
    {
        $this->imageElements = $this->doc->getElementsByTagName('img');
        return $this;
    }

    /**
     * Get back modified html
     * @return string
     */
    public function getHtml() {
        $html = $this->doc->saveHTML($this->wrapperElement);
        $html = str_replace('<div id="' . $this->wrapperId . '">', '', $html);
        $html = substr($html,0, strlen($html) - 7);
        $html = str_replace('<?xml encoding="' . $this->encoding . '" ?>', '', $html);
        return $html;
    }

    public function hasParentTag(\DOMNode $node, $nodeName) {
        $currentNode = $node;
        while ($currentNode->parentNode) {
            if ($currentNode->parentNode->nodeName == $nodeName) {
                return true;
            }
            $currentNode = $currentNode->parentNode;
        }
        return false;
    }



}