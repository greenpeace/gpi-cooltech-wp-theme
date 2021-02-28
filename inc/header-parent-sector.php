<?php
$image_id = get_term_meta( get_queried_object()->term_id, 'image', true );
$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
?>
<header class="masthead" style=" background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(<?php echo $post_thumbnail_img[0]; ?>)">
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-center">
        <h1 class="text-white <?php echo $font; ?>"><?php single_cat_title(); ?>

        </h1>
      </div>
    </div>
  </div>
</header>
