<?php

require './app/bootstrap.php';
require './app/BuildingsApplication.php';

$app = new BuildingsApplication(false);
$app->run();
