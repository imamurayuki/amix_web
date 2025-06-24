<h2>管理システムログイン</h2>
<div id="login">
  <div class="box-01">
    <div class="box-head">
      <h3>アカウント／パスワードを入力して下さい</h3>
    </div>
    <div class="box-body"> 
    <form id="UserLoginForm" method="post" action="<?php echo $base_url ?>/admin/login">
      <input type="hidden" name="_token" value="<?php echo $this->escape($_token) ?>" />
      <table border="0">
        <tr>
          <td style="text-align:right">アカウント&nbsp;</td>
          <td style="text-align:left"><input name="name" type="text" size="20" value="<?php echo $name ?>" id="UserName" />
            <?php echo $this->error($errors, 'name'); ?>
          </td>
        </tr>
        <tr>
          <td style="text-align:right">パスワード&nbsp;</td>
          <td style="text-align:left"><input type="password" name="password" size="20" value="" id="UserPassword" />
            <?php echo $this->error($errors, 'password'); ?>
          </td>
        </tr>
      </table>
      <br />
      <br />
      <p> 
        <input type="submit" class="btn-red button" value="　ログインする　" />
      </p>
    </form> 
    </div>
    <div class="box-foot"> &nbsp;</div>
  </div>
</div>
