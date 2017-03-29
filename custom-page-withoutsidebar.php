<?php
/*
Template Name: Without Sidebar
*/
get_header();
?>
<div class="page-title">
  <div class="container">
    <h2><?php echo get_the_title();?></h2>
  </div>
</div>

  <div class="content-page">
    <div class="container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- each-post -->

            <?php if ( has_post_thumbnail() ):?>
                <img src="<?php the_post_thumbnail_url(); ?>" width="400px">
            <?php endif ?>

            <div style="font-size:12pt">
              <?php the_content(__('(more...)')); ?>
            </div>

        <!-- each-post -->
      <?php endwhile; else: ?>
      <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
      <?php endif; ?>
    </div>
  </div>

<?php get_footer(); ?>
