<?php
/**
 * @author      Daniel Kesberg <kesberg@ebene3.com>
 * @copyright   (c) 2013, ebene3 GmbH
 */

return array(
    'paths' => array(
        'fonts'             => 'storage/font',
        'backgrounds'       => 'storage/backgrounds',
        'data'              => 'storage/data',
        'application_log'   => 'storage/log/application.log',
        'server_log'        => '/home/starbound-server/Steam/SteamApps/common/Starbound/linux64/starbound_server.log'
    ),
    'data' => array(
        'usercount' => 'usercount.txt'    
    ),
    'image' => array(
        'font'  => '04b_03/04B_03__.TTF',
        'background' => 'default_600.png',
        'format' => 'png',
        'labels' => array(
            'usercount' => array(
                'text'  => '{usercount}',
                'color' => '#fff',
                'size'  => 30,
                'x'     => 290,
                'y'     => 170
            ),
            'timestamp' => array(
                'format' => 'H:i:s d.m.Y',
                'text'  => 'Last Update: {timestamp}',
                'color' => '#fff',
                'size'  => 10,
                'x'     => 194,
                'y'     => 228
            )
        )
    )    
);
