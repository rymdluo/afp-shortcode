<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ChatLeftShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('left', function(ShortcodeInterface $sc) {
            
            $content = strip_tags($sc->getContent(), '<p><a><div><img><video><source><span><b><strong><em><mark><small><del><i><ins><sub><sup>');
            
            $imagesrc = strip_tags($sc->getParameter('imagesrc', false));
            $videosrc = strip_tags($sc->getParameter('videosrc', false));
            
            $output = '';
            
            if($imagesrc) {
                $image = '<img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" ';
                if (strpos($imagesrc, 'http') !== false || strpos($imagesrc, '{{') !== false) {
                $image .= 'data-src="' . $imagesrc . '" ';
                } else {
                $image .= 'data-src="{{ page.url }}/' . $imagesrc . '" ';
                }
                $image .= '/>';
            }
            
            
            if($videosrc) {
                $video = '<video autoplay muted loop playsinline class="b-lazy"><source type="video/mp4" ';
                if (strpos($videosrc, 'http') !== false || strpos($videosrc, '{{') !== false) {
                $video .= 'data-src="' . $videosrc . '" ';
                } else {
                $video .= 'data-src="{{ page.url }}/' . $videosrc . '" ';
                }
                $video .= ' ></video>';
            }
            
            if ($image || $video) {
                $output = '<li class="left media">' . $image . $video . $content . '</li>';
            } else if ($content) {
                $output = '<li class="left">' . $image . $video . $content . '</li>';
            }
                
            return $output;
        });
        
    }
}