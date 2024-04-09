<?php
/**
 * orgcms functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package orgcms
 * @since orgcms 1.0
 */

function custom_excerpt_length($length)
{
    return 100;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

function enqueue_my_stylesheets()
{
    wp_enqueue_style('swiper', 'https://cdn.bootcdn.net/ajax/libs/Swiper/9.4.1/swiper-bundle.css');
    wp_enqueue_style('my_styles', get_template_directory_uri() . '/assets/css/style.css');
}

add_action('wp_enqueue_scripts', 'enqueue_my_stylesheets');

function enqueue_my_scripts()
{
    wp_enqueue_script('jq', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js');
    wp_enqueue_script('swiper', 'https://cdn.bootcdn.net/ajax/libs/Swiper/9.4.1/swiper-bundle.js');
    wp_enqueue_script('my_scripts', get_template_directory_uri() . '/assets/js/main.js');
}

add_action('wp_enqueue_scripts', 'enqueue_my_scripts');

/**
 * convert flat categories to category tree
 * @param $categories
 * @param $parent_id
 * @return array
 */
function build_categories_tree($categories, $parent_id = 0)
{
    $tree = [];
    foreach ($categories as $category) {
        if ($category->category_parent == $parent_id) {
            $children = build_categories_tree($categories, $category->term_id);
            $category->children = $children;
            $tree[] = $category;
        }
    }
    return $tree;
}

/**
 * get hierarchy from category tree by cat_ID
 * 3 levels only
 * @param $category_tree
 * @param $category_id
 * @return array
 */
function get_categories_hierarchy($category_tree, $category_id)
{
    $result = [];

    if ($category_tree) {
        foreach ($category_tree as $category) { // LEVEL 0
            if ($category->cat_ID == $category_id) {
                $result[] = $category;
            } else {
                if ($category->children) {
                    foreach ($category->children as $cate) { // LEVEL 1
                        if ($cate->cat_ID == $category_id) {
                            $result[] = $category;
                            $result[] = $cate;
                        } else {
                            if ($cate->children) {
                                foreach ($cate->children as $c) { // LEVEL 2
                                    if ($c->cat_ID == $category_id) {
                                        $result[] = $category;
                                        $result[] = $cate;
                                        $result[] = $c;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    return $result;
}

function print_r_pre($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
