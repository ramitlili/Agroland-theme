<div class="row agroland-blog2__row">
    <?php if ($the_query->have_posts()) :
        $delay = 0.30; // Initialize delay
        while ($the_query->have_posts()) :
            $the_query->the_post();
    ?>
        <div <?php echo $this->get_render_attribute_string('blog_gride_classes'); ?>>
            <div class="agroland-blog-box style-2 border-bottom-style fade-anim" data-delay="<?php echo number_format($delay, 2); ?>" data-direction="right" >
                <div class="agroland-blog-content">
                    <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>" class="blog-meta agroland-blog-date">
                        <?php echo get_the_time('F j, Y'); ?>
                    </a>
                    <h5 class="line-clamp-3">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h5>
                    <a class="agroland-link-btn" href="<?php the_permalink(); ?>">
                        <?php echo esc_html(!empty($settings['button_text']) ? $settings['button_text'] : 'Read More'); ?>
                        <span>
                            <i class="fa-solid fa-arrow-right arry1"></i>
                            <i class="fa-solid fa-arrow-right arry2"></i>
                        </span>
                    </a>
                </div>
                <div class="agroland-blog-thumb">
                    <?php if( has_post_thumbnail() ): ?>
                        <a href="<?php the_permalink(); ?>" class="d-inline-block overflow-hidden">
                            <?php the_post_thumbnail('full');?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
        $delay += 0.15;
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>

<!-- Pagination -->
<?php if ('yes' === $settings['show_pagination']):
    $total_pages = $the_query->max_num_pages;
    $current_page = max(1, get_query_var('paged'));
    if ($total_pages > 1): ?>
    
    <div class="row row-padding-top">
      <div class="col-12">
        <div class="blog-pagination">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end align-items-center custom-ul">
                <?php
                // Get paginated links as array (each page/prev/next is a separate item)
                $links = paginate_links([
                    'total' => $total_pages,
                    'current' => $current_page,
                    'type' => 'array',
                    'prev_text' => '<i class="fa-solid fa-arrow-left"></i> Prev',
                    'next_text' => 'Next <i class="fa-solid fa-arrow-right"></i>',
                    'end_size' => 1,
                    'mid_size' => 1,
                ]);

            foreach ($links as $link) {
                // Extract the link text inside the <a> tag
                preg_match('/<a[^>]*>(.*?)<\/a>/', $link, $matches);
                $link_text = $matches[1] ?? '';

                // Check if current page (active)
                if (strpos($link, 'current') !== false) {
                    echo '<li class="page-item"><a class="page-link active">' . strip_tags($link) . '</a></li>';
                }
                // Check if this is the Prev link by exact text match
                elseif (trim(strip_tags($link_text)) === 'Prev') {
                    echo '<li class="page-item">';
                    echo str_replace('<a', '<a class="page-link prev"', $link);
                    echo '</li>';
                }
                // Check if this is the Next link by exact text match
                elseif (trim(strip_tags($link_text)) === 'Next') {
                    echo '<li class="page-item">';
                    echo str_replace('<a', '<a class="page-link next"', $link);
                    echo '</li>';
                }
                // Otherwise normal page links
                else {
                    echo '<li class="page-item">';
                    echo str_replace('<a', '<a class="page-link"', $link);
                    echo '</li>';
                }
            }

              ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>

<?php endif; endif; ?>
