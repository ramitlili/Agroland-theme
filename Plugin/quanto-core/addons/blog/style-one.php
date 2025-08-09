<div class="row g-4">
<?php if ($the_query->have_posts()) :
    while ($the_query->have_posts()) :
        $the_query->the_post();
    ?>
    <div class="col-md-6 col-lg-4">
        <div class="agroland-blog-box fade-anim" data-delay="0.30" data-direction="right">
            <div class="agroland-blog-thumb">
                <a href="./blog-details.html"><img src="./assets/images/blog/blog-thumb-1.png" alt="blog-thumb"/></a>
            </div>
            <div class="agroland-blog-content">
                <h5 class="line-clamp-2"><a href="./blog-details.html">Reveal business opportunities with our five point brand audit</a></h5>
                <span class="agroland-blog-date">March 8, 2024</span>
            </div>
        </div>
    </div>
    <?php
        endwhile;
        // Restore original Post Data.
        wp_reset_postdata();
    endif;
    ?>
</div>