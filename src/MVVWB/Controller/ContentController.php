<?php

namespace MVVWB\Controller;

class ContentController {
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
