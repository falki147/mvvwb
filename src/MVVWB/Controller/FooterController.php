<?php
/**
 * Defines FooterController class
 */

namespace MVVWB\Controller;

/**
 * Class which helps rendering the footer
 *
 * This class is not intended to be intantiated
 */
class FooterController {
    /**
     * Renders the HTML of the footer to the output buffer
     */
    public static function render() {
        $navigation = wp_nav_menu([
            'theme_location' => 'footer-menu', 'depth' => 1, 'echo' => false
        ]);

        include MVVWB_TEMPLATE_VIEWS . 'FooterView.php';
    }
}
