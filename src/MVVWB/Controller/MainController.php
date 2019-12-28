<?php
/**
 * Defines MainController class
 */

namespace MVVWB\Controller;

/**
 * Class which renders everything
 *
 * This class is not intended to be intantiated
 */
class MainController {
    /**
     * Renders the HTML of the whole page to the output buffer
     * 
     * It combines the header, content and footer.
     */
    public static function render() {
        include MVVWB_TEMPLATE_VIEWS . 'MainView.php';
    }
}
