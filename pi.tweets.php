<?php
class Plugin_tweets extends Plugin {

  var $meta = array(
    'name'       => 'Tweets',
    'version'    => '0.1',
    'author'     => 'Max Westen',
    'author_url' => 'http://dlmax.org'
  );

  function __construct() {
    parent::__construct();
    $this->site_root  = Statamic::get_site_root();
    $this->theme_root = Statamic::get_templates_path();

    $this->plugin_path = $this->getPluginPath();
  }


  /**
   * Returns the 'count' tweets for the twitter user 'name'.
   * @return string
   */
  public function tweets()
  {
    $name = $this->fetch_param('name', null); // defaults to none
    $count = $this->fetch_param('count', 10, 'is_numeric'); // defaults to 10
	  $show_replies = $this->fetch_param('show_replies', false, false, true); // defaults to false
	  $show_retweets = $this->fetch_param('show_retweets', true, false, true); // defaults to true

    $show_replies = ($show_replies) ? 1 : 0;
    $show_retweets = ($show_retweets) ? 1 : 0;

    if ($name) {
      // Include the needed CSS for this plugin
      $inline_styles  = '<style type="text/css">';
      $inline_styles .= $this->getPluginCss();
      $inline_styles .= '</style>';

      // Include the needed javascript
      $js = '
      <ul id="'.$name.'_tweets" class="tweets">
        <li class="loading">Fetching Tweets...</li>
      </ul>
      <script type="text/javascript">
        $(document).ready(function() {
          getTwitterFeed("'.$name.'", '.$count.', '.$show_replies.', '.$show_retweets.');
        });
      </script>
      <script src="'.$this->plugin_path.'js/pi.tweets.js" type="text/javascript"> </script>
      <p>Volg <a href="http://twitter.com/'.$name.'">@'.$name.'</a></p>
      ';
      return $inline_styles . $js;
    }

    return '';
  }


  /**
   * Loads the css file from the theme css folder if it exists, else uses the plugin version as fallback.
   * @return string
   */
  private function getPluginCss() {
    $plugincss = '/css/pi.tweets.css';
    if (file_exists($this->theme_root.$plugincss)) {
      return file_get_contents($this->theme_root.$plugincss);
    } else {
      return file_get_contents(dirname(__FILE__).$plugincss);
    }
  }

  /**
   * Returns the path of this plugin folder.
   * @return string
   */
  private function getPluginPath() {
    $plugindir = basename(dirname(__FILE__));
    $parentdir = basename(dirname(dirname(__FILE__)));
    $pluginpath = Statamic_helper::reduce_double_slashes($this->site_root.'/'.$parentdir .'/' . $plugindir."/");

    return $pluginpath;
  }
}
