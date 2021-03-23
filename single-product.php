<section class="category-list <?php echo $p->slug; ?>">
    <div class="container bg-white">
      <div class="row">
        <div class="single-net-zero-title single-title colour-title col-sm-12">
          <div class="d-flex justify-content-between">
          <h1><?php the_title(); ?> </h1>

          <div class="print-icon">
            <a href="javascript:window.print()"><svg class="print-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M399.95 160h-287.9C76.824 160 48 188.803 48 224v138.667h79.899V448H384.1v-85.333H464V224c0-35.197-28.825-64-64.05-64zM352 416H160V288h192v128zm32.101-352H127.899v80H384.1V64z"/></svg></a></div>
          </div>

          Net Zero Product - <a href="../../sector/<?php echo $p->slug;  ?>"><?php echo $p->name; ?></a> / <a href="../../sector/<?php echo $se[0]->slug; ?>"><?php echo $se[0]->name; ?></a>
      </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
             <?php  get_sidebar("product"); ?>
        </div>
        <div class="col-sm-8">
          <!-- article -->
          <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <?php the_content();
                  $ee=get_post_meta($post->ID, "energy_efficency", true);
                  $source=get_post_meta($post->ID, "source", true);
                  $web=get_post_meta($post->ID, "website", true);
                  $web=explode(",",$web);
                  if ($ee) { ?>
                    <h2 class="single-title-energy-efficency colour-title"> <?php _e("Energy Efficency","cooltech"); ?> </h2>
                    <?php echo $ee; ?>
                  <?php  } ?>
              <?php if($web) { ?>
                <div class="result_meta_title colour-title"><?php _e('Website', 'cooltech'); ?></div>
                <div class="result_meta_content">
                  <?php foreach ($web as $w) {?>
                  <a href="<?php echo $w ?>" target="_blank"><?php echo $w; ?></a>
                  <?php } ?>
                  </div>
              <?php } ?>

              <?php if (strlen($source)>2) {
              //  echo strlen($source);
                ?>
                <div class="result_meta_title colour-title"><?php _e('Source', 'cooltech'); ?></div>
                    <div class="result_meta_content">
                <?php  echo createLink($source); ?></div>
              <br class="clear">
              <?php } ?>
              <?php // edit_post_link(); ?>
            </article>
          </div>

    </div>
