<div class="quanto-map-area style-2 overflow-hidden">
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
                <iframe
                    src="<?php echo esc_html( $settings['map_url'] ) ?>"
                    width="600"
                    height="800"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="d-block w-100"
                ></iframe>
            </div>
        </div>
    </div>
</div>