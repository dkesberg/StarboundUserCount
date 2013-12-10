<?php
/**
 * @author      Daniel Kesberg <kesberg@ebene3.com>
 * @copyright   (c) 2013, ebene3 GmbH
 */

require_once __DIR__ .'/../vendor/autoload.php';

// load config
$config = require_once __DIR__ . '/../app/config/app.php';

$pathData       = __DIR__ . '/../' . $config['paths']['data'] . '/' . $config['data']['usercount'];
$pathBackground = __DIR__ . '/../' . $config['paths']['backgrounds'] . '/' . $config['image']['background'];
$pathFont       = __DIR__ . '/../' . $config['paths']['fonts'] . '/' . $config['image']['font'];

// check for data file
if (!is_file($pathData)) {
    die($pathData.'Data file not found.');
}

// usercount
if (isset($config['image']['labels']['usercount'])) {

    $usercount = file_get_contents($pathData);
    if ($usercount !== false) {
        $config['image']['labels']['usercount']['text'] = str_replace('{usercount}', trim($usercount), $config['image']['labels']['usercount']['text']);        
    } else {
        die('Could not read data file.');
    }
}

// timestamp
if (isset($config['image']['labels']['timestamp'])) {
    $timestamp = date($config['image']['labels']['timestamp']['format'], filemtime($pathData));
    $config['image']['labels']['timestamp']['text'] = str_replace('{timestamp}',$timestamp, $config['image']['labels']['timestamp']['text']);
}

// build image
$imagine        = new \Imagine\Gd\Imagine();
$image          = $imagine->open($pathBackground);

// add labels
foreach ($config['image']['labels'] as $label) {
    $font = new \Imagine\Gd\Font($pathFont, $label['size'], new \Imagine\Image\Color($label['color']));
    $image->draw()->text(
        $label['text'],
        $font,
        new \Imagine\Image\Point($label['x'], $label['y'])
    );
}

// display
$image->show($config['image']['format']);

