<?php
/**
 * Defines HeaderController class
 */

namespace MVVWB\Controller;

/**
 * Class which helps rendering the header
 *
 * This class is not intended to be intantiated
 */
class HeaderController {
    /**
     * Renders the HTML of the header to the output buffer
     */
    public static function render() {
        $navigation = wp_nav_menu(
            [ 'theme_location' => 'header-menu', 'depth' => 1, 'echo' => false ]
        );
        
        $wpurl = get_bloginfo('wpurl');
        $name = get_bloginfo('name');

        include MVVWB_TEMPLATE_VIEWS . 'HeaderView.php';
    }
}
