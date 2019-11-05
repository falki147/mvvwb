<?php

namespace MVVWB;

class TitleHelper {
    public static function transform($title) {
        return preg_replace_callback('/^\\S*/', function ($matches) {
            return '<span>' . $matches[0] . '</span>';
        }, $title);
    }
}
