<?php
/**
 * Title: Friendly Links
 * Slug: orgcms/friendly-links
 */
?>

<?php
$args = array(
    'post_type' => 'friendly-links',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
);
$links = new WP_Query($args);
if ($links->have_posts()) {
    echo '<div class="friendly-links">';
    while ($links->have_posts()) {
        $links->the_post();

        echo '<div class="friendly-link">';

        if (get_field('logo_img_url')) {
            echo '<a target="_blank" href="' . get_field('link_url') . '"><img src="' . get_field('logo_img_url') . '" alt="' . get_the_title() . '"/></a>';
            echo '<p><a target="_blank" href="' . get_field('link_url') . '">' .  get_the_title() . '</a></p>';
        } else {
            echo '<a target="_blank" href="">' . get_the_title() . '</a>';
        }

        echo '</div>';
    }
    echo '</div>';
}

wp_reset_postdata();
?>


