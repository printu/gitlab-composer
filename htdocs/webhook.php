<?php

namespace GitlabComposer;

require __DIR__.'/../vendor/autoload.php';
$confs = (new Config())->getConfs();
$a = new AuthWebhook();
$a->setConfig($confs);
$a->auth();

// respond to weebhook
fastcgi_finish_request(); //this returns 200 to the user, and processing continues

$Cr = new RegistryBuilder();
$Cr->setConfig($confs);
$Cr->update();
