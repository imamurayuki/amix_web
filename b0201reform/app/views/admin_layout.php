<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理画面|物件管理</title>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>/css/admin/import.css" />
</head>
<body id="AdminUsers" class="normal">
<div id="page">
  <div id="gradationShadow">

    <div id="header">
      <div id="headMain">
      </div>
      <div id="glbMenus">
        <h2 class="display-none">グローバルメニュー</h2>
        <ul class="global-menu clearfix">
          <li class="first menu01">
            <a href="<?php echo $base_url . '/admin' ?>">物件管理</a> 
          </li>
          <li class="last menu02">
            <a href="<? echo $base_url . '/admin/users' ?>">ユーザー管理</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- end header -->
		
    <div id="contents">
      <div id="navigation" class="clearfix">
        <div id="pankuzu">
          <a href="<?php echo $base_url . '/admin'?>">管理画面トップ</a> 
          <?php 
          if (isset($crumb)) {
              echo '&gt;' . $crumb;
          } ?>
<!--
<a href="/admin/users/index" 0="0">ユーザー管理</a> &gt; <strong>ユーザー一覧</strong>				
-->
        </div>
        <div id="loginUser">
          <a href="<?php echo $base_url . '/admin/logout' ?>">ログアウト</a>				
        </div>
      <!-- end navigation --></div>
						
      <div id="contentsBody">
        <?php echo $_content; ?>
      <!-- end contentsBody --></div>
    
      <div class="to-top"> <a href="#page">このページの先頭へ戻る</a> </div>
    <!-- end contents --></div>
    
    <!-- begin footer -->
    <div id="footer">
      <p id="copyright">Copyright &copy; 2010 Amix Co.,Ltd. All Rights Reserved.</p>
    <!-- end footer --></div>

  <!-- end gradationShadow --></div>
</div>
<!-- end page -->
</body>
