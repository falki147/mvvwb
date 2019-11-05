<?php

namespace MVVWB\Controller;

class FooterController {
    public static function render() {
        $navigation = wp_nav_menu([
            'theme_location' => 'footer-menu', 'depth' => 1, 'echo' => false
        ]);

        include MVVWB_TEMPLATE_VIEWS . 'FooterView.php';
    }
}
