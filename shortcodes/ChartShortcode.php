<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ChartShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('chart', function(ShortcodeInterface $sc) {
            
            $content = strip_tags($sc->getContent(),'false');
            $type = strip_tags($sc->getParameter('type', 'false'));
            $title = strip_tags($sc->getParameter('title', false));
            $items = strip_tags($sc->getParameter('items', false));
            $values = strip_tags($sc->getParameter('values', false));
            $uniqueid = mt_rand(1,1000000000);
            
            //format items
            $items = "'" . str_replace(array("'", ","), array("\\'", "','"), $items) . "'";
            
            $output = '<canvas id="' . $uniqueid . '" ></canvas>';
            $output .= '<script> $( document ).ready(function() { $.getScript("https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js" ).done(function( script, textStatus ) {';
            $output .= 'var _' . $uniqueid . 'Element = document.getElementById("' . $uniqueid . '");';
            $output .= 'var _' . $uniqueid . 'Chart = new Chart(_' . $uniqueid . 'Element, {';
            
            if(max(array_map('intval', explode(',', $values))) >= 10) {
                $minscale = 0;
                $maxscale = 10;
            } else {
                $minscale = min(array_map('intval', explode(',', $values))) /100*32;
                $maxscale = max(array_map('intval', explode(',', $values))) /100*128;
            }
            
            if($title && $items && $values) {
                if(strcasecmp($type, 'bar') == 0 || strcasecmp($type, 'horizontalBar') == 0) {
                    $values .= ', ' . $minscale;
                    $values .= ', ' . $maxscale;
                    $output .= 'type: "' . $type . '", ';
                    $output .= 'data: { labels:[' . $items . '], ';
                    $output .= 'datasets: [{'; 
                    $output .= 'label:"' . $title . '", ';
                    $output .= 'data:[' . $values . '], ';
                    $output .= 'backgroundColor: ["rgba(33, 150, 243, 0.5)", "rgba(33, 98, 243, 0.5)", "rgba(33, 45, 243, 0.5)", "rgba(74, 33, 243, 0.5)", "rgba(126, 33, 243, 0.5)", "rgba(179, 33, 243, 0.5)"],
                borderColor: ["rgba(33, 150, 243, 1)", "rgba(33, 98, 243, 1)", "rgba(33, 45, 243, 1)", "rgba(74, 33, 243, 1)", "rgba(126, 33, 243, 1)", "rgba(179, 33, 243, 1)"], borderWidth: 3';
                    $output .= '}]'; 
                    $output .= '} ';
                    $output .= '}); }); }); </script>';

                    return $output;

                } else if (strcasecmp($type, 'radar') == 0) {
                    $output .= 'type: "' . $type . '", ';
                    $output .= 'data: { labels:[' . $items . '], ';
                    $output .= 'datasets: [';
                    $output .= '{'; 
                    $output .= 'label:"' . $title . '", ';
                    $output .= 'data:[' . $values . '], ';
                    $output .= 'backgroundColor: "rgba(33, 150, 243, 0.167)", borderColor: "rgba(33, 150, 243, 1)", pointBackgroundColor: "rgba(33, 150, 243, 1)", pointBorderColor: "#fff", pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "rgba(33, 150, 243, 1)"';
                    $output .= '}';
                    
                    $title2 = strip_tags($sc->getParameter('title2', false));
                    $values2 = strip_tags($sc->getParameter('values2', false));
                    
                    if ($title2 && $values2) {
                        $output .= ', {';
                        $output .= 'label:"' . $title2 . '", ';
                        $output .= 'data:[' . $values2 . '], ';
                        $output .= 'backgroundColor: "rgba(179, 33, 243, 0.167)", borderColor: "rgba(179, 33, 243, 1)", pointBackgroundColor: "rgba(179, 33, 243, 1)", pointBorderColor: "#fff", pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "rgba(179, 33, 243, 1)"';
                        $output .= '}';
                    }
                    
                    $title3 = strip_tags($sc->getParameter('title3', false));
                    $values3 = strip_tags($sc->getParameter('values3', false));
                    
                    if ($title3 && $values3) {
                        $output .= ', {';
                        $output .= 'label:"' . $title3 . '", ';
                        $output .= 'data:[' . $values3 . '], ';
                        $output .= 'backgroundColor: "rgba(33, 45, 243, 0.167)", borderColor: "rgba(33, 45, 243, 1)", pointBackgroundColor: "rgba(33, 45, 243, 1)", pointBorderColor: "#fff", pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "rgba(33, 45, 243, 1)"';
                        $output .= '}';
                    }
                    
                    $title4 = strip_tags($sc->getParameter('title4', false));
                    $values4 = strip_tags($sc->getParameter('values4', false));
                    
                    if ($title4 && $values4) {
                        $output .= ', {';
                        $output .= 'label:"' . $title4 . '", ';
                        $output .= 'data:[' . $values4 . '], ';
                        $output .= 'backgroundColor: "rgba(126, 33, 243, 0.167)", borderColor: "rgba(126, 33, 243, 1)", pointBackgroundColor: "rgba(126, 33, 243, 1)", pointBorderColor: "#fff", pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "rgba(126, 33, 243, 1)"';
                        $output .= '}';
                    }
                    
                    $title5 = strip_tags($sc->getParameter('title5', false));
                    $values5 = strip_tags($sc->getParameter('values5', false));
                    
                    if ($title5 && $values5) {
                        $output .= ', {';
                        $output .= 'label:"' . $title5 . '", ';
                        $output .= 'data:[' . $values5 . '], ';
                        $output .= 'backgroundColor: "rgba(74, 33, 243, 0.167)", borderColor: "rgba(74, 33, 243, 1)", pointBackgroundColor: "rgba(74, 33, 243, 1)", pointBorderColor: "#fff", pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "rgba(74, 33, 243, 1)"';
                        $output .= '}';
                    }
                    
                    $title6 = strip_tags($sc->getParameter('title6', false));
                    $values6 = strip_tags($sc->getParameter('values6', false));
                    
                    if ($title6 && $values6) {
                        $output .= ', {';
                        $output .= 'label:"' . $title6 . '", ';
                        $output .= 'data:[' . $values6 . '], ';
                        $output .= 'backgroundColor: "rgba(33, 98, 243, 0.167)", borderColor: "rgba(33, 98, 243, 1)", pointBackgroundColor: "rgba(33, 98, 243, 1)", pointBorderColor: "#fff", pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "rgba(33, 98, 243, 1)"';
                        $output .= '}';
                    }
                    
                    
                    $output .= '],'; 
                    $output .= '}, ';
                    $output .= 'options: { scale: { ticks: { min: ' . $minscale . ', max: ' . $maxscale .'} } }';
                    $output .= '}); }); }); </script>';

                    return $output;
                }
            } else {
                return "A chart used to be here.";
            }
        }); 
    }
}