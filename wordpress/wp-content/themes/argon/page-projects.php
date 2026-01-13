<?php
/*
Template Name: 项目
*/

get_header();

/**
 * 首屏只加载第一页
 */
$projects_query = new WP_Query([
    'post_type'      => 'projects',
    'post_status'    => 'publish',
    'posts_per_page' => 8,
    'paged'          => 1,
    'meta_key'       => 'sort_value',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
]);
?>

<div class="page-information-card-container">
    <div class="page-information-card card bg-gradient-secondary shadow-lg border-0">
        <div class="card-body">
            <h3 class="text-black">
                <?php echo esc_html__('开源项目', 'argon'); ?>
            </h3>

            <p class="text-black mt-3">
                <?php echo esc_html__('纸上得来终觉浅，绝知此事要躬行', 'argon'); ?>
            </p>

            <p class="text-black mt-3 mb-0 opacity-8">
                <i class="fa fa-github mr-1"></i>
                <?php echo intval(wp_count_posts('projects')->publish); ?>
                <?php echo esc_html__('个项目', 'argon'); ?>
            </p>
        </div>
    </div>
</div>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ($projects_query->have_posts()) : ?>

            <!-- 列表容器（Ajax 会 append 到这里） -->
            <div id="projects-list">
                <?php
                while ($projects_query->have_posts()) :
                    $projects_query->the_post();
                    get_template_part('template-parts/content', 'project');
                endwhile;
                ?>
            </div>

            <!-- loading 提示 -->
            <div id="projects-loading" class="text-center py-4 d-none">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border text-primary mr-2" role="status"></div>
                    <span>系统憋大招中，请别急，它比你还急...</span>
                </div>
            </div>

        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none-tag'); ?>

        <?php endif; ?>

    </main>
</div>

<?php
wp_reset_postdata();
get_footer();