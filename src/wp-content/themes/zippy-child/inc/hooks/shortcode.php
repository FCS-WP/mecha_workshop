<?php

/**
 * Custom Shortcodes
 */

function project_category_buttons_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'show_all' => 'yes',
        'all_text' => 'All Projects',
    ), $atts);

    $categories = get_terms(array(
        'taxonomy' => 'project_category',
        'hide_empty' => false,
    ));

    if (empty($categories) || is_wp_error($categories)) {
        return '<p>No project categories found.</p>';
    }

    ob_start();
?>
    <div class="project-category-buttons">
        <?php foreach ($categories as $category) : ?>
            <a class="project-cat-btn">
                <?php echo esc_html($category->name); ?>
                <span class="cat-count">(<?php echo $category->count; ?>)</span>
            </a>
        <?php endforeach; ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('project_categories', 'project_category_buttons_shortcode');

function project_category_slider_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'posts_per_category' => -1,
    ), $atts);

    $categories = get_terms(array(
        'taxonomy' => 'project_category',
        'hide_empty' => false,
    ));

    if (empty($categories) || is_wp_error($categories)) {
        return '<p>No project categories found.</p>';
    }

    ob_start();
?>
    <div class="project-category-slider-wrapper">
        <div class="project-cat-tabs-horizontal">
            <?php foreach ($categories as $index => $category) : ?>
                <button class="project-cat-tab <?php echo $index === 0 ? 'active' : ''; ?>"
                    data-category="<?php echo esc_attr($category->term_id); ?>">
                    <?php echo esc_html($category->name); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="project-sliders-container">
            <?php foreach ($categories as $index => $category) :
                $args = array(
                    'post_type' => 'project',
                    'posts_per_page' => $atts['posts_per_category'],
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'project_category',
                            'field' => 'term_id',
                            'terms' => $category->term_id,
                        ),
                    ),
                );
                $projects = new WP_Query($args);
            ?>
                <div class="project-slider <?php echo $index === 0 ? 'active' : ''; ?>"
                    data-category="<?php echo esc_attr($category->term_id); ?>">

                    <?php if ($projects->have_posts()) : ?>
                        <div class="slider-wrapper">
                            <button class="slider-arrow slider-prev" aria-label="Previous">
                                <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/01/wfNDdPcircle1.png')); ?>" alt="Previous" style="transform: scaleX(-1);" />
                            </button>

                            <div class="project-slider-track">
                                <?php while ($projects->have_posts()) : $projects->the_post(); ?>
                                    <div class="project-slide">
                                        <a href="<?php the_permalink(); ?>" class="project-link">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="project-image">
                                                    <?php the_post_thumbnail('large'); ?>
                                                </div>
                                            <?php else : ?>
                                                <div class="project-image placeholder">
                                                    <span><?php echo esc_html(get_the_title()); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <h3 class="project-title"><?php the_title(); ?></h3>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            </div>

                            <button class="slider-arrow slider-next" aria-label="Next">
                                <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/01/wfNDdPcircle1.png')); ?>" alt="Next" />
                            </button>
                        </div>
                    <?php else : ?>
                        <p class="no-projects">No projects in this category yet.</p>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('project_slider', 'project_category_slider_shortcode');

function package_slider_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'posts_per_page' => -1,
    ), $atts);

    $exclude_cats_slug = ['add-ons'];

    $exclude_cats = get_terms([
        'taxonomy' => 'package_category',
        'slug' => $exclude_cats_slug,
        'fields' => 'ids',
    ]);

    $args = array(
        'post_type' => 'package',
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'package_category',
                'field' => 'term_id',
                'terms' => $exclude_cats,
                'operator' => 'NOT IN',
            ),
        ),
    );

    $packages = new WP_Query($args);

    if (!$packages->have_posts()) {
        return '<p>No packages found.</p>';
    }

    ob_start();
?>
    <div class="package-slider-wrapper">
        <div class="slider-wrapper">
            <button class="slider-arrow slider-prev" aria-label="Previous">
                <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/01/wfNDdPcircle1.png')); ?>" alt="Previous" style="transform: scaleX(-1);" />
            </button>

            <div class="package-slider-track">
                <?php while ($packages->have_posts()) : $packages->the_post();
                    $price = get_field('package_price');
                ?>
                    <div class="package-slide">
                        <div class="package-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="package-image">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php else : ?>
                                <div class="package-image placeholder">
                                    <span><?php echo esc_html(get_the_title()); ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="package-content">
                                <h3 class="package-title"><?php the_title(); ?></h3>

                                <?php if ($price) : ?>
                                    <div class="package-price">
                                        <span class="price-amount"><?php echo '$' . esc_html($price); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="package-detail">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <button class="slider-arrow slider-next" aria-label="Next">
                <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/01/wfNDdPcircle1.png')); ?>" alt="Next" />
            </button>
        </div>
    </div>
<?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('package_slider', 'package_slider_shortcode');

function shortcode_product_filter_layout()
{
    ob_start();

    $current_cat = isset($_GET['cat']) ? sanitize_text_field($_GET['cat']) : '';

    $categories = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC',
    ]);

    $paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

    $args = [
        'post_type' => 'product',
        'posts_per_page' => 6,
        'paged' => max(1, $paged),
    ];

    if (!empty($current_cat)) {
        $args['tax_query'] = [[
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $current_cat,
        ]];
    }

    $products = new WP_Query($args);
?>
    <div class="product-layout-wrapper">

        <div>

            <div class="product-grid">
                <?php if ($products->have_posts()): ?>
                    <?php while ($products->have_posts()):
                        $products->the_post();
                        global $product;
                    ?>
                        <div class="product-item">
                            <a href="<?php the_permalink(); ?>" class="product-image-link">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium');
                                } else {
                                    echo wc_placeholder_img();
                                }
                                ?>
                            </a>
                            <div class="product-info">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <span class="product-price"><?php echo $product->get_price_html(); ?></span>

                                <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>
                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                        data-quantity="1"
                                        class="button product-add-to-cart"
                                        data-product_id="<?php echo $product->get_id(); ?>"
                                        data-product_sku="<?php echo esc_attr($product->get_sku()); ?>">
                                        <?php echo esc_html($product->add_to_cart_text()); ?>
                                    </a>
                                <?php else : ?>
                                    <span class="out-of-stock">Out of stock</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                echo paginate_links([
                    'total' => $products->max_num_pages
                ]);
                ?>
            </div>

        </div>

        <!-- RIGHT: Category list -->
        <div class="category-sidebar">
            <?php foreach ($categories as $cat): ?>
                <?php if ($cat->slug === 'uncategorized') continue; ?>

                <a href="?cat=<?php echo $cat->slug; ?>"
                    class="<?php echo ($current_cat === $cat->slug) ? 'active' : ''; ?>">
                    <?php echo $cat->name; ?>
                    (<?php echo $cat->count; ?>)
                </a>

            <?php endforeach; ?>
        </div>

    </div>

<?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('product_filter_layout', 'shortcode_product_filter_layout');
