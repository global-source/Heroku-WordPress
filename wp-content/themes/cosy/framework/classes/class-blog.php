<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Cosy_Blog {

    public function __construct(){

        add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 100 );
        add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

    }

    public function excerpt_more( ){
        return '&hellip;';
    }

    public function excerpt_length( $length ) {

        // Normal blog posts excerpt length.
        if ( ! is_null( Cosy()->settings->get( 'blog_excerpt_length' ) ) ) {
            $length = Cosy()->settings->get( 'blog_excerpt_length' );
        }

        return $length;

    }

}