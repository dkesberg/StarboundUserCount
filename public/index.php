<?php
/**
 * @author      Daniel Kesberg <kesberg@ebene3.com>
 * @copyright   (c) 2013, ebene3 GmbH
 */

require_once '../vendor/autoload.php';

// paths
$pathUsercount  = realpath('../app/storage/statistics/usercount.txt');
$pathBackground = realpath('../app/storage/backgrounds/default.png');
$pathFont       = realpath('../app/storage/font/hobo.ttf');

// read usercount
$userCount      = trim(file_get_contents($pathUsercount));
$lastUpdated    = 'Last Update: ' . date('H:i:s d.m.Y', filemtime($pathUsercount));

// make png
$imagine = new \Imagine\Gd\Imagine();
$image = $imagine->open($pathBackground);

$fontFile = $pathFont;
$fontColor =  new \Imagine\Image\Color('#fff');

$fontSizeCount  =  80;
$fontSizeTs     =  16;

$fontCount      = new \Imagine\Gd\Font($fontFile, $fontSizeCount, $fontColor);
$fontTimestamp  = new \Imagine\Gd\Font($fontFile, $fontSizeTs, $fontColor);

$image->draw()->text(
    $userCount,
    $fontCount,
    new \Imagine\Image\Point(474, 271)
);

$image->draw()->text(
    $lastUpdated,
    $fontTimestamp,
    new \Imagine\Image\Point(326, 382)
);

$image->show('png');

