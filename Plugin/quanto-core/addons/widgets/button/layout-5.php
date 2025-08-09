<div class="error__content_btn">
    <a class="agroland-link-btn btn-pill" <?php printf('href="%s" %s %s', $settings['button_url']['url'], $nofollow, $target) ?>>
        <?php if ( 'yes' == $settings['button_icon'] ): ?>
            <span>
                <i class="fa-solid fa-arrow-left arry1"></i>
                <i class="fa-solid fa-arrow-left arry2"></i>
            </span>
        <?php endif; ?>

        <?php echo esc_html( $settings['button_text'] ) ?>
    </a>
</div>