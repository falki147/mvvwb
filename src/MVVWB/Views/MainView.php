<?php
/**
 * File which is used to render everything
 */

namespace MVVWB\Views;

use MVVWB\Controller\HeaderController;
use MVVWB\Controller\ContentController;
use MVVWB\Controller\FooterController;

?><!doctype html>

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body>
        <a class="skiplink" href="#main"><?=esc_html__('Go to Content', 'mvvwb')?></a>
        <?php HeaderController::render(); ?>
        <?php ContentController::render(); ?>
        <?php FooterController::render(); ?>
        <?php wp_footer(); ?>
    </body>
</html>
