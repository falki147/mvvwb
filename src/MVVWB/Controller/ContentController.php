<?php
/**
 * Defines ContentController class
 */

namespace MVVWB\Controller;

/**
 * Class which helps rendering the content e.g. posts, 404 site or home page
 *
 * This class is not intended to be intantiated
 */
class ContentController {
    /**
     * Renders the HTML of the content to the output buffer
     */
    public static function render() {
        echo '<main id="main">';

        if (is_404())
            NotFoundController::render();
        elseif (is_home())
            HomeController::render();
        else
            PostsController::render();

        echo '</main>';
    }
}
