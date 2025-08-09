<a <?php printf('href="%s" %s %s', $settings['button_url']['url'], $nofollow, $target) ?> class="connect d-flex footer-let-connect">
    <h1 class="text-color-white">
        <?php echo esc_html( $settings['button_text'] ) ?>
    </h1>
    <?php if ( 'yes' == $settings['button_icon'] ): ?>
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none">
                <path d="M100.023 58.8388L46.232 112.63L37.3932 103.791L91.1844 50H43.7733V37.5H112.523V106.25H100.023V58.8388Z" fill="white"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none">
                <path d="M100.023 58.8388L46.232 112.63L37.3932 103.791L91.1844 50H43.7733V37.5H112.523V106.25H100.023V58.8388Z" fill="white"/>
            </svg> 
            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none">
                <path d="M100.023 58.8388L46.232 112.63L37.3932 103.791L91.1844 50H43.7733V37.5H112.523V106.25H100.023V58.8388Z" fill="white"/>
            </svg>
        </span>
    <?php endif; ?>
</a>