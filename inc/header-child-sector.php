<?php
$id=get_queried_object()->parent;
$parent=	get_term($id,"type");
?>
  <header class="masthead second-taxonomy">
    <div class="container">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="last-sector text-black font-weight-bold <?php echo $parent->slug; ?>">  <?php if($_GET["pt"]=="zero") { echo "Net-Zero "; }?><?php single_cat_title(); ?> <?php echo $parent->name ?>
          <?php  $id=get_queried_object()->parent;
          $parent=	get_term($id,"type"); ?>
          </h1>
        </div>
        <div class="col-lg-8 align-self-baseline">
          <div><h3 class="<?php echo $parent->slug; ?>">
            <?php if($_GET["pt"]=="zero") { ?>
              <?php echo do_shortcode(get_term_meta( get_queried_object()->term_id, 'net_to_zero_desc', true ));
              ?>
            <?php } else { ?>
            <?php echo get_queried_object()->description; ?></h3></div>
          <?php }  ?>
            <?php if(!$_REQUEST["pt"]) { ?>
          <div class="text-full-second"><?php echo do_shortcode(get_term_meta( get_queried_object()->term_id, 'full_text', true ));
          ?> </div>
        <?php } ?>
        </div>
      </div>
      <?php if($_GET["pt"]=="zero") { ?>
        <?php $pdf=get_term_meta(get_queried_object()->term_id,"pdf",true); ?>
        <?php $file=wp_get_attachment_url($pdf )?>
        <?php if($pdf) { ?>
          <div class="row">
            <div class="col-sm-12 text-center">
              <div class="download-pdf <?php echo $parent->slug; ?>">
              <a href="<?php echo $file; ?>" target="_blank"> DOWNLOAD PDF </a><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-pdf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-file-pdf fa-w-12 fa-2x"><path fill="currentColor" d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z" class=""></path></svg></i></div>
              </div>
          </div>
      <?php }
      } ?>

      <?php $term = $wp_query->queried_object;
      // print_r($term);
      ?>
    <div class="row">
       <div class="col-lg-12 align-self-end">
      <input type="hidden" id="sector" value="<?php echo $slug ?>">
      <div id="selectblock" class="row d-print-none">
        <div id="selectcolumn" class="col-sm-12">
        <?php
    //		print_r($term);
  // 	$tags=array_unique(get_tags_in_use($term->term_id,"application"));
        $tags=get_tags_in_use($term->term_id,"application");
      //	print_r($tags); ?>

       <div class="selectdiv">	<select id="application" class="select-filter" name="application">
          <option value="0"> <?php _e("Applications","cooltech"); ?></option>
          <?php foreach($tags as $tag) { ?>
          <option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
          <?php }?>
        </select> </div>
        <?php

        $tags=get_tags_in_use($term->term_id,"country");

        //print_r($tags); ?>
        <div class="selectdiv"><select id="country" class="select-filter" name="country">
          <option value="0">
            <?php
    				if($_GET["pt"]=="zero") {
    			 		_e("Availability");
    		 		} else {
    					_e("Country","cooltech");
    				}
    			 ?>
          </option>
          <?php foreach($tags as $tag) { ?>
          <option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
          <?php }?>
        </select></div>
        <?php
        // print_r($term);
        $tags=get_tags_in_use($term->term_id,"refrigerant");
    ; ?>
    <div class="selectdiv">
        <select id="refrigerant" class="select-filter" name="refrigerant">
          <option value="0"><?php _e("Refrigerant","cooltech"); ?>  </option>
          <?php foreach($tags as $tag) { ?>
          <option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
          <?php }?>
        </select>
      </div>
        <?php
        // print_r($term);
        $tags=get_tags_in_use($term->term_id,"manufacturer");
        //print_r($tags); ?>
        <div class="selectdiv">
        <select id="manufacturer" class="select-filter" name="manufacturer">
          <option value="0"> <?php _e("Manufacturer","cooltech"); ?> </option>
          <?php foreach($tags as $tag) { ?>
          <option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
          <?php }?>
        </select>
      </div>
        <?php
        // print_r($term);
        $tags=get_tags_in_use($term->term_id,"technology-type");
     ?>
<div class="selectdiv">
        <select id="technology-type" class="select-filter" name="technology-type">
          <option value="0"> <?php _e("Technology Type","cooltech"); ?> </option>
          <?php foreach($tags as $tag) { ?>
          <option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
          <?php }?>
        </select>
</div>
<?php if($_GET["pt"]=="zero") { ?>
    <input type="hidden" id="type" value="zero">
<?php } else { ?>
  <div class="selectdiv">
        <select class="select-filter" id="type">
          <option value="0"><?php _e("Type","cooltech"); ?></option>
          <option value="equipment"><?php _e("Cool Technologies Products","cooltech"); ?></option>
          <option value="case-study"><?php _e("Case Study","cooltech"); ?></option>
            <?php
            $options = get_option( 'ntz_option' );
            if ($options) { ?>
          <option value="zero"><?php _e("Pathway to Zero Products","cooltech"); ?> </option>
            <?php } ?>
        </select>
    </div>
  <?php
  }
  ?>
</div>
        </div>
      </div>


    </div>
  </div>
  </header>
