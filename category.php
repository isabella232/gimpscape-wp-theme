<?php get_header(); ?>

<div class="page-title">
  <div class="container">
    <h2>
      <?php single_cat_title(); ?>
    </h2>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="content-rounded-pop">


        <?php
        $currCat = get_category(get_query_var('cat'));
        $category = $currCat->slug;

        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $query = new WP_Query(
          array(
              'post_type'     => 'post',
              'posts_per_page' => 5,
              'paged'         => $paged,
              'category_name' => $category,
              'orderby'       => 'date',
              'order'         => 'desc',
          )
        );

         if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
          <!-- each-post -->
          <div class="post">
            <div class="img-col">
              <?php if ( has_post_thumbnail() ):?>
                  <img src="<?php the_post_thumbnail_url(); ?> ">
              <?php else:?>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumbnail-post.png">
              <?php endif ?>

            </div>
            <div class="post-col">
              <p class="post-date"><?php the_time('d M Y') ?></p>
              <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
              <p><?php echo wp_trim_words(get_the_content(),33,'...'); ?></p>
              <p class="post-att"><?php echo get_comments_number(get_the_id()); ?> Komentar</p>
            </div>
          </div>
          <!-- each-post -->
        <?php endwhile;
        echo "<p class='text-center'>";
        next_posts_link( 'Artikel Selanjutnya', $query->max_num_pages );
        previous_posts_link( 'Artikel Sebelumnya' );
        echo "</p>";
        wp_reset_postdata();
       else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>

      </div>
    </div>

    <?php get_sidebar(); ?>

  </div>
</div>
<!-- container -->
<?php get_footer(); ?>
