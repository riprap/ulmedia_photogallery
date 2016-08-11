<?php
$applicationFiles = array_diff(scandir(APPLICATION_PATH), array('..', '.', 'views'));

foreach ($applicationFiles as $file) {
	require_once(APPLICATION_PATH . '/' . $file);
}