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
                        <?=$postData['time']('j<\\sp\\a\\n>M</\\sp\\a\\n>')?>
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
                                        <?=$postData['time']('j. M')?>
                                    </time>
                                </span>
                            <?php endif?>
                        </div>
                    <?php endif?>
                </div>

                <?=$postData['content']?>

                <?php if (!$singular):?>
                    <p>
                        <a href="<?=esc_url($postData['link'])?>" class="post-continue">
                            <?=esc_html__('Continue...', 'mvvwb')?>
                        </a>
                    </p>
                <?php endif?>
            </div>
        </article>
    <?php endforeach ?>

    <?=$pagination?>
</div>
