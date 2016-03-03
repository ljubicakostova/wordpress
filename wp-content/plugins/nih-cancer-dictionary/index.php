<?php
/*
Plugin Name: NIH Cancer Dictionary
Plugin URI: http://themedipedia.com/tools/
Description: Add the NIH Cancer Dictionary Widget in the sidebar of your Health and Medical Blog or Website
Version: 1.0
Author: Haseeb Ahmad Ayazi
Author URI: http://techooid.com/
*/
 
 
class cancerdictionary extends WP_Widget
{
  function cancerdictionary()
  {
    $widget_ops = array('classname' => 'cancerdictionary', 'description' => 'NIH Cancer Dictionary' );
    $this->WP_Widget('cancerdictionary', 'NIH Cancer Dictionary', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
echo <<<_HTML

<div style="width:430px;"> <script language="javascript" type="text/javascript" src="http://www.cancer.gov/publishedcontent/Js/TermDictionaryWidgetEnglish.js"></script> </div>

_HTML;


    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("cancerdictionary");') );?>