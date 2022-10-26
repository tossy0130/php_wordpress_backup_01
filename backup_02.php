
<?php

ini_set('display_errors', "On");

//コマンド
$command =  "tar czvf /home/****/*******/public_html/test/backup.tar.gz /home/********/*************/public_html/php_wordpress_backup/";
//実行
exec($command);
?>