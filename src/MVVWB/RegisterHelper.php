<?php
/**
 * Defines RegisterHelper class
 */

namespace MVVWB;

/**
 * Provides functionality for registering menus, post thumbnail sizes, scripts, etc.
 *
 * This class is not intended to be intantiated
 */
class RegisterHelper {
    /** Width of the post thumbnail/image */
    const POST_IMAGE_WIDTH = 1600;

    /** Height of the post thumbnail/image */
    const POST_IMAGE_HEIGHT = 550;

    /**
     * Add menus, post thumbnail sizes, scripts, etc.
     */
    private static function init() {
        add_theme_support('post-thumbnails');

        register_nav_menu('header-menu', __('Header Menu', 'mvvwb'));
        register_nav_menu('home-menu', __('Home Menu', 'mvvwb'));
        register_nav_menu('footer-menu', __('Footer Menu', 'mvvwb'));

        add_image_size('mvvwb-post', self::POST_IMAGE_WIDTH, self::POST_IMAGE_HEIGHT, true);

        // Adjust image size if any of the image dimensions are less then the specified width and
        // height
		add_filter('intermediate_image_sizes_advanced', function ($new_sizes, $image_meta) {
            $factor = min(
                $image_meta['width'] / self::POST_IMAGE_WIDTH,
                $image_meta['height'] / self::POST_IMAGE_HEIGHT
            );

			if (isset($new_sizes['mvvwb-post']) && $factor < 1) {
                $new_sizes['mvvwb-post']['width'] = self::POST_IMAGE_WIDTH * $factor;
                $new_sizes['mvvwb-post']['height'] = self::POST_IMAGE_HEIGHT * $factor;
			}
			
			return $new_sizes;
		}, 10, 2);

        add_filter('image_size_names_choose',  function ($sizes) {
            return array_merge($sizes, [
                'mvvwb-post' => __('MVVWB Post Image', 'mvvwb')
            ]);
        });
    }

    /**
     * Add wdigets on home page
     */
    private static function widgetsInit() {
        register_sidebar([
            'name' => __('Home', 'mvvwb'),
            'id' => 'home-sidebar',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ]);
    }

    /**
     * Add metaboxes to wordpress
     */
    private static function addMetaBoxes() {
        LocationMetabox::addMetabox();
    }

    /**
     * Save metaboxes
     *
     * This function will also be called even when the metabox itself isn't active. The data is
     * taken from the $_POST variable.
     *
     * @param int $postID id of the post which was edited
     */
    private static function saveMetaBoxes($postID) {
        LocationMetabox::saveMetabox($postID, $_POST);
    }

    /**
     * Adds the styles and scripts needed for the frontend
     */
    private static function addScripts() {
        wp_enqueue_style('mvvwb', MVVWB_TEMPLATE_BASE . 'style.css');
        wp_enqueue_script('mvvwb', MVVWB_TEMPLATE_BASE . 'index.js');
    }

    /**
     * Register hooks for initializing template
     */
    public static function register() {
        load_theme_textdomain('mvvwb');
        add_post_type_support('page', 'excerpt');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        add_action('init', function () { self::init(); });
        add_action('widgets_init', function () { self::widgetsInit(); });
        add_action('add_meta_boxes', function () { self::addMetaBoxes(); });
        add_action('save_post', function ($postID) { self::saveMetaBoxes($postID); });
        add_action('wp_enqueue_scripts', function () { self::addScripts(); });
        
        // Create excerpt from first paragraph if it wasn't set by hand
        add_filter('wp_trim_excerpt', function ($text, $rawExcerpt) {
            if(!$rawExcerpt) {
                $text = get_the_content('');
                $text = strip_shortcodes($text);
                $text = excerpt_remove_blocks($text);
                $text = substr($text, 0, strpos($text, '</p>') + 4);
            }
        
            return $text;
        }, 10, 2);
    }
}
