<?php

// データベース定数初期化
define("DB_HOST", "localhost"); ### DB ホスト
define("DB_USER", ""); ### DB ユーザ
define("DB_PASSWORD", ""); ### DB パス
define("DB_NAME", ""); 

// ディレクトリ定数初期化
define("DIR_BACKUP", "./bak/");

// バックアップ先ディレクトリがなければ作成する。
if (!(file_exists(DIR_BACKUP) && is_dir(DIR_BACKUP))) {
    mkdir(DIR_BACKUP);
}

// バックアップファイル名
$strBackupFileName = date("YmdHis") . ".sql";

// ダンプコマンド作成
$strCommand = "mysqldump ";
$strCommand .= "-h " . DB_HOST . " ";
$strCommand .= "-u " . DB_USER . " ";
$strCommand .= "-p" . DB_PASSWORD . " ";
$strCommand .= DB_NAME . " ";
$strCommand .= "> " . DIR_BACKUP . $strBackupFileName . " ";
$strCommand .= "2> mysqldump_error.txt";

// 実行
$lngLastLine = system($strCommand);

//ファイルが作成されていればOK
if (file_exists("./bak/" . $strBackupFileName) && filesize("./bak/" . $strBackupFileName) > 0) {
    print "*********** バックアップ OK ***********";
} else {
    print "***********  バックアップ NG ***********";
}

//================= ZIP 圧縮 & パスワード付与

//zip ファイル名を決定します
$strBackupZipFileName = date("YmdHis") . ".zip";

echo exec("cd 'bak/'; zip -P 'ttt' '" . $strBackupZipFileName . "' '" . $strBackupFileName . "';");

//元のバックアップファイルを削除しておきます
// unlink($strBackupFileName);
