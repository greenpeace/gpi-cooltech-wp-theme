<?php

use WP_Post;

class Element  {

    /**
     * @var WP_Post
     */
    public $post;
    public $application;
    public $technology_type;
    public $refrigerant;
    public $country;
    public $energy_efficency;
    public $source;
    public $website;
    public $sector;

    /**
     * @param WP_Post $post
     */
    public function __construct( WP_Post $post ) {

        $this->post = $post;

    }

    /**
     * @return string
     */
    public function get_sector() {
        $args=array("childless"=>true);
        $se=wp_get_post_terms( $this->post->ID, "type", $args );

       foreach ($se as $s ) {
        $p=get_term($s->parent);
        $result.= $p->name." ".$s->name."<br/>";
      }
    // $result="aaa";
      return $result;
    }


} ?>
