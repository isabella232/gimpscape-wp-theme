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


        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
              <p class="post-date"><?php the_time('F jS, Y') ?></p>
              <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
              <p><?php echo wp_trim_words(get_the_content(),33,'...'); ?></p>
              <p class="post-att"><?php echo get_comments_number(get_the_id()); ?> Komentar</p>
            </div>
          </div>
          <!-- each-post -->
        <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>

      </div>
    </div>

    <?php get_sidebar(); ?>

  </div>
</div>
<!-- container -->
<?php get_footer(); ?>
