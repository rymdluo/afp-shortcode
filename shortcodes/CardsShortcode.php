<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class CardsShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('cards', function(ShortcodeInterface $sc) {
            
            $content = strip_tags($sc->getContent(), '<a><div><img><video><source><span><b><strong><em><mark><small><del><i><ins><sub><sup>');
            
            
            $type = strip_tags($sc->getParameter('type', false));
            
            
            if (substr_count($content, 'afp-link') == 1) {
                $output = '<div class="afp-card">' . $content . '</div>';
            } else {
                $output = '<div class="afp-row">' . $content . '</div>';
            }
            
            return $output;
        });
    }
}