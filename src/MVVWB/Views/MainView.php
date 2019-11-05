<!doctype html>

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link href="<?=MVVWB_TEMPLATE_BASE?>style.css" rel="stylesheet" />
        <link rel="stylesheet"
              href="//fonts.googleapis.com/css?family=Raleway:300,400,500" type="text/css" />
        <?php wp_head(); ?>
    </head>
    <body>
        <a class="skiplink" href="#main"><?=esc_html__('Go to Content', 'mvvwb')?></a>
        <?php MVVWB\Controller\HeaderController::render(); ?>
        <?php MVVWB\Controller\ContentController::render(); ?>
        <?php MVVWB\Controller\FooterController::render(); ?>
        <?php wp_footer(); ?>
    </body>
</html>
