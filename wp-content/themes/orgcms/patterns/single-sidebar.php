<?php
/**
 * Title: Category's Sidebar
 * Slug: orgcms/single-sidebar
 */
?>

<?php
if (is_single()) {
    $the_post = get_queried_object();
?>

<div class="article-category-list">

<?php
$params = array(
    'hide_empty' => false,
    'orderby' => 'term_order',
    'order' => 'ASC'
);
$all_categories = get_categories($params);
$categories_tree = build_categories_tree($all_categories);

$post_categories = get_the_category();
$the_category = null;
if ($post_categories) {
    $the_category = $post_categories[0];
    if ($the_category-> slug == 'overview') {
        $posts = get_posts(array(
            'post_type' => 'post',
            'category' => $the_category->term_id,
            'orderby' => 'date',
            'order' => 'ASC'
        ));
        if (!empty($posts)) {
            echo '<div class="category-title"><span>' . esc_html($the_category->name) . '</span></div>';
            echo '<ul>';
            foreach ($posts as $post) {
                if ($the_post->ID == $post->ID) {
                    echo '<li class="menu-item the-post"><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
                } else {
                    echo '<li class="menu-item"><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
                }
            }
            echo '</ul>';
        }
    } else {
        foreach ($categories_tree as $category) {
            if ($category->cat_ID == $the_category->cat_ID) {
                echo '<div class="category-title"><span>' . esc_html($category->name) . '</span></div>';
            } else {
                if ($category->children) {
                    echo '<ul>';
                    foreach ($category->children as $cate) {
                        if ($cate->cat_ID == $the_category->cat_ID) {
                            echo '<li class="menu-item current-category" data-category-id="' . $cate->cat_ID . '"><a href="' . esc_url(get_category_link($cate->cat_ID)) . '">' . $cate->name . '</a></li>';
                        } else {
                            echo '<li class="menu-item" data-category-id="' . $cate->cat_ID . '"><a href="' . esc_url(get_category_link($cate->cat_ID))  . '">' . $cate->name . '</a></li>';
                        }
                    }
                    echo '</ul>';
                }
            }
        }
    }

}

?>
</div>

<?php
}
?>