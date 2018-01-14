<?php
        echo'<?xml version="1.0" encoding="utf-8"?>'; ?>
    <rss version="2.0"
            xmlns:content="http://purl.org/rss/1.0/modules/content/"
            xmlns:wfw="http://wellformedweb.org/CommentAPI/"
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:atom="http://www.w3.org/2005/Atom"
            xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
            xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
        <channel>
            <title>RP Interface</title>
            <atom:link href="<?= Config::get('URL') ?>game/rss" rel="self" type="application/rss+xml" />
            <link><?= Config::get('URL') ?></link>
            <description>Roleplay'in adresi.</description>
            <lastBuildDate><?= date("d M Y H:i:s",time()) ?></lastBuildDate>
            <language>tr-TR</language>
            <sy:updatePeriod>always</sy:updatePeriod>
            <sy:updateFrequency>1</sy:updateFrequency>
            <generator><?= Config::get('URL') ?></generator>
            <image>
                <url><?= Config::get('URL') ?>img/rprss.png</url>
                <title>RP Interface</title>
                <link><?= Config::get('URL') ?></link>
                <width>16</width>
                <height>16</height>
            </image> 
            <?php foreach($this->games as $game){ ?>
            <item>
		<title><?= $game->game_title ?></title>
		<link><?= Config::get('URL') ?>game/game/<?= $game->game_name ?></link>
		<pubDate><?= date("d M Y H:i:s",$game->game_creation_timestamp) ?></pubDate>
		<dc:creator><![CDATA[RP Interface]]></dc:creator>
                <category><![CDATA[frp]]></category>
                <category><![CDATA[game]]></category>
                <category><![CDATA[rpg]]></category>
                <description><![CDATA[<?= $game->game_description ?>]]></description>
            </item>
            <?php } ?>
        </channel>
    </rss>
