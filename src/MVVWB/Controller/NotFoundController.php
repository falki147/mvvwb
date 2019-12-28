<?php
/**
 * Defines NotFoundController class
 */

namespace MVVWB\Controller;

/**
 * Class which helps rendering the 404 page
 *
 * This class is not intended to be intantiated
 */
class NotFoundController {
    /**
     * Renders the HTML of the 404 page content to the output buffer
     */
    public static function render() {
        include MVVWB_TEMPLATE_VIEWS . 'NotFoundView.php';
    }
}
