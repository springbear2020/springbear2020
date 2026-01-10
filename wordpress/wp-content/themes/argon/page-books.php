<?php
/*
Template Name: 书籍
*/

get_header();

/**
 * 首屏只加载第一页
 */
$books_query = new WP_Query([
    'post_type'      => 'books',
    'post_status'    => 'publish',
    'posts_per_page' => 8,
    'paged'          => 1,
]);
?>

<div class="page-information-card-container">
    <div class="page-information-card card bg-gradient-secondary shadow-lg border-0">
        <div class="card-body">
            <h3 class="text-black">
                <?php echo esc_html__('微信读书', 'argon'); ?>
            </h3>

            <p class="text-black mt-3">
                <?php echo esc_html__('粗缯大布裹生涯，腹有诗书气自华', 'argon'); ?>
            </p>

            <p class="text-black mt-3 mb-0 opacity-8">
                <i class="fa fa-book mr-1"></i>
                <?php echo intval(wp_count_posts('books')->publish); ?>
                <?php echo esc_html__('本图书', 'argon'); ?>
            </p>
        </div>
    </div>
</div>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ($books_query->have_posts()) : ?>

            <!-- 列表容器（Ajax 会 append 到这里） -->
            <div id="books-list">
                <?php
                while ($books_query->have_posts()) :
                    $books_query->the_post();
                    get_template_part('template-parts/content', 'book');
                endwhile;
                ?>
            </div>

            <!-- loading 提示 -->
            <div id="books-loading" class="text-center py-4 d-none">
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