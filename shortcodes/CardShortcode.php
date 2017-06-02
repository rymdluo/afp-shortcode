<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class CardShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('card', function(ShortcodeInterface $sc) {
            
            $content = strip_tags($sc->getContent(),'<a><div><img><video><source><span><b><strong><em><mark><small><del><i><ins><sub><sup>');
            $link = strip_tags($sc->getParameter('link', false));
            $imagesrc = strip_tags($sc->getParameter('imagesrc', false));
            $price = strip_tags($sc->getParameter('price', ""));
            $brand = strip_tags($sc->getParameter('brand', ""));
            $product = strip_tags($sc->getParameter('product', ""));
        
            global $products;
            
            if(!(strpos($link, 'amazon')) && !(strpos($link, 'amzn')) && !(strpos($link, 'ebay')) && !(strpos($link, 'etsy')) && !(strpos($link, 'indiegogo')) && !(strpos($link, 'kickstarter')) && !(strpos($link, 'massdrop'))){
                if ($brand and $product) {
                    $products[] = $brand . ', ' . $product;
                } else if ($product) {
                    $products[] = $product;
                } else if ($brand) {
                    $products[] = $brand;
                } else if ($price and $alt) {
                    $products[] = $alt;
                }   
            }
            
            $output = '<a class="afp-link" target="_blank" ';
            
            $output .= 'href="' . $link . '" alt="' . $brand . ' ' . $product . '" >';   
            
            if($imagesrc) {
                if (strpos($imagesrc, 'http') !== false || strpos($imagesrc, '{{') !== false) {
                $imagesrc = $imagesrc;
                } else {
                $imagesrc = "{{ page.url }}/" . $imagesrc;
                }
            }
            
            $output .= '<div class="afp-img b-lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="' . $imagesrc . '" alt="' . $brand . ' ' . $product . ' at ' . $price . '" ></div>';

            $output .= '<div class="afp-subname">' . $brand . '</div><div class="afp-name">' . $product . '</div>';

            $output .= '<div class="afp-price">' . $price . '</div>';
            
            $output .= '</a>';
            
            return $output;
        });
    }
}