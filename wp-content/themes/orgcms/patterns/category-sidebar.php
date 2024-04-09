<?php
/**
 * Title: Category's Sidebar
 * Slug: orgcms/category-sidebar
 */
?>

<div class="sidebar-cate-list">
<?php
$current_category = get_queried_object();
//print_r_pre($current_category);

if ($current_category->category_parent == 0) {
    echo '<div class="sidebar-cate-item current-category">';
    echo '<a href="' . esc_url(get_category_link($current_category->term_id)) . '">' . esc_html($current_category->name) . '</a>';
    echo '</div>';
} else {
    $params = array(
        'hide_empty' => false,
        'orderby' => 'term_order',
        'order' => 'ASC'
    );
    $all_categories = get_categories($params);

    $siblings = array_filter($all_categories, function ($item) use ($current_category) {
        return $item->category_parent == $current_category->category_parent;
    });
//    print_r_pre($siblings);

    foreach ($siblings as $sibling) {
        echo $sibling->cat_ID == $current_category->cat_ID ? '<div class="sidebar-cate-item current-category">' : '<div class="sidebar-cate-item">';
        echo '<a href="' . esc_url(get_category_link($sibling->term_id)) . '">' . esc_html($sibling->name) . '</a></div>';

//        if ($sibling->cat_ID == $current_category->cat_ID) {
//            echo '<div class="sidebar-cate-item current-category">' . esc_html($sibling->name) . '</div>';
//        } else {
//            echo '<div class="sidebar-cate-item"><a href="' . esc_url(get_category_link($sibling->cat_ID)) . '">' . esc_html($sibling->name) . '</div>';
//        }
    }
}
?>
</div>
