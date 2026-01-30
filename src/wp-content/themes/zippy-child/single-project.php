<?php
get_header();
?>

<main id="main" class="">
    <?php
    while (have_posts()) : the_post();
    
        echo do_shortcode('[block id="project-layout"]');

    endwhile;
    ?>
</main>

<?php
get_footer();
