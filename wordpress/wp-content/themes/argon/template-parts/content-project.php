<?php
    $name         = get_field('name');
    $link         = get_field('link');
    $cover        = get_field('cover');
    $start_date   = get_field('start_date');
    $finish_date  = get_field('finish_date');
    $technology   = get_field('technology');
    $introduction = get_field('introduction');

    $finish_date_display = !empty($finish_date) ? esc_html($finish_date) : '至今';
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
                    <i class="fa fa-calendar-o"></i> <?php echo esc_html($start_date); ?>
                </span>
                <span class="meta-item">
                    <i class="fa fa-calendar-check-o"></i> <?php echo esc_html($finish_date_display); ?>
                </span>
                <span class="meta-item">
                    <i class="fa fa-code"></i> <?php echo esc_html($technology); ?>
                </span>
            </div>

            <div class="my-2">
                <p class="mb-0"><?php echo nl2br(esc_html($introduction)); ?></p>
            </div>

            <a
                href="<?php echo esc_url($link); ?>"
                target="_blank"
                class="btn btn-sm btn-outline-primary mine-link"
                title="<?php echo esc_attr($name); ?>"
            >
                <img
                    src="<?php echo esc_url($cover); ?>"
                    alt="<?php echo esc_attr($name); ?>"
                    class="link-icon mr-1"
                    loading="lazy"
                >
                <?php echo esc_html($name); ?>
            </a>
        </div>
    </div>
</article>
