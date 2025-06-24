<?php

// サイトのルートまでの相対パス
$root_path = preg_replace('|/[^/]+|', '../', preg_replace('|/[^/]+.php$|', '', $_SERVER['SCRIPT_NAME']));

// commonディレクトリまでの相対パス
$common_dir = $root_path . 'common/';

// CSSや画像などのディレクトリ
$assets_dir = 'assets/';
