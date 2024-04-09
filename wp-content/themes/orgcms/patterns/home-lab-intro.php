<?php
/**
 * Title: Home Lab Intro
 * Slug: orgcms/home-lab-intro
 */
?>

<?php
$post = get_page_by_path('lab-intro', OBJECT, 'post');
//print_r_pre($post);
if ($post) {
    echo '<div class="intro-box">';

    echo '<div class="intro-content-box">';
    echo '<div class="intro-content">' . apply_filters('the_content', $post->post_content) . '</div>';
    echo '<div class="intro-link"><a class="btn-view" href="' . get_permalink($post->ID) . '">查看详情</a></div>';
    echo '</div>';
    if (has_post_thumbnail($post->ID)) {
        $post_thumbnail_url = get_the_post_thumbnail_url($post->ID, 'large');
        echo '<div class="lab-building"><img src="' . esc_url($post_thumbnail_url) . '" alt="' . $post->post_title . '"/></div>';
    }

    echo '</div>';
}
?>
