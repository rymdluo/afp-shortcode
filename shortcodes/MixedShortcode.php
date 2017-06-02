<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class MixedShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('mixed', function(ShortcodeInterface $sc) {
            
            $content = strip_tags($sc->getContent(),'<a><div><img><video><source><span><b><strong><em><mark><small><del><i><ins><sub><sup>');
            $link = strip_tags($sc->getParameter('link', false));
            $alt = strip_tags($sc->getParameter('alt', ""));
            $brand = strip_tags($sc->getParameter('brand', ""));
            $product = strip_tags($sc->getParameter('product', ""));
            $price = strip_tags($sc->getParameter('price', ""));
            $imagesrc = strip_tags($sc->getParameter('imagesrc', false));
            $image2src = strip_tags($sc->getParameter('image2src', false));
            $videosrc = strip_tags($sc->getParameter('videosrc', false));
            $video2src = strip_tags($sc->getParameter('video2src', false));

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
            
            $output = '<div class="afp-row"><a class="afp-link" target="_blank" ';
            
            
            $output .= 'href="' . $link . '" alt="' . $alt . $brand . $product . '"';
            
            $output .= ' >';
            
            if($imagesrc) {
                if (strpos($imagesrc, 'http') !== false || strpos($imagesrc, '{{') !== false) {
                $imagesrc = $imagesrc;
                } else {
                $imagesrc = "{{ page.url }}/" . $imagesrc;
                }
            }
            
            if($image2src) {
                if (strpos($image2src, 'http') !== false || strpos($image2src, '{{') !== false) {
                $image2src = $image2src;
                } else {
                $image2src = "{{ page.url }}/" . $image2src;
                }
            }
            
            if($videosrc) {
                if (strpos($videosrc, 'http') !== false || strpos($videosrc, '{{') !== false) {
                $videosrc = $videosrc;
                } else {
                $videosrc = "{{ page.url }}/" . $videosrc;
                }
            }
            
            if($video2src) {
                if (strpos($video2src, 'http') !== false || strpos($video2src, '{{') !== false) {
                $video2src = $video2src;
                } else {
                $video2src = "{{ page.url }}/" . $video2src;
                }
            }
            
            if($imagesrc){
                $output.= '<div class="afp-img b-lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="' . $imagesrc .'" alt="' . $alt . '" ></div>';
            }
            
            if($image2src) {
                $output.= '<div class="afp-img b-lazy" data-src="' . $image2src .'" alt="' . $alt . $brand . $product . '" ></div>';
            }
            
            if($videosrc) {
                $output.= '<video autoplay muted loop playsinline class="afp-vid b-lazy"><source type="video/mp4" data-src="' . $videosrc . '" alt="' . $alt . $brand . $product . '" ></video>';
            }
            
            if($video2src) {
                $output.= '<video autoplay muted loop playsinline class="afp-vid b-lazy"><source type="video/mp4" data-src="' . $video2src . '" alt="' . $alt . $brand . $product . '" ></video>';
            }
            
            $output .= '<div class="afp-price">' . $price . '</div>';
            
            $output .= '</a></div>';

            
            
            return $output;
        });
    }
}