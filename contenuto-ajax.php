

<article class='element <?php echo $p->post->post_type; ?>' id=''>

  <div class='row d-lg-none'><div class='col-md-12'>
  </div></div>
<div class='row'>
  <div class='col-md-3'>
    <h2 class='result_title d-lg-block'><?php echo $p->post->post_title; ?></h2>
    <img src="<?php echo $p->img;  ?>" class="img-fluid" />

    <?php  if($p->post->expanded!=1 && $p->post->post_type!="zero") { ?>
      <button class="<?php echo $p->post->sector; ?> expand_text btn btn-rounded btn-outline-dark"> <?php _e( 'More Information', 'cooltech' ); ?>
    </button>
    <?php  } else { ?>
      <a class="more_text <?php echo $p->post->sector; ?> btn btn-rounded btn-outline-dark" href="<?php echo $p->post->guid ?>"><?php _e( 'More Information', 'cooltech' ); ?>  </a>
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
    <div class='result_meta_title'>		Country								</div>
    <div class='result_meta_content'>
      <?php echo	implode($p->country," "); ?>
    </div>
  </div>

  <div class='col-md-3'>
      <div class='result_meta_title'>Energy Efficency</div>
      <div class='result_meta_content'>
        <?php echo $p->energy_efficency; ?></div>
      </div>
</div>

<div class='equipment_full_text'>

    <div class='row'>
      <div class='col-sm-3'></div>
      <div class='col-sm-9'>
        <div><p><?php echo $p->post->post_content; ?></p></div>

<?php

if($p->source) { ?>
<div class='result_meta_title'><a title='' target='_blank'>Source</a></div><div class='result_meta_content result_source'><a href='"+obj[x].source+"'><?php echo $p->source ?></a></div>;
<?php
}
?>
<?php if($p->web) { ?>
<div class='result_meta_title'>Website</div><div class='result_meta_content result_web'><a href='web' target='_blank'><?php echo $p->web ?></a></div>

<?php
} ?>


</div></div></div></article>
