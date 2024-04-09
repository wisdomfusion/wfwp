<?php
/**
 * Title: Common TopNav
 * Slug: orgcms/common-top-nav
 */
?>

<div class="main-nav-bar">

    <div class="brand">
        <div class="logo-box">
            <img id="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_white@2x.png" alt="logo"/>
        </div>
        <div class="site-name">
            <div class="site-name-cn">上海市麻醉与脑功能调控重点实验室</div>
            <div class="site-name-en">SHANGHAI KEY LABORATORY OF ANESTHESIOLOGY AND BRAIN FUNCTIONAL MODULATION</div>
        </div>
    </div>

    <?php
    $params = array(
        'hide_empty' => false,
        'orderby' => 'term_order',
        'order' => 'ASC'
    );
    $all_categories = get_categories($params);
    $categories_tree = build_categories_tree($all_categories);

    // 过滤分类目录：新闻动态、通知公告
    $exclude_categories = array('news', 'announcements', 'friendly-links', 'home-slides');
    $filtered_categories = array_filter($categories_tree, function ($category) use ($exclude_categories) {
        return !in_array($category->slug, $exclude_categories);
    });

    // 输出导航菜单
    echo '<ul class="main-menu">';
    echo '<li class="menu-item"><a href="/"><span>首页</span></a></li>';

    foreach ($filtered_categories as $category) {
        if ($category->children) {
            echo '<li class="menu-item has-children">';
            echo '<span>' . esc_html($category->name) . '</span>';
            echo '<ul class="sub-menu">';
            foreach ($category->children as $sub_category) {
                echo '<li class="menu-item"><a href="' . esc_url(get_category_link($sub_category->term_id)) . '">' . esc_html($sub_category->name) . '</a></li>';
            }
            echo '</ul>';
            echo '</li>';
        } else {
            if ($category->slug == 'overview') { // 展开实验室概况下的文章
                $posts = get_posts(array(
                    'post_type' => 'post',
                    'category' => $category->term_id,
                    'orderby' => 'date',
                    'order' => 'ASC'
                ));
                if (!empty($posts)) {
                    echo '<li class="menu-item has-children">';
                    echo '<span>' . esc_html($category->name) . '</span>';
                    echo '<ul class="sub-menu">';
                    foreach ($posts as $post) {
                        echo '<li class="menu-item"><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                }
            } else {
                echo '<li class="menu-item"><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
            }
        }

        echo '</li>';
    }

    echo '</ul>';
    ?>

</div>
