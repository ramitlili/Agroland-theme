<div class="col-12">
    <?php foreach ($service_lists as $item): ?>
    <?php
    $query = new WP_Query([
        'post_type' => 'quanto_service',
        'post__in' => [$item['select_post']],
        'post_status' => 'publish',
    ]);
    while ($query->have_posts()): $query->the_post();
    ?>
    <div class="quanto-service-box3 fade-anim">
        <div class="box-content">
        <h4>
            <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
        </h4>
        <p><?php echo esc_html(!empty($item['service_discription_text']) ? $item['service_discription_text'] : ''); ?></p>
        </div>
        <a href="<?php the_permalink(); ?>" class="quanto-link-btn">
        <span>
            <i class="fa-solid fa-arrow-right arry1"></i>
            <i class="fa-solid fa-arrow-right arry2"></i>
        </span>
        </a>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
    <?php endforeach; ?>
</div>
