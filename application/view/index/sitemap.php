<?php header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>'; 
    $freq = 'hourly';
    $game_priority = '0.70';
    $user_priority = '0.50';
    $time = date("Y-m-d",time());
    $pages = array();
        $pages[0] = new stdClass(); $pages[0]->url = 'index'; $pages[0]->priority = '1.00';
        $pages[1] = new stdClass(); $pages[1]->url = 'game'; $pages[1]->priority = '1.00';
        $pages[2] = new stdClass(); $pages[2]->url = 'login/register'; $pages[2]->priority = '0.80';
        $pages[3] = new stdClass(); $pages[3]->url = 'login'; $pages[3]->priority = '0.70';
        $pages[4] = new stdClass(); $pages[4]->url = 'profile'; $pages[4]->priority = '0.50';
?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <?php foreach($pages as $page){ ?>
    <url>
      <loc><?= Config::get('URL') . $page->url ?></loc>
      <changefreq><?= $freq ?></changefreq>
      <lastmod><?= $time ?></lastmod>
      <priority><?= $page->priority ?></priority>
    </url>
    <?php } ?>
    <?php foreach ($this->games as $game){ ?>
    <url>
      <loc><?= Config::get('URL') ?>game/game/<?= $game->game_name ?></loc>
      <changefreq><?= $freq ?></changefreq>
      <lastmod><?= date("Y-m-d",$game->game_creation_timestamp) ?></lastmod>
      <priority><?= $game_priority ?></priority>
    </url>    
    <?php } ?>
    <?php foreach ($this->users as $user){ ?>
    <url>
      <loc><?= Config::get('URL') ?>profile/user/<?= $user->user_name ?></loc>
      <changefreq><?= $freq ?></changefreq>
      <lastmod><?= date("Y-m-d",$user->user_creation_timestamp) ?></lastmod>
      <priority><?= $user_priority ?></priority>
    </url>    
    <?php } ?>
</urlset>