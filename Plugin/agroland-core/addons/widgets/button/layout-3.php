<div class="footer-six">
    <a <?php printf('href="%s" %s %s', $settings['button_url']['url'], $nofollow, $target) ?>>
        <?php if ( 'yes' == $settings['button_icon_left'] ): ?>
            <?php if ( 'yes' == $settings['button_icon'] ): ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['select_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            <?php endif; ?>
        <?php endif; ?>

        <div class="jumper">
            <span><?php echo esc_html( $settings['button_text'] ) ?></span>
            <span><?php echo esc_html( $settings['button_text'] ) ?></span>
        </div>

        <?php if ( '' == $settings['button_icon_left'] ): ?>
            <?php if ( 'yes' == $settings['button_icon'] ): ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['select_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            <?php endif; ?>
        <?php endif; ?>
    </a>
</div>