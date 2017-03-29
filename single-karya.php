<?php
get_header();
?>
<div class="page-title">
  <div class="container">
    <h2><?php echo get_the_title();?></h2>
  </div>
</div>


<div class="container">

      <div class="karya-section">
        <div class="row">

          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- each-post -->

                <?php if ( has_post_thumbnail() ):?>
                    <img src="<?php the_post_thumbnail_url(); ?>" width="400px">
                    <br><br>
                <?php endif ?>

                <p class="post-date"><?php the_time('F jS, Y') ?></p>

                <div style="font-size:12pt">
                  <?php the_content(__('selengkapnya..')); ?>
                </div>

                <hr>
                <h4><?php echo get_comments_number(get_the_id()); ?> Komentar:</h4>
                <?php
                $post_id = get_the_id();
                $args = array(
                  'post_id' => $post_id
                );
                $comments = get_comments($args);
                foreach ( $comments as $comment ) : ?>
                <a class="comment-author" href="<?php echo $comment->comment_author_url;?>">
                  <?php echo $comment->comment_author?>
                </a> pada <?php echo $comment->comment_date;?>
                <div class="comment-content">
                  <?php echo $comment->comment_content;?>
                </div>
                <hr>
                <?php endforeach;
                $cmmnt_args = array(
                  'title_reply' => 'Tulis Komentar',
                  'title_reply_before' => '<h4>',
                  'title_reply_after' => '</h4>',
                  'label_submit' => 'Kirim',
                  'class_submit' => 'btn btn-primary btn-md',
                  'comment_field' => '<textarea id="comment" name="comment" rows="4" aria-required="true" class="form-control"></textarea>'
                );
                comment_form($cmmnt_args);
                 ?>
            <!-- each-post -->
          <?php endwhile; else: ?>
          <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
          <?php endif; ?>

        </div>
      </div>
</div>
<!-- container -->

<?php get_footer(); ?>
