<?php

namespace MVVWB\Controller;

use MVVWB\LocationHelper;

class PostsController {
    public static function render() {
        $posts = [];

        while (have_posts()) {
            the_post();

            $postObject = get_post();

            ob_start();

            if (is_singular())
                the_content();
            else
                the_excerpt();

            $content = ob_get_clean();

            $postData = [
                'thumbnail' => has_post_thumbnail() ? get_the_post_thumbnail(null, 'mvvwb-post') : '',
                'link'      => get_permalink(),
                'title'     => get_the_title(),
                'location'  => LocationHelper::getLocation($postObject),
                'content'   => $content,
                'time'      => function ($fmt) use ($postObject) {
                    return get_the_time($fmt, $postObject);
                }
            ];

            $posts[] = $postData;
        }

        $putDate = !is_page();
        $singular = is_singular();

        $pagination = get_the_posts_pagination([
            'mid_size' => 2,
            'prev_text' => __('Back', 'mvvwb'),
            'next_text' => __('Forward', 'mvvwb'),
        ]);

        include MVVWB_TEMPLATE_VIEWS . 'PostsView.php';
    }
}
