/**
 * Spring-_-Bear
 */
function ajax_load_more_items() {

    // 获取前端传的参数
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : 'books';

    // 根据类型配置查询参数
    $args = [
        'post_status'    => 'publish',
        'posts_per_page' => 8,
        'paged'          => $paged,
        'meta_key'       => 'sort_value',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
    ];

    // 书籍：post_type = books
    if ($type === 'books') {
        $args['post_type'] = 'books';
        $templatePart = 'template-parts/content-book';
    }
    // 项目：post_type = projects
    elseif ($type === 'projects') {
        $args['post_type'] = 'projects';
        $templatePart = 'template-parts/content-project';
    } else {
        wp_die(); // 未知类型直接终止
    }

    // 执行查询
    $query = new WP_Query($args);

    // 渲染模板
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part($templatePart);
        }
    }

    wp_reset_postdata();
    wp_die(); // 必须调用，终止 AJAX 响应
}

// 注册 AJAX action
add_action('wp_ajax_load_more_items', 'ajax_load_more_items');
add_action('wp_ajax_nopriv_load_more_items', 'ajax_load_more_items');

function load_more_scripts() {
    wp_enqueue_script(
        'load-more',
        get_template_directory_uri() . '/assets/js/load-more.js',
        ['jquery'],
        null,
        true
    );

    // 本地化脚本，传递 AJAX 地址
    wp_localize_script('load-more', 'books_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'load_more_scripts');

// CTRL + K 全局搜索
add_action('wp_footer', function () {
?>
<script>
document.addEventListener('keydown', function (e) {
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {

        // 防止在输入状态下误触
        const tag = document.activeElement.tagName;
        if (tag === 'INPUT' || tag === 'TEXTAREA') return;

        e.preventDefault();

        const container = document.getElementById('navbar_search_input_container');
        const input = document.getElementById('navbar_search_input');

        if (!container || !input) return;

        // 👇 这是关键：触发 Argon 的 click 监听
        container.dispatchEvent(new MouseEvent('click', { bubbles: true }));

        // 确保聚焦
        setTimeout(() => {
            input.focus();
            input.select();
        }, 50);
    }

    // ESC 关闭搜索（完美适配 Argon）
    if (e.key === 'Escape') {
        const container = document.getElementById('navbar_search_input_container');
        const input = document.getElementById('navbar_search_input');
        if (input) input.blur();
        if (container) container.classList.remove('open');
    }
});
</script>
<?php
});
