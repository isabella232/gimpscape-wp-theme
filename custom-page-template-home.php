<?php
/*
Template Name: Home Page
*/
get_header();
?>
<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
 <!-- Indicators -->
 <ol class="carousel-indicators">
   <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
   <li data-target="#myCarousel" data-slide-to="1"></li>
 </ol>
 <div class="carousel-inner" role="listbox">

   <?php
   //slide show post
   $slide = array(
     'post_type' => 'slideshow',
     'posts_per_page'   => 5,
     'offset'           => 0,
     'orderby'          => 'date',
     'order'            => 'DESC'
   );
   $slides = get_posts( $slide );
   $first_slide = true;
   foreach ($slides as $slide):
   ?>
   <?php if($first_slide): //cek apakah slide pertama?>
     <div class="item active">
   <?php
    $first_slide=false;
    else: ?>
     <div class="item">
   <?php endif; ?>
     <img src="<?php echo get_the_post_thumbnail_url($slide->ID); ?>">
     <div class="container">
       <div class="carousel-caption">
         <h3><?php echo $slide->post_title ?></h3>
       </div>
     </div>
   </div>
 <?php endforeach; //end slideshow ?>
 </div>
 <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
   <i class="fa fa-fw fa-angle-left"></i>
   <span class="sr-only">Previous</span>
 </a>
 <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
   <i class="fa fa-fw fa-angle-right"></i>
   <span class="sr-only">Next</span>
 </a>
</div><!-- /.carousel -->


  <div class="container">
    <div class="row">

      <div class="col-md-6">
        <div class="home-post">
          <?php echo get_option('topleft_info'); ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="home-post">
          <?php echo get_option('topright_info'); ?>
        </div>
      </div>

    </div>
  </div>

  <div class="info-section" style="background-image:url('<?php echo get_option('topimage_banner_url');?>')">
    <div class="container">
      <?php echo get_option('topimage_banner'); ?>
    </div>
  </div>

  <div class="container">
    <h3>Kabar GimpScape ID</h3>
    <div class="home-posts">
      <div class="row">
      <?php $kabar = array(
      	'posts_per_page'   => 4,
      	'offset'           => 0,
      	'category_name'    => 'news',
      	'orderby'          => 'date',
      	'order'            => 'DESC'
      );
      $kabar_post = get_posts( $kabar );

      foreach ($kabar_post as $kabar):
      ?>
            <!-- posts -->
            <div class="col-md-3">
              <div class="home-post">
                <p class="post-date"><?php echo date('d M Y',strtotime($kabar->post_date));?></p>
                <a href="<?php echo get_post_permalink($kabar->ID); ?>" class="post-title"><?php echo $kabar->post_title;?></a>
                <p><?php echo wp_trim_words($kabar->post_content,12,'...'); ?></p>
              </div>
            </div>
            <!-- posts -->
      <?php endforeach;?>
      </div><!-- row -->
    </div>
  </div><!-- container -->


  <div class="followus">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <?php echo get_option('features_desc'); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="followus-benefit">
            <?php echo get_option('left_features'); ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="followus-benefit">
            <?php echo get_option('mid_features'); ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="followus-benefit">
            <?php echo get_option('right_features'); ?>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- followus -->

  <div class="supportus" style="background-image:url('<?php echo get_option('support_bg'); ?>')">
    <div class="container">
      <div class="supportus-title"><?php echo get_option('support_title'); ?></div>
      <div class="row">
        <div class="col-md-6" style="text-align:center;">
          <img src="<?php echo get_option('support_icon');?>" width="150px">
        </div>
        <div class="col-md-6">
          <p><?php echo get_option('support_desc'); ?></p>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
