<?php

class Utility {

    // Redirect to a different page with an optional message and prefill data

    // Show flash message

    // Check user login status

    // Display navigation menu
    public static function showNav($pages = NAV_PAGES)
    {
        echo '<nav><ul>';
        foreach ($pages as $item) {
            $title = htmlspecialchars($item['title'] ?? '', ENT_QUOTES, 'UTF-8');
            $url   = htmlspecialchars($item['url'] ?? '', ENT_QUOTES, 'UTF-8');
            echo "<li><a href='$url'>$title</a></li>";
        }
        echo '</ul></nav>';
    }

    // Logout user

    // Get prefill data for specified keys

    // Clear prefill data

}