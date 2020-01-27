<?php
$array = array();
$regex = '/<a href="(.+)">/';

function find_flag($base_url)
{
  global $array;
  global $regex;

  $content = file_get_contents($base_url);
  preg_match_all($regex, $content, $matches);
  $urls = $matches[1];

  foreach($urls as $url) 
  {
    if ($url == "../")
      continue ;
    if ($url == "README")
    {
      $c = file_get_contents($base_url.$url);
      if ( !in_array($c, $array) )
      {
        print_r($base_url.$url." => ".$c);
        $array[$c] = $c;
      }
    }
    else
    {
      find_flag($base_url.$url);
    }
  }
}
find_flag("http://MY_IP_ADRESS/.hidden/");
?>