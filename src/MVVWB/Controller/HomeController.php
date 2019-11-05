<?php

namespace MVVWB\Controller;

class HomeController {
    public static function render() {
        ob_start();

        if (is_active_sidebar('home-sidebar'))
                dynamic_sidebar('home-sidebar');

        $homeWidgets = ob_get_clean();

        $locations = get_nav_menu_locations();
        $menuObject = wp_get_nav_menu_object($locations['home-menu']);
        $menu = [];

        foreach (wp_get_nav_menu_items($menuObject) as $menuItem) {
            $item = [
                'title' => $menuItem->title,
                'url'   => $menuItem->url,
                'text'  => ''
            ];

            if ($menuItem->object === 'category')
                $item['text'] = category_description($menuItem->object_id);
            elseif ($menuItem->object !== 'custom')
                $item['text'] = get_the_excerpt($menuItem->object_id);

            $menu[] = $item;
        }

        $name = get_bloginfo('name');

        include MVVWB_TEMPLATE_VIEWS . 'HomeView.php';
    }
}
