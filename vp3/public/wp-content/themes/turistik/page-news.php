<?php
/**
 * Template name: news
 */
get_header();?>

<div class="content">
    <?php
    $query = query_posts('post_type=post');
    ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <li><?php the_title(); ?>

    <?php endwhile; else : ?>
        <p><?php esc_html_e( 'Не найдено постов' ); ?></p>
    <?php endif; ?>

    <?php
    echo get_the_posts_pagination();
    wp_reset_postdata();
    wp_reset_query();
    ?>

</div>

<?php get_footer();?>