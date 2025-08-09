<div class="quanto_screenfix_right">
    <div class="swiper quanto-testimonial2__slider h-100">
        <div class="swiper-wrapper">
            <?php foreach( $settings[ 'slides' ] as $slide ): ?>
            <div class="swiper-slide">
                <div class="quanto-testimonial2__box bg-color-white">
                <div class="testimonial-content mt-0">
                    <div class="stars">
                        <?php if ( isset($slide['rating']) && 'yes' === $slide['rating'] && isset($slide['rating_icon']) ): ?>
                            <ul class="custom-ul">
                                <?php for ( $i = 0; $i < 5; $i++ ): ?>
                                    <li><?php \Elementor\Icons_Manager::render_icon( $slide['rating_icon'], [ 'aria-hidden' => 'true' ] ); ?></li>
                                <?php endfor; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php if ( !empty( $slide[ 'client_text' ] ) ) { ?>
                    <h5 class="revew"><?php echo esc_html($slide[ 'client_text' ]); ?></h5>
                    <?php } ?>
                </div>
                <div class="testimonial-author">
                    <?php if ( !empty( $slide['client_image'] ) ) { ?>
                    <div class="author-image">
                        <img src="<?php echo esc_url( $slide['client_image']['url'] ); ?>" alt="Author Image"/>
                    </div>
                    <?php } ?>
                    <div class="author-info">
                        <?php if ( !empty( $slide[ 'client_name' ] ) ) { ?>
                        <h6 class="author-name"><?php echo esc_html($slide[ 'client_name' ]); ?></h6>
                        <?php } ?>
                        <?php if ( !empty( $slide[ 'client_designation' ] ) ) { ?>
                            <span class="info"><?php echo esc_html($slide[ 'client_designation' ]); ?></span>
                        <?php } ?>
                    </div>
                </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>