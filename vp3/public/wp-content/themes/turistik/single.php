<?php get_header();?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="content">
        <div class="article-title title-page">
           <?php the_title(); ?>
        </div>
<!--        <div class="article-image"><img src="--><?php //echo getPostImage();?><!--" alt="Image поста"></div>-->
        <div class="article-info">
            <div class="post-date"><?php the_date(); ?></div>
        </div>
        <div class="article-text">
            <?php the_content(); ?>
        </div>
        <div class="article-pagination">
            <div class="article-pagination__block pagination-prev-left"><a href="<?php $post = get_adjacent_post(true); echo get_permalink($post->ID); ?>" class="article-pagination__link"><i class="icon icon-angle-double-left"></i>Предыдущая статья</a>
                <div class="wrap-pagination-preview pagination-prev-left">
                    <div class="preview-article__img"><?php echo previous_image_link("medium"); ?></div>
                    <div class="preview-article__content">
                        <div class="preview-article__info"><a href="#" class="post-date"><?php echo $post->post_date; ?></a></div>
                        <div class="preview-article__text"><?php echo $post->post_title; ?></div>
                    </div>
                </div>
            </div>
            <div class="article-pagination__block pagination-prev-right">
                <a href="<?php $next_post = get_adjacent_post(true, '', false); echo get_permalink($next_post->ID); ?>" class="article-pagination__link">Сдедующая статья<i class="icon icon-angle-double-right"></i>
                </a>
                <div class="wrap-pagination-preview pagination-prev-right">
                    <div class="preview-article__img"><?php echo next_image_link("medium"); ?></div>
                    <div class="preview-article__content">
                        <div class="preview-article__info"><a href="#" class="post-date"><?php echo $next_post->post_date; ?></a></div>
                        <div class="preview-article__text"><?php echo $next_post->post_title; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; else : ?>
    <p><?php esc_html_e( 'Не найдено постов' ); ?></p>
<?php endif; ?>
<?php get_footer();?>