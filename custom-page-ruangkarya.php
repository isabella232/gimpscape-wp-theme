<?php
/*
Template Name: Ruang Karya
*/
get_header();
?>
<div class="page-title">
  <div class="container">
    <h2><?php echo get_the_title();?></h2>
  </div>
</div>

<div class="karya-filter-sec">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <ul class="filter-nav">
        <li class="filter-dropdown"><span>Kategori<i class="fa fa-fw fa-angle-down"></i></span>
          <ul class="dropdown-content">
            <li><a href="<?php esc_url(the_permalink()); ?>">Semua Kategori</a></li>
            <?php
            $terms = get_terms(array(
              'taxonomy' => 'kategori'
            ));
            foreach ($terms as $kategori):?>
            <li><a href="<?php esc_url(the_permalink()); ?>?cat=<?php echo $kategori->slug;?>"><?php echo $kategori->name;?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</div>

<div class="container">

      <div class="karya-section">
        <div class="row">
          <?php
          //karya show post
          $paged = get_query_var('paged') ? get_query_var('paged') : 1;
          $karya = array(
            'post_type'        => 'karya',
            'posts_per_page'   => 24,
            'paged'            => $paged,
            'orderby'          => 'date',
            'order'            => 'DESC'
          );
          if (isset($_GET['cat'])) {
            $cat = $_GET['cat'];
            array_push($karya['kategori']=$cat);
          }
          $karyanum = 1;
          $karya = new WP_Query( $karya );

          if($karya->have_posts()):
            while ($karya->have_posts()) : $karya->the_post();?>
            <!-- karya -->
            <div class="col-md-3 col-sm-4 col-xs-12">
              <a href="#" data-toggle="modal" data-target="#karya<?php echo $karyanum;?>">
                <div class="karya">
                  <div class="karya-img" style="background-image:url('<?php echo get_the_post_thumbnail_url($karya->ID); ?>');"></div>
                  <div class="karya-info">
                    <p class="karya-info-title"><?php the_title() ?></p>
                    <p><?php echo wp_trim_words(get_the_content(),25,'...'); ?></p>
                    <p><?php echo date('d M Y',strtotime(get_the_date()));?></p>
                  </div>
                </div>
              </a>
            </div>
            <!-- karya -->
            <!-- modal karya hidden-->
            <div class="modal fade bs-example-modal-lg" id="karya<?php echo $karyanum;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-container">
                  <!-- konten -->
                  <div class="karya-head">
                    <h1><?php the_title() ?></h1>
                    <h2>oleh <a href="<?php echo get_post_meta(get_the_ID(),'artist_url',true); ?>"><?php echo get_post_meta(get_the_ID(),'artist',true); ?></a> pada <?php echo date('d M Y',strtotime(get_the_date()));?></h2>
                  </div>

                  <div class="karya-modal">
                    <img src="<?php echo get_the_post_thumbnail_url($karya->ID); ?>" class="img-karya-modal">
                  </div>
                  <div class="karya-modal-desc">
                    <div class="row">
                      <div class="col-md-8 col-md-push-2">
                        <?php echo $karya->post_content ?>
                        <br>
                        <br>
                        <hr/>
                        <strong><?php echo get_comments_number($karya->ID); ?> Tanggapan:</strong>
                        <?php
                        $args = array(
                          'post_id' => get_the_ID(),
                          'post_type' => 'karya'
                        );
                        $comments = get_comments($args);
                        foreach ( $comments as $comment ) : ?>

                        <div class="comment-content">
                          <a class="comment-author" href="<?php echo $comment->comment_author_url;?>">
                            <?php echo $comment->comment_author?>
                          </a>
                          <p><?php echo $comment->comment_content;?></p>
                          <p class="date"><?php echo date('d M Y, H:i',strtotime($comment->comment_date));?></p>
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
                        comment_form($cmmnt_args,get_the_ID());


                         ?>

                      </div>

                    </div>
                  </div>

                  <!-- konten -->
                </div>
              </div>
            </div>
            <!--modal karya -->
            <?php
            $karyanum++;
            endwhile;?>
          </div>
          <!-- row -->
            <?php
                next_posts_link( 'Karya Selanjutnya', $karya->max_num_pages );
                previous_posts_link( 'Karya Sebelumnya' );
                wp_reset_postdata();
           endif;
          ?>
      </div>
</div>
<!-- container -->

<?php get_footer(); ?>
