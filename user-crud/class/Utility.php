<?php

class Utility {

    // Redirect to a different page with an optional message and prefill data
    public static function redirect($url, $msg = []) {
        // You can extend this method later to handle flash messages and prefill data

        header("Location: " . BASE_URL . $url);
        exit();
    }

    // Show flash message

    // Check user login status
    public static function checkLogin($login=true) {
        if ($login && !isset($_SESSION['user'])) {
            self::redirect('login.php', "Please log in to access this page.");
        } elseif (!$login && isset($_SESSION['user'])) {
            self::redirect('index.php');
        }
    }

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
    public static function logout() {
        unset($_SESSION['user']);
        self::redirect('login.php');
    }

    // Get prefill data for specified keys

    // Clear prefill data

}