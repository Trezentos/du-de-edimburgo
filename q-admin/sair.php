<?php
require("config.php");
$userClass->logout();
header("Location: login.php");