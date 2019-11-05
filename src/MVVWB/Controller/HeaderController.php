<?php

namespace MVVWB\Controller;

class HeaderController {
    public static function render() {
        $navigation = wp_nav_menu(
            [ 'theme_location' => 'header-menu', 'depth' => 1, 'echo' => false ]
        );
        
        $wpurl = get_bloginfo('wpurl');
        $name = get_bloginfo('name');

        include MVVWB_TEMPLATE_VIEWS . 'HeaderView.php';
    }
}
