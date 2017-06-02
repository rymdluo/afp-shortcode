<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ChatShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('chat', function(ShortcodeInterface $sc) {
            
            //$content = strip_tags($sc->getContent(), '<a><div><img><video><source><span><b><strong><em><mark><small><del><i><ins><sub><sup>');
            $content = $sc->getContent();
            $output = '<div class="messages"><ul>' . $content . '</ul></div>';
            
            return $output;
        });
        
    }
}