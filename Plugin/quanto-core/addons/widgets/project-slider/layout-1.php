<section class="agroland-project-section overflow-hidden">
    <div class="container custom-container">
        <div class="row">
            <div class="col-12">
                <div class="project-horizontal-scrolling horizontal-scroll">
                    <?php 
                    // Set up the query to fetch posts
                    $number_of_post = !empty($settings['post_per_page']) ? $settings['post_per_page'] : -1;

                    $query_args = [
                        'post_type'      => 'agroland_project',
                        'order'          => $settings['order'],
                        'posts_per_page' => $number_of_post,
                        'post_status'    => 'publish',
                    ];
    
                    if (!empty($settings['project_category'])) {
                        $query_args['tax_query'] = [
                            [
                                'taxonomy' => 'project_category',
                                'field'    => 'slug',
                                'terms'    => $settings['project_category'],
                            ],
                        ];
                    }
    
                    if ('selected' === $settings['post_by'] && !empty($settings['post__in'])) {
                        $query_args['post__in'] = (array) $settings['post__in'];
                    }

                    // Create a new WP_Query
                    $args = new \WP_Query($query_args);

                    if ($args->have_posts()):
                        while ($args->have_posts()): $args->the_post(); 
                        $categories = get_the_terms(get_the_ID(), 'project_category');
                    ?>
                        <div class="agroland-project-box scroll-item overflow-hidden">
                            <a href="<?php the_permalink(); ?>">
                                <div class="agroland-project-thumb overflow-hidden">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>" alt="<?php echo esc_attr__('project-thumb', 'quanto') ?>" class="w-100 img_reveal"/>
                                </div>
                            </a>
                            <div class="agroland-project-content">
                                <h5 class="line-clamp-1">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <span class="agroland-project-date text-color-primary">
                                    <?php if ( 'yes' == $settings['show_date'] ): ?>
                                        <?php echo esc_html(get_the_date('Y')); ?>
                                        <i class="ri-subtract-line"></i>
                                    <?php endif; ?>

                                    <?php 
                                        if (!empty($categories) && !is_wp_error($categories)) {
                                            echo esc_html(implode(', ', wp_list_pluck($categories, 'name')));
                                        } else {
                                            echo esc_html__('Uncategorized', 'genixcore');
                                        }
                                    ?>
                                </span>
                            </div>
                        </div>
                    <?php endwhile; 
                    wp_reset_postdata();
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>