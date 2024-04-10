<?php
/**
 * Title: Contact Us
 * Slug: orgcms/featured-img-news
 */

$args = array(
    'category_name' => 'news',
    'posts_per_page' => 5,
    'meta_key' => '_thumbnail_id',
    'meta_compare' => 'EXISTS',
    'orderby' => 'date',
    'order' => 'DESC'
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    echo '<div class="featured-news-list swiper">';
    echo '<div class="swiper-wrapper">';
    while ($query->have_posts()) {
        $query->the_post();

        $title = get_the_title();
        $link = get_the_permalink();
        $thumbnail = get_the_post_thumbnail();

        echo '<div class="swiper-slide">';
        echo '<a href="' . $link . '"><img src="' . $thumbnail . '" alt="' . $title . '"/><div class="text-box"><p>' . $title . '</p></div></a>';
        echo '</div>';
    }
    echo '</div>';
    echo '<div class="swiper-pagination"></div>';
    echo '</div>';
} else {
    echo '<div class="featured-news-list no-news">暂无图片新闻</div>';
}

wp_reset_postdata();
?>
