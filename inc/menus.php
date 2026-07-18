<?php
/**
 * Custom nav menu walker
 */

if (!defined('ABSPATH')) {
    exit;
}

class Cusbro_Nav_Walker extends Walker_Nav_Menu
{
    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0): void
    {
        $item = $data_object;

        $classes   = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        if (in_array('current-menu-item', $classes, true)) {
            $classes[] = 'is-active';
        }

        $class_names = implode(' ', array_filter($classes));
        $output .= '<li class="' . esc_attr($class_names) . '">';

        $atts           = [];
        $atts['href']   = !empty($item->url) ? $item->url : '#';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';

        if (in_array('current-menu-item', $classes, true)) {
            $atts['aria-current'] = 'page';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }
}
