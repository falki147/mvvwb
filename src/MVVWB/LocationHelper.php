<?php

namespace MVVWB;

class LocationHelper {
    public static function getLocation($post) {
        return get_post_meta($post->ID, 'mvvwb_location', true);
    }

    public static function setLocation($post, $location) {
        update_post_meta($post->ID, 'mvvwb_location', $location);
    }
}
