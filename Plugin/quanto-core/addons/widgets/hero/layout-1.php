<section class="agroland-hero-section overflow-hidden">
    <div class="container custom-container">
        <div class="row">
            <div class="col-12 position-relative">
                <div class="agroland-hero__content move-anim" data-delay="0.45">
                    <h1 class="title">
                        <?php echo esc_html( $settings['hero_title'] ) ?>
                        <span>
                            <img src="<?php echo esc_url($settings['hero_animated_img']['url']); ?>" alt="image">
                            <?php echo esc_html( $settings['hero_short_title'] ) ?>
                        </span>
                    </h1>
                </div>
                <div class="agroland-hero__info">
                    <p class="word-anim" data-delay="0.60">
                        <?php echo esc_html( $settings['hero_text'] ) ?>
                    </p>
                    <div class="client-info fade-anim" data-delay="0.60">
                        <div class="client-images">
                            <img src="<?php echo esc_url($settings['hero_add_img']['url']); ?>" alt="avatar-add"/>
                            <img src="<?php echo esc_url($settings['hero_client_img_one']['url']); ?>" alt="avatar"/>
                            <img src="<?php echo esc_url($settings['hero_client_img_two']['url']); ?>" alt="avatar"/>
                        </div>
                        <div class="client-data">
                            <h6 class="counter-item d-flex align-items-center">
                                <span class="odometer d-inline-block" data-odometer-final="<?php echo esc_html( $settings['hero_counter_number'] ) ?>">.</span>
                                <em><?php echo esc_html( $settings['hero_counter_text'] ) ?></em>
                            </h6>
                            <span><?php echo esc_html( $settings['hero_client_title'] ) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>