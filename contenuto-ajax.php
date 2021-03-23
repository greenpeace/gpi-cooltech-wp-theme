<article class='element <?php echo $p->post->post_type; ?>' id=''>
  <div class='row'>
    <div class='col-md-12'>
      <div class="product-title-block">

        <div><h2 class="result_title">
          <?php
          $title=$p->post->post_title;
          // if the title is the same as the manufacturer
          if($title==$p->manufacturer[0] || get_post_meta($p->post->ID, "hide_manufacturer")==true || $p->post->post_type=="case-study" ) {
            $titolo=$title;
          }  else {
          // else
            $titolo=$title." - ".$p->manufacturer[0];
          }
          ?>
          <?php echo $titolo; ?></h2>
          <div class="subtitle-product-list"><?php echo getTypeLabel($p->post->post_type);  ?></div>
        </div>


        <?php  if($expanded!=1 && $p->post->post_type!="zero") { ?>
          <button class="<?php echo $p->post->sector; ?> expand_text btn btn-rounded btn-outline-dark"> <?php _e( 'More Information', 'cooltech' ); ?>

          </button>
          <?php  } else { ?>
            <a class="more_text <?php echo $p->post->sector; ?> btn btn-rounded btn-outline-dark" href="<?php echo $p->post->guid ?>"><?php _e( 'More Information', 'cooltech' ); ?>  </a>
          <?php } ?>
         </div>
  </div>
</div>
<div class='row'>
  <div class='col-md-3'>
    <?php if($p->img) { ?>
    <img src="<?php echo $p->img;  ?>" class="img-fluid" />
    <?php } ?>

  </div>
  <div class='col-md-3'>
    <div class='result_meta_title'>Sector</div>
    <div class='result_meta_content'><?php echo $p->sector;?></div>
    <div class='result_meta_title'>Application</div>
    <div class='result_meta_content'><?php echo implode($p->application, " "); ?></div>
    <div class='result_meta_title'>Technology Type </div>
    <div class='result_meta_content'><?php echo implode($p->technology_type, " "); ?></div>
  </div>

  <div class='col-md-3'>
    <div class='result_meta_title'>Refrigerant</div>
    <div class='result_meta_content'>
      <?php echo	implode($p->refrigerant," "); ?>
    </div>
    <div class='result_meta_title'>Manufacturer</div>
    <div class='result_meta_content'>
      <?php echo	implode($p->manufacturer, " "); ?>
    </div>
    <div class='result_meta_title'>			<?php
      if($p->post->post_type=="equipment") {
        _e( 'Manufacturer Country', 'cooltech' );
      } elseif($p->post->post_type=="zero") {
        _e( 'Availability', 'cooltech' );
      } else {
        _e( 'Country', 'cooltech' );
      }
        ?>						</div>
    <div class='result_meta_content'>
      <?php echo	implode($p->country," "); ?>
    </div>
  </div>

  <div class='col-md-3'>
      <div class='result_meta_title'>Energy Efficency</div>
      <div class='result_meta_content'>
        <?php echo wp_trim_words($p->energy_efficency,25,"..."); ?></div>
      </div>
</div>

<div class='equipment_full_text'>

    <div class='row'>
      <div class='col-sm-3'></div>
      <div class='col-sm-9'>
        <div><p><?php echo $p->post->post_content; ?></p></div>

<?php

if($p->source) { ?>
<div class='result_meta_title'><a title='' target='_blank'>Source</a></div><div class='result_meta_content result_source'><a href="<?php echo add_http($source); ?>"><?php echo $p->source ?></a></div>
<?php
}
?>
<?php if($p->web) {
$web=explode(",",$p->web);
   ?>
<div class='result_meta_title'>Website</div>
<div class='result_meta_content result_web'>
  <?php foreach ($web as $w) {?>
  <a href="<?php echo $w ?>" target="_blank"><?php echo $w; ?></a>
  <?php } ?>
</div>

<?php
} ?>


</div></div></div></article>
