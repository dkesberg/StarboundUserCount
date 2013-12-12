<?php
/**
 * @author      Daniel Kesberg <kesberg@ebene3.com>
 * @copyright   (c) 2013, Daniel Kesberg
 */

ini_set('display_errors', false);

$parseTimeStart = microtime();

// load config
// Set paths.log to the full path of the log file
$config = array(
    'server'    => array(
        'hostname'  => '127.0.0.1',
        'port'      => 21025
    ), 
    'paths'     => array(
        'log' => '/home/starbound-server/Steam/SteamApps/common/Starbound/linux64/starbound_server.log'
    )
);

// read logfile
$log = file_get_contents($config['paths']['log']);

// split into lines
$logLines = explode("\n", $log);

// only keep lines with client info
$logClients = array_filter($logLines, function($line) {
   return preg_match('/^Info:.*<User/', $line);
});

// extract clients
$clients = array();
foreach ($logClients as $line) {
    $tmp = explode('<User: ', $line);
    $tmp = str_replace('>','', $tmp[1]);
    $tmp = explode(' ', $tmp);
    
    if (count($tmp) == 2) {
        $clients[$tmp[0]] = $tmp[1];
    }
}

// only keep "connected" status
$clients = array_filter($clients, function($status) {
    return $status == 'connected';    
});

// get server version
$logVersion = array_filter($logLines, function($line) {
    return preg_match('/^Info: Server version/', $line);
});

// only look at the last line
$logVersion = end($logVersion);
$tmp = explode("'", $logVersion);
$logVersion = $tmp[1];

// server is running ?
// edit: removed shell cmd, stole fsockopen from https://gist.github.com/lagonnebula/7928214 ;)
$fp = fsockopen($config['server']['hostname'], $config['server']['port'], $errno, $errstr, 30);
if ($fp){
    $serverIsRunning = 1;
    fclose($fp);
} else {
    $serverIsRunning = 0;
}

// output
?>
<html>
<head>
    <title>Starbound Server Info</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <style type="text/css">
        body {
            padding-top: 70px;
        }
        table > tbody > tr > td.server-status {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Starbound Server Info</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Server</div>
                <div class="panel-body">
                    <table class="table table-condensed table-bordered">
                        <tbody>
                        <tr>
                            <th>Status</th>
                            <td class="server-status">
                                <span class="label label-<?= ($serverIsRunning == 1) ? 'success' : 'danger' ; ?>">
                                <?= ($serverIsRunning == 1) ? 'Online' : 'Offline' ; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Version</th>
                            <td><?= $logVersion; ?></td>
                        </tr>
                        <tr>
                            <th>Players Online</th>
                            <td><?= count($clients); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Players</div>
                <div class="panel-body">
                    <?php if (count($clients)): ?>    
                    <table class="table table-condensed table-bordered">
                        <thead>
                        <tr>
                            <th>Playername</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($clients as $client => $status): ?>
                        <tr>
                            <td>
                                <?= $client; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        No active players
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <span class="label label-default">
                Parse time: <?= microtime() - $parseTimeStart; ?> seconds.
            </span>
        </div>
    </div>
</div>
</body>
</html>



