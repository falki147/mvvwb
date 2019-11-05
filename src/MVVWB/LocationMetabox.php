<?php

namespace MVVWB;

class LocationMetabox {
    const LOCATION_NAME = 'mvvwb_location';

    public static function addMetabox() {
        add_meta_box(
            'location-box',
            __('Location', 'mvvwb'),
            function ($post) {
                $location = LocationHelper::getLocation($post);

                include MVVWB_TEMPLATE_ADMIN_VIEWS . 'LocationMetaboxView.php';
            },
            [ 'post' ], 'side'
        );
    }

    public static function saveMetabox($postID, $values) {
        if (isset($values[self::LOCATION_NAME]))
            LocationHelper::setLocation(\get_post($postID), $values[self::LOCATION_NAME]);
    }
}
