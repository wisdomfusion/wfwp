<?php
/**
 * Title: Friendly Links
 * Slug: orgcms/home-slides
 */
?>

<?php
$args = array(
    'post_type' => 'slides',
    'category_name' => 'home-slides',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
);
$links = new WP_Query($args);
if ($links->have_posts()) {
    echo '<div class="home-slides swiper">';
    echo '<div class="swiper-wrapper">';
    while ($links->have_posts()) {
        $links->the_post();

        echo '<div class="swiper-slide">';

        if (get_field('slide_url')) {
            echo '<a target="_blank" href="' . get_field('slide_url') . '">';
            echo '<img src="' . get_field('slide_img_url') . '" alt="' . get_field('slide_caption') . '"/>';
            echo '<p>' . get_field('slide_caption') . '</p>';
            echo '</a>';
        } else {
            echo '<p>' . get_field('slide_caption') . '</p>';
            echo '<img src="' . get_field('slide_img_url') . '" alt="' . get_field('slide_caption') . '"/>';
        }

        echo '</div>';
    }
    echo '</div>';
    echo '<div class="swiper-pagination"></div>';
    echo '<div class="swiper-button-next"></div>';
    echo '<div class="swiper-button-prev"></div>';
    echo '</div>';
}

wp_reset_postdata();
?>
