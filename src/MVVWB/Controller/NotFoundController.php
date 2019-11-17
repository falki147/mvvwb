<?php

namespace MVVWB\Controller;

class NotFoundController {
    public static function render() {
        include MVVWB_TEMPLATE_VIEWS . 'NotFoundView.php';
    }
}
