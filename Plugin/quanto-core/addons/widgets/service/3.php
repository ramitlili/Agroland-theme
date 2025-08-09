<?php foreach ($service_lists as $item): ?>
    <?php
    $query = new WP_Query([
        'post_type' => 'quanto_service',
        'post__in' => [$item['select_post']],
        'post_status' => 'publish',
    ]);
    while ($query->have_posts()): $query->the_post();
    ?>
    <div class="col-md-6 col-lg-4 col-xxl-3">
        <div class="quanto-service-box5 move-anim">
            <div class="quanto-iconbox-icon">
                <?php if (!empty($item['service_icon_select']) && $item['service_icon_select'] === 'quanto_service_image' && !empty($item['quanto_service_image']['url'])): ?>
                            <img src="<?php echo esc_url($item['quanto_service_image']['url']); ?>" alt="service-icon">
                    <?php elseif (!empty($item['quanto_service_icon'])): ?>
                            <?php \Elementor\Icons_Manager::render_icon($item['quanto_service_icon'], ['aria-hidden' => 'true']); ?>
                <?php endif; ?>
            </div>
            <div class="quanto-content">
            <div class="content-wrapper">
                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php echo esc_html(!empty($item['service_discription_text']) ? $item['service_discription_text'] : ''); ?></p>
            </div>
            <span class="service-number"><?php echo esc_html(!empty($item['service_number']) ? $item['service_number'] : '01'); ?></span>
            </div>
        </div>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
<?php endforeach; ?>