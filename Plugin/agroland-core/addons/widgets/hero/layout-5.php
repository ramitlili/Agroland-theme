<section class="quanto-hero5-section bg-color-primary section-padding-bottom">
    
    <div class="hero5-bg background-image" 
        style="background-image: url('<?php echo esc_url($settings['hero_five_bg_img']['url']); ?>');">
    </div>

    <div class="container custom-container">
        <div class="row g-4 justify-content-between align-items-end">
            <div class="col-lg-8 col-xl-9">
                <div class="quanto-hero5__content move-anim" data-delay="0.45">
                    <h1 class="title text-color-white">
                        <div class="arrow-box">
                            <img src="<?php echo esc_url($settings['hero_animated_img']['url']); ?>" alt="arrow"/>
                        </div>
                        <div><?php echo esc_html( $settings['hero_title'] ) ?></div>
                        <div class="text-indent"><?php echo esc_html( $settings['hero_short_title'] ) ?></div>
                    </h1>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="quanto-hero5__info fade-anim" data-delay="0.60">
                    <p class="word-anim" data-delay="0.60">
                        <?php echo esc_html( $settings['hero_text'] ) ?>
                    </p>
                    <a class="quanto-link-btn btn-pill" href="<?php echo esc_url($settings['button_url']['url']); ?>">
                        <?php echo esc_html( $settings['button_text'] ) ?>
                        <span>
                            <i class="fa-solid fa-arrow-right arry1"></i>
                            <i class="fa-solid fa-arrow-right arry2"></i>
                        </span>
                     </a>
                </div>
            </div>
        </div>
    </div>
</section>