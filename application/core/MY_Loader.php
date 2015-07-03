<?php
//custom template engine
class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {
      /*$CI = &get_instance();
      $CI->rssparser->set_feed_url(FCPATH . 'assets/rss/recentAdditions.xml');  // get feed
      $CI->rssparser->set_cache_life(30);                            // Set cache life time in minutes
      $rss = $CI->rssparser->getFeed(20);                            // Get six items from the feed
      $page = "<ul>";
      foreach($rss as $article)
      {
        //die(var_dump($article));

        $title = $article["title"];
        $desc  = $article["description"];
        $link  = $article["link"];
        $page .= "<li>"."\n";
        if($link != "")
          $page .= "<a href=\"$link\" class=\"rsslink\">-$title-</a>"."\n".
                    "<div>$desc</div>"."\n";
        else
          $page .= "<span class=\"rsslink\">-$title-</span>"."\n".
                   "<div>$desc</div>"."\n";
        $page .= "</li>"."\n";
      }

      $page .="</ul>\n";*/
        $content = $this->view('templates/header', $vars).
                   $this->view('templates/scripts').
                   $this->view('templates/navbar',$vars).
                   $this->view($template_name, $vars, $return).
                   $this->view('templates/footer');
        if($return)
            return $content;
    }
}
//END OF MY LOADER