<header class="header">
    <div class="header-bar-mobile">
        <h1 class="title">
            <a href="<?=esc_url($wpurl)?>">
                <?=MVVWB\TitleHelper::transform($name)?>
            </a>
        </h1>
        <a class="navigation-button-mobile"
           href="#"
           aria-label="<?=esc_attr__('Open Menu', 'mvvwb')?>"
           aria-controls="navigation">
        </a>
    </div>
    <nav class="navigation" id="navigation" aria-label="<?=esc_attr__('Main Menu', 'mvvwb')?>">
        <?=$navigation?>
    </nav>
</header>
<div class="header-bottom"></div>
