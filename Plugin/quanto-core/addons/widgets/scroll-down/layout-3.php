<div class="quanto-video-area style-2 overflow-hidden">
    <div class="container custom-container position-relative">
        <a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="scroll-down section-link">
            <?php echo esc_html( $settings['button_text'] ) ?>
            <img
            src="<?php echo esc_url($settings['scroll_icon']['url']); ?>"
            alt="Scroll down"
            />
        </a>
        <div class="row">
            <div class="col-12">
                <video
                    muted
                    autoplay
                    loop
                    src="<?php echo esc_html( $settings['video_url'] ) ?>"
                    class="quanto-video"
                    id="quanto-video-2"
                    data-speed="0.8"
                ></video>
                <button class="play-btn"><?php echo esc_html( $settings['play_text'] ) ?></button>
            </div>
        </div>
    </div>
</div>