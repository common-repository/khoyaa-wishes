<?php
class KyWishes_Widget extends WP_Widget
{
  public function __construct() 
  {
    parent::__construct('ky-wishes',__('Khoyaa Wishes', 'ky-wishes'),array( 'description' => __( 'Wishes Feed on your Sidebar from Khoyaa.com', 'ky-wishes' ) ));
  }

  public function widget( $args, $instance )
  {
    $site_url                             = 'http://khoyaa.com';
    $loc                                  = '/wishes/';
    $sa                                   = $site_url.'/api'.$loc;
    
    $ch                                   = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sa);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $f                                    = curl_exec($ch);
    curl_close($ch);

    $c                                    = json_decode($f);
    ?>
    <div class="kyw-box">
      <div class="kyw-title"><a href="<?php echo $site_url.$loc; ?>"><?php echo $instance['title'];?></a></div>
      <div class="kyw-divider"></div>
      <div class="kyw-content">
      <?php foreach( $c as $p ){ $iu = $site_url.'/wishes/'.$p->id.'/'.$p->name.'/';?>
        <div class="kyw-c-title"><a class="kyw-at" href="<?php echo $iu; ?>"><?php echo $p->title; ?></a></div>
        <div class="kyw-c-body"><?php echo $p->content; ?><a href="<?php echo $iu; ?>" class="kyw-read">read it</a></div>
        <div class="kyw-hr"></div>
      <?php } ?>
        <div class="kyw-more"><a href="<?php echo $site_url.$loc; ?>">more &raquo;</a></div>
      </div>
      <div class="kyw-copy">
        <a class="ap" href="<?php echo $site_url; ?>">&copy; khoyaa.com</a>
        <a class="get" href="https://profiles.wordpress.org/khoyaa">get this widget</a>
        <div class="clear"></div>
      </div>
      <div class="kyw-divider btm"></div>
    </div>
    <?php
  }
   
  public function update( $new_instance, $instance )
  {
    $instance['title']                    = esc_html($new_instance['title']);
    return $instance;
  }
   
  public function form( $instance )
  {
    $instance                             = wp_parse_args( $instance, array(
                                            'title'           => 'Wishes'
                                            ) );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ky-wishes'); ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
    </p>
    <?php
  }
}
