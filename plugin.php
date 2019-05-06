<?php

	/**
	*
	* Plugin Name: poeticsoft-agency-hooks 
	* Plugin URI: http://www.poeticsoft.com/plugins/poeticsoft-agency-hooks
	* Description: WordPress Agency Engine Hooks by Poeticsoft
	* Version: 0.00
	* Author: Alberto Moral
	* Author URI: http://www.poeticsoft.com/albertomoral
	*
	**/	

	/* DEBUG */
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

  /* HOOKS */
  
  function poetic_post_transition(
    $new_status, 
    $old_status, 
    $post
  ) {

    $Status = $old_status . ' > ' . $new_status . ' - ' . $post->post_type . '/' . $post->id . ' - ' . date('Y/m/d - H:i:s') . PHP_EOL;
    $Wrote = file_put_contents(
      __DIR__ . '/status.txt',
     $Status,
     FILE_APPEND
    );

    $Post = json_encode($post, JSON_PRETTY_PRINT);
    $Wrote = file_put_contents(
      __DIR__ . '/post.json',
     $Post
    );
  }
  
  add_action('transition_post_status', 'poetic_post_transition', 10, 3);
  
?>