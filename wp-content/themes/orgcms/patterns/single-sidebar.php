<?php
/**
 * Title: Category's Sidebar
 * Slug: orgcms/single-sidebar
 */

if (is_single()) {
    // 当前文章
    $the_post = get_queried_object();
?>

<div class="article-category-list">

<?php
// 所有分类目录
$params = array(
    'hide_empty' => false,
    'orderby' => 'term_order',
    'order' => 'ASC'
);
$all_categories = get_categories($params);
$categories_tree = build_categories_tree($all_categories);
//print_r_pre($categories_tree);

// 当前文章分类目录
$post_categories = get_the_category();
$the_category = null;
if ($post_categories) {
    $the_category = $post_categories[0];
//    print_r_pre($the_category);
    if ($the_category-> slug == 'overview') { // 特殊处理实验室概况
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
                    // 如果当前分类目录是某个一级分类目录的子目录，则输出该一级分类下所有的子目录
                    $matched_categories = null;

                    foreach ($category->children as $cate) {
                        if ($cate->cat_ID == $the_category->cat_ID) {
                            $matched_categories = $category->children;
                        }
                    }

                    if ($matched_categories) {
                        echo '<ul>';
                        foreach ($matched_categories as $item) {
                            if ($item->cat_ID == $the_category->cat_ID) { // 当前分类目录
                                echo '<li class="menu-item current-category" data-category-id="' . $item->cat_ID . '">';
                            } else {
                                echo '<li class="menu-item" data-category-id="' . $item->cat_ID . '">';
                            }
                            echo '<a href="' . esc_url(get_category_link($item->cat_ID)) . '">' . $item->name . '</a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    }

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