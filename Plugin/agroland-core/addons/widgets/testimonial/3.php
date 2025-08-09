<div class="quonto-testimonial3">
    <div class="swiper testimonial3-slider fade-anim" data-delay="0.30" data-direction="right">
        <div class="swiper-wrapper">
        <?php foreach( $settings[ 'slides' ] as $slide ): ?>
            <div class="swiper-slide">
                <div class="testimonial3-content">
                    <?php if ( !empty( $slide[ 'client_text' ] ) ) { ?>
                    <p><?php echo esc_html($slide[ 'client_text' ]); ?></p>
                    <?php } ?>
                    <div class="client-info">
                        <?php if ( !empty( $slide[ 'client_name' ] ) ) { ?>
                            <h5 class="client-name"><?php echo esc_html($slide[ 'client_name' ]); ?></h5>
                        <?php } ?>
                        <?php if ( !empty( $slide[ 'client_designation' ] ) ) { ?>
                            <span class="client-designation"><?php echo esc_html($slide[ 'client_designation' ]); ?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="testimonial3-navigation">
        <div class="next-btn bg-color-2">
            <i class="fa-solid fa-angle-left"></i>
        </div>
        <div class="prev-btn bg-color-2">
        <i class="fa-solid fa-angle-right"></i>
        </div>
    </div>
</div>
