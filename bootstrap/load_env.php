<?php

function load(string $path) {
  $envFile = fopen("$path/.env", "r") or die(".env file is not found");
  $envStr = fread($envFile,filesize("$path/.env"));
  fclose($envFile);
  $arrEnv = explode("\n", $envStr);
  if (count($arrEnv) > 0) {
    foreach($arrEnv as $str) {
      // Skip empty lines and comments
      $str = trim($str);
      if (empty($str) || strpos($str, '#') === 0) {
        continue;
      }
      
      // Validate the environment variable format
      if (strpos($str, '=') !== false) {
        putenv($str);
      }
    } 
  }
}
