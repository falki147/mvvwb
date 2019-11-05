<?php

namespace MVVWB;

class RegisterHelper {
    private static function init() {
        add_theme_support('post-thumbnails');

        register_nav_menu('header-menu', __('Header Menu', 'mvvwb'));
        register_nav_menu('home-menu', __('Home Menu', 'mvvwb'));
        register_nav_menu('footer-menu', __('Footer Menu', 'mvvwb'));
    
        wp_enqueue_script('mvvwb-index', MVVWB_TEMPLATE_BASE . 'index.js');

        add_image_size('mvvwb-post', 1600, 550, true);

        add_filter('image_size_names_choose',  function ($sizes) {
            return array_merge($sizes, [
                'mvvwb-post' => __('MVVWB Post Image', 'mvvwb')
            ]);
        });
    }

    private static function widgetsInit() {
        register_sidebar([
            'name' => __('Home', 'mvvwb'),
            'id' => 'home-sidebar',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ]);
    }

    private static function addMetaBoxes() {
        LocationMetabox::addMetabox();
    }

    private static function saveMetaBoxes($postID) {
        LocationMetabox::saveMetabox($postID, $_POST);
    }

    public static function register() {
        load_theme_textdomain('mvvwb');
        add_post_type_support('page', 'excerpt');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        add_action('init', function () { self::init(); });
        add_action('widgets_init', function () { self::widgetsInit(); });
        add_action('add_meta_boxes', function () { self::addMetaBoxes(); });
        add_action('save_post', function ($postID) { self::saveMetaBoxes($postID); });
        
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
