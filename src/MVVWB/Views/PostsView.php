<?php
/**
 * File which is used to render the posts
 *
 * Following variables are passed to it:
 * - $posts: An array of post entries with thmbnail, link, title, location, content and time
 * - $putDate: A boolean which indicates if the date should be included or not
 * - $singular: A booolean indicating if it's a single post or multiple ones
 * - $pagination: The HTML code of the pagination
 */

namespace MVVWB\Views;

?><div class="posts">
    <?php if (!$singular):?>
        <form role="search" class="posts-search" method="get" action="<?=esc_url(home_url('/'))?>">
            <input type="search" placeholder="<?=esc_attr__('Enter search term', 'mvvwb')?>" name="s" value="<?=esc_attr($_GET['s'] ?? '')?>">
            <input type="submit" value="<?=esc_attr__('Search', 'mvvwb')?>">
        </form>
    <?php endif?>
    <?php foreach ($posts as $postData): ?>
        <article class="post" aria-label="<?=esc_attr__('Post', 'mvvwb')?>">
            <?php if ($postData['thumbnail']):?>
                <?php if ($singular):?>
                    <?=$postData['thumbnail']?>
                <?php else:?>
                    <a href="<?=esc_url($postData['link'])?>"
                       aria-label="<?=esc_attr__('Go to Post', 'mvvwb')?>">
                        <?=$postData['thumbnail']?>
                    </a>
                <?php endif?>
            <?php endif?>

            <div class="post-content<?=$putDate?' post-has-date':''?><?=$postData['thumbnail'] ? ' has-thumbnail' : ''?>">
                <?php if ($putDate):?>
                    <time class="post-date" datetime="<?=$postData['time']('Y-m-d')?>">
                        <?php if ($postData['isSameYear']): ?>
                            <?=$postData['time']('j<\\s\\p\\a\\n>M</\\s\\p\\a\\n>')?>
                        <?php else: ?>
                            <?=$postData['time'](
                                'j<\\s\\p\\a\\n>M</\\s\\p\\a\\n><\\s\\p\\a\\n>\'y</\\s\\p\\a\\n>')
                            ?>
                        <?php endif; ?>
                    </time>
                <?php endif?>

                <h2 class="post-title">
                    <?php if ($singular):?>
                        <?=$postData['title']?>
                    <?php else:?>
                        <a href="<?=esc_url($postData['link'])?>">
                            <?=$postData['title']?>
                        </a>
                    <?php endif?>
                </h2>

                <div class="title-break">
                    <?php if ($putDate || $postData['location']):?>
                        <div class="post-info">
                            <?=$postData['location']?>

                            <?php if ($putDate):?>
                                <span class="post-date-mobile">
                                    <?php if ($postData['location']):?>
                                        -
                                    <?php endif?>

                                    <time datetime="<?=$postData['time']('Y-m-d')?>">
                                        <?php if ($postData['isSameYear']): ?>
                                            <?=$postData['time']('j. M')?>
                                        <?php else: ?>
                                            <?=$postData['time']('j. M Y')?>
                                        <?php endif; ?>
                                    </time>
                                </span>
                            <?php endif?>
                        </div>
                    <?php endif?>
                </div>

                <?=$postData['content']?>

                <?php if (!$singular):?>
                    <p>
                        <a href="<?=esc_url($postData['link'])?>" class="button">
                            <?=esc_html__('Continue...', 'mvvwb')?>
                        </a>
                    </p>
                <?php endif?>
            </div>
        </article>
    <?php endforeach ?>

    <?=$pagination?>
</div>
