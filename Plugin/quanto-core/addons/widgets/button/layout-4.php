<a class="agroland-link-btn" <?php printf('href="%s" %s %s', $settings['button_url']['url'], $nofollow, $target) ?>>
    <?php echo esc_html( $settings['button_text'] ) ?>

    <?php if ( 'yes' == $settings['button_icon'] ): ?>
        <span>
            <i class="fa-solid fa-arrow-right arry1"></i>
            <i class="fa-solid fa-arrow-right arry2"></i>
        </span>
    <?php endif; ?>
</a>