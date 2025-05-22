<?php
/**
 * Template Name: Boxmoe实用软件
 * Description: 获取实用软件分类的软件信息并渲染到实用软件
 * @link https://mxin.moe
 * author 铭心
 * @package lolimeow
 */
get_header();
?>
<section class="section-blog-breadcrumb container">
    <div class="breadcrumb-head">
        <span><i class="fa fa-home"></i> Page</span>
    </div>
</section>
<section id="boxmoe_theme_container">
    <div class="container">
        <div class="row">
            <div class="blog-single col-lg-12 mx-auto fadein-bottom">
                <div class="post-single <?php echo boxmoe_border() ?>">
                    <?php while (have_posts()) : the_post(); ?>
                        <h1 class="single-title"><?php the_title();
                            echo get_the_subtitle(); ?></h1>
                        <hr class="horizontal dark">
                        <div class="single-content">
                            <?php the_content(); ?>
                            <?php wp_link_pages([
                                'before' => '<div class="fenye pagination justify-content-center">',
                                'after' => '</div>',
                                'next_or_number' => 'number',
                                'link_before' => '<span>',
                                'link_after' => '</span>'
                            ]); ?>

                            <!-- 实用软件卡片链接开始 -->
                            <div class="soft-container">
                                <div class="soft-grid">
                                    <?php
                                    $categories = get_terms([
                                        'taxonomy' => 'link_category',
                                        'hide_empty' => false,
                                    ]);

                                    foreach ($categories as $category) {
                                        if ($category->name !== '实用软件') continue;

                                        $links = get_bookmarks(['category' => $category->term_id]);
                                        foreach ($links as $link) {
                                            $title = $link->link_name;
                                            $desc = !empty($link->link_description) ? $link->link_description : '暂无介绍';
                                            $thumb = !empty($link->link_image) ? $link->link_image : boxmoe_themes_dir() . '/assets/images/profile.jpg';
                                            echo '<div class="soft-item">';
                                            echo '<div class="soft-thumb"><img src="' . esc_url($thumb) . '" alt="' . esc_attr($title) . '"></div>';
                                            echo '<div class="soft-info">';
                                            echo '<div class="soft-title"><a href="' . esc_url($link->link_url) . '" target="_blank">' . esc_html($title) . '</a></div>';
                                            echo '<p>' . esc_html($desc) . '</p>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- 实用软件卡片链接结束 -->
                        </div>
                    <?php endwhile; ?>
                    <?php if (!get_boxmoe('comments_off')): ?>
                        <div class="thw-sept"></div>
                        <?php comments_template('', true); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .soft-container {
        padding-top: 20px;
    }

    .soft-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
    }

    .soft-item {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
        padding: 20px;
        box-sizing: border-box;
    }

    .soft-item:hover {
        transform: translateY(-6px);
    }

    .soft-thumb img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        display: block;
        margin: 0 auto 15px auto;
        border-radius: 12px;
        background: #f9f9f9;
    }

    .soft-info p {
        font-size: 14px;
        color: #666;
        margin: 0 0 15px;
        text-align: center;
        line-height: 1.5;
    }

    .soft-title {
        font-size: 18px;
        color: #007bff;
        font-weight: 600;
        margin: 0 0 10px;
        text-align: center;
    }

    .soft-title a {
        color: inherit;
        text-decoration: none !important;
        cursor: pointer;
        display: inline-block;
        width: 100%;
    }

    .soft-title a:hover {
        text-decoration: none !important;
    }
</style>

<?php get_footer(); ?>
