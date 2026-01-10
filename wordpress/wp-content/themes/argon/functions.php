/**
 * Spring-_-Bear
 */
function ajax_load_more_books() {

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = [
        'post_type'      => 'books',
        'post_status'    => 'publish',
        'posts_per_page' => 8,
        'paged'          => $paged,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'book');
        }
    }

    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_load_more_books', 'ajax_load_more_books');
add_action('wp_ajax_nopriv_load_more_books', 'ajax_load_more_books');

function books_ajax_scripts() {
    wp_enqueue_script(
        'books-ajax',
        get_template_directory_uri() . '/assets/js/books-ajax.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('books-ajax', 'books_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'books_ajax_scripts');