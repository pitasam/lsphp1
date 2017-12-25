<?php get_header();?>
<div class="content">
    <h1 class="title-page">Последние новости и акции из мира туризма</h1>
    <div class="posts-list">

        <?php
        $params = [
                'post_type' => ['post', 'akcia'],
                's' => $_GET['s'],
                'tag' => get_query_var('tag'),
                'cat' => get_query_var('category_name')
        ];

        $posts = query_posts($params);

//        $query = query_posts('post_type=post');

        ?>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="post-wrap">
                <div class="post-thumbnail"><img src="<?php echo getPostImage(); ?>" alt="Image поста" class="post-thumbnail__image"></div>
                <div class="post-content">
                    <div class="post-content__post-info">
                        <div class="post-date"><?php the_date();?></div>
                    </div>
                    <div class="post-content__post-text">
                        <div class="post-title">
                            <?php the_title();?>
                        </div>
                        <div class="post-content__content">
                            <?php the_excerpt();?>
                        </div>
                    </div>
                    <div class="post-content__post-control"><a href="<?php the_permalink();?>" class="btn-read-post">Читать далее >></a></div>
                </div>
            </div>
        <?php endwhile; else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>

        <?php
        $args = array(
            'show_all'     => true, // показаны все страницы участвующие в пагинации
            'end_size'     => 1,     // количество страниц на концах
            'mid_size'     => 1,     // количество страниц вокруг текущей
            'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
            'prev_text'    => __('«'),
            'next_text'    => __('»')
        );
        echo get_the_posts_pagination($args);
        wp_reset_postdata();
        wp_reset_query();
        ?>

    </div>
</div>
<!-- sidebar-->
<div class="sidebar">
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Теги</div>
        <div class="sidebar-item__content">
            <?php
            $tags = wp_tag_cloud();
            ?>
        </div>
    </div>
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Категории</div>
        <div class="sidebar-item__content">
            <?php
            $cats = get_categories();
            ?>
            <ul class="category-list">
                <?php foreach ($cats as $cat) : ?>
                <li class="category-list__item">
                    <a href="<?php echo get_category_link($cat->ID); ?>" class="category-list__item__link">
                        <?php echo $cat->name;?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="sidebar__sidebar-item">
        <div class="calendar"><?php get_calendar( false ); ?></div>
    </div>
</div>

<?php get_footer();?>