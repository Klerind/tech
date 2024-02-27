<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Storage;

class ScraperController extends Controller
{

  public static function show()
  {
    // Storage::move('img.jpg', '/var/www/html/laravel_blog000/img.jpg');
     //Storage::disk('local')->put('img.jpg');
     $contents = Storage::get('index.jpeg');
     $url = Storage::url('index.jpg');

  //   dd($url = Storage::url('index.jpeg'));
     $client = new Client();
     $website = $client->request('GET', 'https://www.dua.com');
  //   $htmlString = (string) $website->getBody();

   // HTML is often wonky, this suppresses a lot of warnings
   libxml_use_internal_errors(true);
   $html = file_get_contents('https://www.dua.com');
/*
   $dom = new DOMDocument();
   $dom->loadHTML($html);
   $lis = $dom->getElementsByTagName("li");
   $index = 0;
   foreach ($lis as $li) {
       $index++;
       $value = (string) $li->nodeValue;
       dump($value);
       if ($value == "Result 4") {
           echo $index;
       }
   } */
    // $link = $website->selectLink('Funksionet')->link();

     $link = $website->selectLink('Features');
  //   dd($link->attr('href'));

     $html = file_get_contents('https://www.dua.com');
     $start = stripos($html, '<div>');
     $end = stripos($html, '</div>', $offset = $start);
     $length = $end - $start;
     $htmlSection = substr($html, $start, $length);
     preg_match_all('@<body>(.+)</body>@', $html, $matches);

     $nows = $website->filter('a')->each(function ($node)
     {
      // dd($node);
      // return $node;
     });

     return '<a href='. $link->attr('href') . '>Features</a>';
    // return $nows[3]->html();
    // return $website->html();
     return $link->html();

  }

}
