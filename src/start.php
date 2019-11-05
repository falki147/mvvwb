<?php

if (!defined('MVVWB_TEMPLATE_BASE'))
    define('MVVWB_TEMPLATE_BASE', get_template_directory_uri() . '/');

if (!defined('MVVWB_TEMPLATE_VERSION'))
    define('MVVWB_TEMPLATE_VERSION', '1.0.0');

if (!defined('MVVWB_TEMPLATE_VIEWS'))
    define('MVVWB_TEMPLATE_VIEWS', implode(DIRECTORY_SEPARATOR, [ __DIR__, 'MVVWB', 'Views', '' ]));

if (!defined('MVVWB_TEMPLATE_ADMIN_VIEWS'))
    define('MVVWB_TEMPLATE_ADMIN_VIEWS', implode(DIRECTORY_SEPARATOR, [ __DIR__, 'MVVWB', 'AdminViews', '' ]));

if (!defined('MVVWB_TEMPLATE_AUTOLOAD')) {
    spl_autoload_register(function ($class) {
        if (strncmp('MVVWB', $class, 5) !== 0)
            return false;

        // Replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

        // if the file exists, require it
        if (file_exists($file)) {
            require_once $file;
            return true;
        }

        return false;
    });

    define('MVVWB_TEMPLATE_AUTOLOAD', '1');
}
