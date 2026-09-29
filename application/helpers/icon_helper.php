<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('normalize_fa_icon')) {
    /**
     * Normalizes any Font Awesome icon input into a standard CSS class string.
     * Examples:
     * - '<i class="fa-brands fa-mix"></i>' -> 'fa-brands fa-mix'
     * - 'fa-fire'                          -> 'fa-solid fa-fire'
     * - 'fa-solid fa-fire'                 -> 'fa-solid fa-fire'
     * - 'fa-brands fa-mix'                 -> 'fa-brands fa-mix'
     * - 'blender'                          -> 'fa-solid fa-blender'
     * - 'fas fa-fire'                      -> 'fa-solid fa-fire'
     * 
     * @param string $icon
     * @param string $default
     * @return string
     */
    function normalize_fa_icon($icon, $default = 'fa-solid fa-box') {
        if (empty($icon)) {
            return $default;
        }

        $icon = trim($icon);

        // If user provided HTML tag like <i class="..."></i> or <span class="...">
        if (preg_match('/class=["\']([^"\']+)["\']/', $icon, $matches)) {
            $icon = $matches[1];
        }

        // Strip any remaining HTML tags
        $icon = strip_tags($icon);
        $icon = trim($icon);

        if (empty($icon)) {
            return $default;
        }

        // Split classes by whitespace
        $tokens = preg_split('/\s+/', $icon);
        $prefix = '';
        $icon_name = '';

        foreach ($tokens as $t) {
            $t = strtolower(trim($t));
            if (in_array($t, ['fa-solid', 'fas'])) {
                $prefix = 'fa-solid';
            } elseif (in_array($t, ['fa-regular', 'far'])) {
                $prefix = 'fa-regular';
            } elseif (in_array($t, ['fa-brands', 'fab'])) {
                $prefix = 'fa-brands';
            } elseif (in_array($t, ['fa-light', 'fal'])) {
                $prefix = 'fa-light';
            } elseif (in_array($t, ['fa-thin', 'fat'])) {
                $prefix = 'fa-thin';
            } elseif (in_array($t, ['fa-duotone', 'fad'])) {
                $prefix = 'fa-duotone';
            } elseif ($t === 'fa') {
                if (empty($prefix)) $prefix = 'fa-solid';
            } elseif (strpos($t, 'fa-') === 0) {
                $icon_name = $t;
            } elseif (!empty($t)) {
                $icon_name = 'fa-' . $t;
            }
        }

        if (empty($icon_name)) {
            return $default;
        }

        if (empty($prefix)) {
            $prefix = 'fa-solid';
        }

        return $prefix . ' ' . $icon_name;
    }
}

if (!function_exists('get_fa_display_name')) {
    /**
     * Get clean display name for badge (e.g. 'fa-blender' or 'fa-brands fa-mix')
     * 
     * @param string $icon
     * @return string
     */
    function get_fa_display_name($icon) {
        $normalized = normalize_fa_icon($icon, '');
        if (empty($normalized)) {
            return '—';
        }
        $parts = explode(' ', $normalized);
        if (count($parts) === 2 && $parts[0] === 'fa-solid') {
            return $parts[1]; // e.g. fa-blender
        }
        return $normalized; // e.g. fa-brands fa-mix
    }
}

if (!function_exists('render_category_icon_badge')) {
    /**
     * Renders category icon badge with proper icon and label
     * 
     * @param string $icon
     * @return string
     */
    function render_category_icon_badge($icon) {
        if (empty($icon)) {
            return '<span class="text-muted small fst-italic">—</span>';
        }
        $normalized = normalize_fa_icon($icon);
        $display = get_fa_display_name($icon);
        return '<div class="cat-icon-badge">' .
               '<i class="' . html_escape($normalized) . '"></i>' .
               '<span>' . html_escape($display) . '</span>' .
               '</div>';
    }
}
