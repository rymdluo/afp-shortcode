<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ImageShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('image', function(ShortcodeInterface $sc) {
            
            $content = strip_tags($sc->getContent(),'<a><div><img><video><source><span><b><strong><em><mark><small><del><i><ins><sub><sup>');
            $datasrc = strip_tags($sc->getParameter('src', false));
            $alt = strip_tags($sc->getParameter('alt', false));
            
            $output = '';
            
            if ($content)
                $output .= '<figure>';
            
            $output .= '<img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" ';
            
            if($datasrc) {
                if (strpos($datasrc, 'http') !== false || strpos($datasrc, '{{') !== false) {
                $output .= 'data-src="' . $datasrc . '" ';
                } else {
                $output .= 'data-src="{{ page.url }}/' . $datasrc . '" ';
                }
            }
                
            if($alt)
                $output .= 'alt="' . $alt . '" ';
            
            $output .= '/>';
            
            if ($content)
                $output .= '<figcaption>' . $content . '</figcaption></figure>';
            
            return $output;
        });
    }
}