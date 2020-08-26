<?php
/**
 * Defines PostsController class
 */

namespace MVVWB\Controller;

use MVVWB\LocationHelper;

/**
 * Class which helps rendering the posts
 *
 * This class is not intended to be intantiated
 */
class PostsController {
    /**
     * Renders the HTML of the posts to the output buffer
     */
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

            $thumbnail = has_post_thumbnail() ? get_the_post_thumbnail(null, 'mvvwb-post') : '';

            $postData = [
                'thumbnail'  => self::filterThumbnail($thumbnail),
                'link'       => get_permalink(),
                'title'      => get_the_title(),
                'location'   => LocationHelper::getLocation($postObject),
                'content'    => $content,
                'isSameYear' => get_the_time('Y', $postObject) === date('Y'),
                'time'       => function ($fmt) use ($postObject) {
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

    /**
     * Filter the thumbnail HTML code so it works with lazy loading
     *
     * It replaces the src attribute from the img-tag with data-src and appends the lazy class.
     *
     * @param string $thumbnail the thumbnail HTML code
     * @return string the modified HTML code
     */
    private static function filterThumbnail($thumbnail) {
        $thumbnail = preg_replace_callback(
            '/(<img[^<]*)src=\"([^"]*)\"(.*>)/',
            function ($matches) {
                return $matches[1] . 'data-src="' . $matches[2] . '"' . $matches[3];
            },
            $thumbnail
        );

        return preg_replace_callback('/(<img[^<]*)class=\"([^"]*)\"(.*>)/', function ($matches) {
            return $matches[1] . 'class="' . $matches[2] . ' lazy"' . $matches[3];
        }, $thumbnail);
    }
}
