<?php
    $author      = get_field('author');
    $cover       = get_field('cover');
    $finish_date = get_field('finish_date');
    $duration    = get_field('duration');
    $quote       = get_field('quote');
    $meaning     = get_field('meaning');
?>

<article class="card shadow-sm border-0 mb-4 bg-white" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card-body mine-card">
        <div class="mine-cover">
            <img src="<?php echo esc_url($cover); ?>" alt="<?php the_title(); ?>" class="rounded">
        </div>

        <div class="mine-body">
            <h3 class="my-3"><?php the_title(); ?></h3>

            <div class="body-meta text-muted small">
                <span class="meta-item">
                    <i class="fa fa-pencil-square-o"></i> <?php echo esc_html($author); ?>
                </span>
                <span class="meta-item">
                    <i class="fa fa-calendar-check-o"></i> <?php echo esc_html($finish_date); ?>
                </span>
                <span class="meta-item">
                    <i class="fa fa-hourglass-half"></i> <?php echo esc_html($duration); ?>
                </span>
            </div>

            <blockquote class="blockquote border-left border-primary p-3 my-3">
                <i class="fa fa-quote-left text-muted"></i>
                <p class="mb-0 italic"><?php echo esc_html($quote); ?></p>
            </blockquote>

            <div class="text-muted">
                <p class="mb-0"><?php echo esc_html($meaning); ?></p>
            </div>
        </div>
    </div>
</article>