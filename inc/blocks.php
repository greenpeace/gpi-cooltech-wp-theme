<?php
function cooltech_block_init() {

  wp_register_script('gut-js', get_template_directory_uri()  . '/blocks/intro/block-intro.js', array( 'wp-blocks', 'wp-element', 'wp-editor' ));
  wp_enqueue_script('gut-js');

  wp_register_script('tab-js', get_template_directory_uri()  . '/blocks/block-tabs/block-tabs.js', array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor'));
  wp_enqueue_script('tab-js');

  wp_register_style('tab-css', get_template_directory_uri() . '/blocks/intro/block-intro.css', array( 'wp-edit-blocks' ));
  wp_enqueue_style('tab-css');

wp_register_script(
    'innerblock-block-js',
    get_template_directory_uri() . '/blocks/innerblock/blocks.build.js', // Handle.
    array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
    null,
    true // Enqueue the script in the footer.
  );

  wp_register_style(
    'innerblock-style-css', get_template_directory_uri() . '/blocks/innerblock/blocks.style.build.css',  array( 'wp-editor' ),
    null);
  // wp_enqueue_style('testa-cgb-style-css');

  // Register block editor script for backend.


  // Register block editor styles for backend.
  wp_register_style(
    'innerblock-block-editor-css', // Handle.
    get_template_directory_uri() . '/blocks/innerblock/blocks.editor.build.css', // Block editor CSS.
    array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
    null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
  );
  // wp_enqueue_style('testa-cgb-block-editor-css');

  wp_register_script(
      'magic_numbers-block-js',
      get_template_directory_uri() . '/blocks/magic-numbers/blocks.build.js', // Handle.
      array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
      null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
      true // Enqueue the script in the footer.
    );

    wp_register_style(
      'magic_numbers-style-css', get_template_directory_uri() . '/blocks/magic-numbers/blocks.style.build.css',  array( 'wp-editor' ),
      null);
    // wp_enqueue_style('testa-cgb-style-css');

    // Register block editor script for backend.


    // Register block editor styles for backend.
    wp_register_style(
      'magic_numbers-block-editor-css', // Handle.
      get_template_directory_uri() . '/blocks/magic-numbers/blocks.editor.build.css', // Block editor CSS.
      array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
      null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
    );

register_block_type( 'cooltech/block-tabs', array(
	/** Define the attributes used in your block */
		'attributes'  => array(
				'mb_url' => array(
						'type' => 'string'
				)
		),
		'category' => 'widgets',
		'editor_script'   => 'mb-simple-block',
		'render_callback' => 'ct_block_tab_render2',
) );

register_block_type(
  'cooltech/magic-numbers', array(
    // Enqueue blocks.style.build.css on both frontend & backend.
    'style'         => 'magic_numbers-style-css',
    // Enqueue blocks.build.js in the editor only.
    'editor_script' => 'magic_numbers-block-js',
    // Enqueue blocks.editor.build.css in the editor only.
    'editor_style'  => 'magic_numbers-block-editor-css',
    'category'=>'common'
  )
);

register_block_type(
  'cooltech/innerblock', array(
    // Enqueue blocks.style.build.css on both frontend & backend.
    'style'         => 'innerblock-style-css',
    // Enqueue blocks.build.js in the editor only.
    'editor_script' => 'innerblock-block-js',
    // Enqueue blocks.editor.build.css in the editor only.
    'editor_style'  => 'innerblock-block-editor-css',
  )
);

}
add_action( 'init', 'cooltech_block_init' );

/* BLOCK TABS */

function ct_block_tab_render2( $attributes ) {
      $is_in_edit_mode = strrpos($_SERVER ['REQUEST_URI'], 'context=edit');
      $content = $attributes['mb_url'];
      $pagine = explode(",",$content);
      // $tabs=array(126,128,132);
      $args = array(
      'numberposts' => 3,
      'post_type'   => 'page',
      'post__in' => $pagine );

      $pages = get_posts( $args );

      if ($is_in_edit_mode) {
      		$out = '	<h2> Tabs Block </h2>';
      		foreach($pages as $page) {
      			$testo.=$page->post_title."<br/>";
      		}
        $out .= $testo;
      } else {
      	$out="";
      	global $page_layout;
      	ob_start();
      ?>
      </div>
      	<section>
       	 <div class="<?php echo $page_layout; ?>">
   	        <div class="tab-content" id="pills-tabContent">
      <?php
      	$x=0;
        foreach($pages as $page) {
        ?>
      <div class="tab-pane fade <?php echo '',($x == 0 ? 'show active' : ''); ?>" id="pills-<?php echo $page->ID; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $page->ID ?>-tab">
       			<div class="row">
       				<div id="tab-img" class="col-sm-5 offset-sm-1">
       			<?php echo get_the_post_thumbnail($page->ID); ?>
       				</div>
              <div class="col-sm-1"></div>
       				<div id="tab-text" class="col-sm-4">
       					<h2><?php echo $page->post_title;  ?></h2>
       			<?php echo $page->post_excerpt; ?>
       			<div id="tab-button">
       			<a class="btn btn-rounded btn-outline-dark btn-arrow" href="<?php echo get_permalink($page->ID); ?>"> More information <i class="i-arrow-right arrow-blue" style="vertical-align: middle"></i></a>
       			</div>
       				</div>
       			</div>
       		</div>
       		<?php
       			$x++;
       				}
       		?>
       		</div>
    	<div class="row">
       		<div class="col-md-12">
       	 <ul id="cooling-tab" class="nav nav-pills mb-3" id="pills-tab" role="tablist">

       		 <?php
       				$x=0;
       			 foreach($pages as $page) {
       		 ?>
       		 <li class="nav-item nav-fill">
       			<a class="btn btn-rounded nav-link <?php echo '',($x == 0 ? 'active' : ''); ?>" id="pills-<?php echo $page->ID; ?>-tab" data-toggle="pill" href="#pills-<?php echo $page->ID; ?>" role="tab" aria-controls="<?php echo $page->ID; ?>" aria-selected="true"><?php echo $page->post_title; ?></a>
       		</li>
       		 <?php
       				$x++;
       			 }
       			?>
       	 </ul>
        </div>
        </div>
        </div>
       </section>
       <div class="<?php echo $page_layout; ?>">

<?php
      $out = ob_get_contents();
      ob_end_clean();
      }
      return $out;
      }
?>
