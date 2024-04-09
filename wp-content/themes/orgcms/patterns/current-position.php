<?php
/**
 * Title: Category's Sidebar
 * Slug: orgcms/current-position
 */
?>

<?php
$params = array(
    'hide_empty' => false,
    'orderby' => 'term_order',
    'order' => 'ASC'
);
$all_categories = get_categories($params);
$categories_tree = build_categories_tree($all_categories);

if (is_single()) {
    $post = get_queried_object();

    echo '<div class="breadcrumbs">';
    echo '<span class="breadcrumb home"><a href="/">首页</a></span>';

    $post_categories = get_the_category();
    $the_category = null;
    if ($post_categories) {
        $the_category = $post_categories[0];
        if ($the_category->slug == 'overview') {
            echo '<span class="breadcrumb">' . esc_html($the_category->name) . '</span>';
        } else {
            $post_cate_hierarchy = get_categories_hierarchy($categories_tree, $the_category->cat_ID);
            if ($post_cate_hierarchy[0]) {
                if ($post_cate_hierarchy[0]->children) {
                    echo '<span class="breadcrumb current-category">' . esc_html($post_cate_hierarchy[0]->name) . '</span>';
                } else {
                    echo '<span class="breadcrumb parent-category"><a href="' . esc_url(get_category_link($post_cate_hierarchy[0]->term_id)) . '">' . esc_html($post_cate_hierarchy[0]->name) . '</a></span>';
                }
            }
            if ($post_cate_hierarchy[1]) {
                echo '<span class="breadcrumb current-category"><a href="' . esc_url(get_category_link($post_cate_hierarchy[1]->term_id)) . '">' . esc_html($post_cate_hierarchy[0]->name) . '</a></span>';
            }
        }
    }

    echo '<span class="breadcrumb post-title" data-post-id="' . $post->ID . '">' . esc_html($post->post_title) . '</span>';

    echo '</div>';
}

if (is_category()) {
    $category = get_queried_object();
//    print_r_pre($category);

    echo '<div class="breadcrumbs">';
    echo '<span class="breadcrumb home"><a href="/">首页</a></span>';

    $cate_hierarchy = get_categories_hierarchy($categories_tree, $category->cat_ID);
    if ($cate_hierarchy[0]) {
        if ($cate_hierarchy[0]->children) {
            echo '<span class="breadcrumb parent-category">' . esc_html($cate_hierarchy[0]->name) . '</span>';
        } else {
            echo '<span class="breadcrumb current-category" data-category-id="' . $cate_hierarchy[0]->cat_ID . '">' . esc_html($cate_hierarchy[0]->name) . '</span>';
        }
    }
    if ($cate_hierarchy[1]) {
        echo '<span class="breadcrumb current-category" data-category-id="' . $cate_hierarchy[1]->cat_ID . '">' . esc_html($cate_hierarchy[1]->name) . '</span>';
    }

    echo '</div>';
}
?>
