<?php
/*
Plugin Name: Khoyaa Wishes
Plugin URI: http://khoyaa.com/wishes/
Description: Best wishes feed on your siderbar.
Author: khoyaa
Author URI: https://profiles.wordpress.org/khoyaa
Version: 1.0
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

if(!class_exists('Ky_Wishes'))
{
  
  class Ky_Wishes
  {
    private $plugin_url;
    
    public function __construct()
    {
      add_action( 'widgets_init',         array($this,'register_wishes_widget'));
      add_action( 'wp_enqueue_scripts',   array($this,'wishes_assests') );
      register_activation_hook( __FILE__, array($this,'Ky_activate') );
      
      $this->plugin_url                   = plugins_url('/',__FILE__);
    }
    
    public function register_wishes_widget()
    {
      include 'wishes-widget.php';
      register_widget( 'KyWishes_Widget' );
    }
    
    public function wishes_assests()
    {
      wp_enqueue_style( 'wishes-style', $this->plugin_url . 'style.css' );
    }
    
    public function Ky_activate(){}

  }
  
  new Ky_Wishes;
  
}
