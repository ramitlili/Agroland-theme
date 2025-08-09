<!-- Testimonial section Start -->
<section class="agroland-testimonial-section overflow-hidden">

    <div class="row">
        <div class="col-12">
            <div class="agroland__header">
                <h3
                class="title fade-anim"
                data-delay="0.30"
                data-direction="right"
                >
                <?php echo esc_html( $settings['slider_title'] ); ?>
                </h3>
            </div>
        </div>
    </div>
    <div class="row g-4 justify-content-between">
        <div class="col-12 col-lg-6 col-xl-5">
        <!-- Thumbnail Swiper -->
        <div
            class="swiper agroland-testimonial__thumb-slider h-100 fade-anim"
            data-delay="0.30"
            data-direction="right"
        >
            <div class="swiper-wrapper">
            <?php foreach( $settings[ 'slides' ] as $slide ): ?>
                <div class="swiper-slide">
                    <div
                    class="testimonial-img"
                    data-speed="0.8"
                    style="
                        background-image: url(<?php echo esc_url( $slide['client_image']['url'] ); ?>);
                    "
                    ></div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
        <div class="swiper agroland-testimonial__content-slider">
            <div class="swiper-wrapper">
                <?php foreach( $settings[ 'slides' ] as $slide ): ?>
                <div class="swiper-slide">
                    <div class="testimonial-content">
                        <?php if ( !empty( $slide[ 'client_text' ] ) ) { ?>
                        <p><?php echo esc_html($slide[ 'client_text' ]); ?></p>
                        <?php } ?>
                        <div class="author">
                            <?php if ( !empty( $slide[ 'client_name' ] ) ) { ?>
                            <h5 class="author-title"><?php echo esc_html($slide[ 'client_name' ]); ?></h5>
                            <?php } ?>
                            <?php if ( !empty( $slide[ 'client_designation' ] ) ) { ?>
                            <span class="author-designation"><?php echo esc_html($slide[ 'client_designation' ]); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="agroland-testimonial__navigation">
            <div class="agroland-testimonial__prev prev-slide">
            <i class="fa-solid fa-arrow-left"></i>
            </div>
            <div class="agroland-testimonial__next next-slide">
            <i class="fa-solid fa-arrow-right"></i>
            </div>
        </div>
        </div>
    </div>

</section>
        <!-- Testimonial section End -->