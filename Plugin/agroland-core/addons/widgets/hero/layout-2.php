<section class="quanto-hero2-section bg-color-primary section-padding-bottom">
    <div class="container custom-container">
        <div class="row align-items-end">
            <div class="col-lg-10">
                <div class="hero2-content move-anim" data-delay="0.45">
                    <h1 class="text-color-white">
                        <?php echo esc_html( $settings['hero_title'] ) ?>
                        <span></span>
                    </h1>
                    <p class="word-anim" data-delay="1">
                        <?php echo esc_html( $settings['hero_text'] ) ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-2 d-none d-lg-block text-end">
                <a href="<?php echo esc_url($settings['image_url']['url']); ?>" class="hero2-circle-text fade-anim section-link" data-delay="1" data-direction="right">
                    <img src="<?php echo esc_url($settings['hero_animated_img']['url']); ?>" alt="circle-text" class="circle-text"/>
                    <img src="<?php echo esc_url($settings['hero_client_img_two']['url']); ?>" alt="circle-icon" class="circle-icon"/>
                </a>
            </div>
        </div>
    </div>
</section>