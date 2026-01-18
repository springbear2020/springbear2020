<?php
/*
Template Name: 藏书
*/

get_header();

$ebooks_query = new WP_Query([
    'post_type'      => 'ebooks',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_key'       => 'sort_value',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
]);
?>

<div class="page-information-card-container">
    <div class="page-information-card card bg-gradient-secondary shadow-lg border-0">
        <div class="card-body">
            <h3 class="text-black">
                <?php echo esc_html__('电子藏书', 'argon'); ?>
            </h3>

            <p class="text-black mt-3">
                <?php echo esc_html__('万卷藏书宜子弟，十年种木长风烟', 'argon'); ?>
            </p>

            <p class="text-black mt-3 mb-0 opacity-8">
                <i class="fa fa-envelope-open mr-1" aria-hidden="true"></i>
                <?php echo intval(wp_count_posts('ebooks')->publish); ?>
                <?php echo esc_html__('本藏书', 'argon'); ?>
            </p>
        </div>
    </div>
</div>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ($ebooks_query->have_posts()) : ?>
            <!-- 1. 平板/桌面端：表格（md 及以上显示） -->
            <div class="d-none d-md-block mt-4">
                <div class="table-responsive">
                    <table class="table table-hover bg-white shadow-sm">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" style="width: 40%;"><?php echo esc_html__('书名', 'argon'); ?></th>
                                <th scope="col" style="width: 20%;"><?php echo esc_html__('分类', 'argon'); ?></th>
                                <th scope="col" style="width: 25%;"><?php echo esc_html__('备注', 'argon'); ?></th>
                                <th scope="col" style="width: 15%;"><?php echo esc_html__('下载', 'argon'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                rewind_posts(); // 重置查询指针，确保双循环都能读取数据
                                while ($ebooks_query->have_posts()) :
                                    $ebooks_query->the_post();
                                    $name     = get_field('name');
                                    $link     = get_field('link');
                                    $category = get_field('category');
                                    $remark   = get_field('remark');
                            ?>
                            <tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($category ?: '-'); ?></td>
                                <td><?php echo esc_html($remark ?: '-'); ?></td>
                                <td>
                                    <a
                                        href="<?php echo esc_url($link); ?>"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary"
                                        title="<?php echo esc_attr($name ?: get_the_title()); ?>"
                                    >
                                        <i class="fa fa-cloud-download mr-1" aria-hidden="true"></i>
                                        <?php echo esc_html__('百度网盘', 'argon'); ?>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 2. 移动端：卡片（md 以下显示） -->
            <div class="d-md-none mt-4">
                <?php
                    rewind_posts(); // 再次重置查询指针，供卡片循环使用
                    while ($ebooks_query->have_posts()) :
                        $ebooks_query->the_post();
                        get_template_part('template-parts/content', 'ebook');
                    endwhile;
                ?>
            </div>
        <?php else : ?>
            <?php get_template_part('template-parts/content', 'none-tag'); ?>
        <?php endif; ?>

    </main>
</div>

<?php
wp_reset_postdata();
get_footer();
?>