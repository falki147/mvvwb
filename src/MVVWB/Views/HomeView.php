<div class="home-widgets">
    <?=$homeWidgets?>
</div>
<div class="home">
    <h2 class="title">
        <?=MVVWB\TitleHelper::transform($name)?>
    </h2>
    <div class="title-break"></div>
    <?php if ($menu): ?>
        <nav class="home-menu" aria-label="<?=esc_attr__('Home Menu', 'mvvwb')?>">
            <?php foreach ($menu as $item): ?>
                <div class="post">
                    <h3 class="post-title"><?=esc_html($item['title'])?></h3>

                    <?php if (!empty($item['text'])): ?>
                        <div class="post-excerpt"><?=$item['text']?></div>
                    <?php endif ?>

                    <a class="post-continue" href="<?=esc_url($item['url'])?>">
                        <?=esc_html__('Continue...', 'mvvwb')?>
                    </a>
                </div>
            <?php endforeach ?>
        </nav>
    <?php endif ?>
</div>