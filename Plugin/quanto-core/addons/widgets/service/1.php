<?php foreach ($service_lists as $item): ?>
        <?php
        $query = new WP_Query([
            'post_type' => 'agroland_service',
            'post__in' => [$item['select_post']],
            'post_status' => 'publish',
        ]);
        while ($query->have_posts()): $query->the_post();
        ?>
        <div class="col-md-6 col-lg-4 col-xxl-3">
            <div class="agroland-service-box move-anim">
                <div class="agroland-iconbox-icon">
                    <?php if (!empty($item['service_icon_select']) && $item['service_icon_select'] === 'agroland_service_image' && !empty($item['agroland_service_image']['url'])): ?>
                        <img src="<?php echo esc_url($item['agroland_service_image']['url']); ?>" alt="service-icon">
                    <?php elseif (!empty($item['agroland_service_icon'])): ?>
                        <?php \Elementor\Icons_Manager::render_icon($item['agroland_service_icon'], ['aria-hidden' => 'true']); ?>
                    <?php endif; ?>
                </div>
                <div class="agroland-iconbox-data">
                    <div class="agroland-iconbox-data-wrapper">
                        <h5><?php the_title(); ?></h5>
                        <p><?php echo esc_html(!empty($item['service_discription_text']) ? $item['service_discription_text'] : ''); ?></p>
                    </div>
                    <a class="agroland-link-btn" href="<?php the_permalink(); ?>">
                        <?php echo esc_html(!empty($item['service_btn_text']) ? $item['service_btn_text'] : 'View details'); ?>
                        <span>
                            <i class="fa-solid fa-arrow-right arry1"></i>
                            <i class="fa-solid fa-arrow-right arry2"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
 <?php endforeach; ?>
 