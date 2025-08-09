<section class="agroland-hero4-section overflow-hidden">
    <div class="container custom-container">
        <div class="row g-4 justify-content-between align-items-end">
            <div class="col-md-3 col-xxl-2 order-1 order-md-0">
                <div class="agroland-hero4__info fade-anim" data-delay="0.60">
                    <h4 class="rating-point"><?php echo esc_html( $settings['hero_counter_number'] ) ?></h4>
                    <div class="stars">
                        <img src="<?php echo esc_url($settings['hero_client_img_one']['url']); ?>" alt="star">
                    </div>
                    <p class="word-anim" data-delay="0.60">
                        <?php echo esc_html( $settings['hero_counter_text'] ) ?>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-xl-9 order-0 order-md-1 position-relative">
                <div class="agroland-hero4__content move-anim" data-delay="0.45">
                    <h1 class="title">
                        <?php echo esc_html( $settings['hero_title'] ) ?>
                        <span>
                            <img src="<?php echo esc_url($settings['hero_animated_img']['url']); ?>" alt="shape">
                        </span>
                    </h1>
                    <p>
                        <?php echo esc_html( $settings['hero_text'] ) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>