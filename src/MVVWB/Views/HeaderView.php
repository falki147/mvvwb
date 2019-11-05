<header class="header">
    <div class="header-bar-mobile">
        <h1 class="title">
            <a href="<?=esc_url($wpurl)?>">
                <?=MVVWB\TitleHelper::transform($name)?>
            </a>
        </h1>
        <button class="navigation-button-mobile"
                type="button" aria-label="<?=esc_attr__('Open Menu', 'mvvwb')?>"
                aria-controls="navigation">
        </button>
    </div>
    <nav class="navigation" id="navigation" aria-label="<?=esc_attr__('Main Menu', 'mvvwb')?>">
        <?=$navigation?>
    </nav>
</header>
<div class="header-bottom"></div>
