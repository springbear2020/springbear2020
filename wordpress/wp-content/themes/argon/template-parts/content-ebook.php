<?php
    $name         = get_field('name');
    $link         = get_field('link');
    $category     = get_field('category');
    $remark       = get_field('remark');
?>

<style>
    .mine-body {
        padding-left: 0 !important;
    }

    .mine-body h3 {
        text-align: left !important;
    }

    .body-meta .meta-item {
        text-align: left !important;
    }

    .btn {
        text-transform: none !important;
        letter-spacing: normal !important;
    }
</style>

<article class="card shadow-sm border-0 mb-4 bg-white" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card-body mine-card">
        <div class="mine-body">
            <h3 class="mt-0 mb-2"><?php the_title(); ?></h3>

            <div class="body-meta text-muted small">
                <span class="meta-item">
                    <i class="fa fa-bookmark mr-1"></i><?php echo esc_html($category); ?>
                </span>
                <?php if (!empty($remark)) { ?>
                    <span class="meta-item">
                        <i class="fa fa-bookmark-o mr-1"></i><?php echo esc_html($remark); ?>
                    </span>
                <?php } ?>
            </div>

            <a
                href="<?php echo esc_url($link); ?>"
                target="_blank"
                class="btn btn-sm btn-outline-primary mine-link mt-2"
                title="<?php echo esc_attr($name); ?>"
            >
                <i class="fa fa-cloud-download mr-1" aria-hidden="true"></i>百度网盘
            </a>
        </div>
    </div>
</article>