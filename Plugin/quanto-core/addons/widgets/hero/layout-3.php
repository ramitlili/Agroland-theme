<section class="agroland-hero3-section">
    <div class="container-fluid px-0 overflow-hidden">
        <div class="row">
            <div class="col-12 position-relative">
                <div class="agroland-hero3__content">
                    <div class="marquee-container fade-anim">
                        <div class="marquee">
                            <?php foreach ($settings['slider_item'] as $list_item) : ?>
                                <div class="marquee-item-container" data-lag="0.2" data-stagger="0.08">
                                    <div class="marquee-item text-color-white">
                                        <h1 class="text-color-white"><?php echo esc_html( $list_item['hero_slider_text'] ) ?></h1>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="content-info">
                        <a href="<?php echo esc_url($settings['image_url']['url']); ?>" class="section-jump section-link">
                            <img src="<?php echo esc_url($settings['hero_animated_img']['url']); ?>" alt="image">
                        </a>
                        <p class="word-anim" data-delay="0.60" data-lag="0.1" data-stagger="0.08">
                            <?php echo esc_html( $settings['hero_text'] ) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>