<?php get_header();?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="content">
        <h1 class="title-page"><?php the_title();?></h1>
<!--        <img src="--><?php //echo getPostImage();?><!--" alt="Image" class="alignleft">-->
        <div>
            <?php the_content();?>
        </div>
    </div>
<?php endwhile; else : ?>
    <p><?php esc_html_e( 'Не найдено постов' ); ?></p>
<?php endif; ?>
<?php get_footer();?>