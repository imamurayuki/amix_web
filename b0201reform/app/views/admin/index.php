<h2>物件一覧</h2>

<?php if (count($buildings) > 0): ?>
<!-- pagination -->
<div class="pagination">
  <div class="page-result">結果：　<?php echo ($page - 1) * $displayCount + 1 ?>～<?php echo $page * $displayCount ?> 件 ／ 総件数：　<?php echo $count ?>件</div>
  <div class="page-numbers">
    <?php if ($page == 1): ?>
    <span class="disabled">&lt;&lt;</span>
    <?php else: ?>
    <span><a href="<?php echo $base_url . '/admin/index/'. ($page - 1) ?>">&lt;&lt;　</a></span>
    <?php endif; ?>
    <?php
     for ($i = 1; $i <= $pageNumber; $i++) {
         if ($page == $i) {
             echo '<span class="current">' . $i . '</span>' . (($i != $pageNumber) ? ' | ' : '');
         } else {
             $url = $base_url . '/admin/index/' . $i;
             echo "<span><a href=\"{$url}\">{$i}</a></span>" . (($i != $pageNumber) ? ' | ' : '');
         }
     }
    ?>
    <?php if (($pageNumber != 1 && $page == $pageNumber) || ($displayCount > count($buildings))): ?>
    <span class="disabled">&gt;&gt;</span>
    <?php else: ?>
    <span class="disabled">&gt;&gt;</span>
    <span>　<a href="<?php echo $base_url . '/admin/index/'. ($page + 1) ?>">&gt;&gt;</a></span>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>

<table cellpadding="0" cellspacing="0" class="admin-col-table-01" id="TableUsers">
  <tr>
    <th>物件</th>
    <th>公開状況</th>
    <th>外観/内装</th>
    <th>作成日付</th>
    <th>操作</th>
  </tr>
  <?php if (!empty($buildings)): ?>
  <?php $i = 0; foreach ($buildings as $building): ?>
<?php
     $color = '';
     if ($i++ % 2 == 0) {
         $color = ' class="altrow"';
         if ($building['status'] == 3 || empty($building['status'])) {
            $color = ' class="disablerow"';   
         }
     } else {
         if ($building['status'] == 3 || empty($building['status'])) {
            $color = ' class="disablerow"';   
         }
     }
?>
  <tr<?php echo $color; ?>>
    <td>
      <a href="<?php echo $base_url . '/admin/edit/' . $building['id'] ?>">
        <?php echo $this->escape($building['name']); ?></a>
    </td>
    <td>
    <?php 
     switch ($building['status']) {
       case 1:
           echo 'トップ';
       break;
       case 2:
           echo '過去フォルダ';
       break;
       default:
           echo '非公開';
     }
    ?>
    </td>
    <td><?php
	 if ($building['is_interior'] == 1 ) {
		 echo '内装';
	 } else if ($building['is_interior'] == 2 ) {
		 echo 'その他';
	 } else {
		 echo '外観';
	 } ?></td>
    <td><?php echo date('Y年m月d日', strtotime($building['created_at'])) ?></td>
    <td class="operation-button">
      <a href="<?php echo $base_url ?>/admin/edit/<?php echo $building['id'] ?>" class="btn-blue01-s button01-s">編集</a>
      <a href="<?php echo $base_url ?>/admin/delete/<?php echo $building['id'] ?>" class="btn-gray-s button-s" 
         onclick="return confirm(&#039;物件 を本当に削除してもいいですか？&#039;);">削除</a>
      <a href="<?php echo $base_url ?>/admin/desc/<?php echo $building['id'] ?>" class="btn-blue02-s button02-s">記事一覧</a>
    </td>
  </tr>
  <?php endforeach; ?>
  <?php endif; ?>
</table>

<?php if (count($buildings) > 0): ?>
<div class="pagination">
<div class="page-result">結果：　<?php echo ($page - 1) * $displayCount + 1 ?>～<?php echo $page * $displayCount ?> 件 ／ 総件数：　<?php echo $count ?>件</div>
  <div class="page-numbers">
    <?php if ($page == 1): ?>
    <span class="disabled">&lt;&lt;</span>
    <?php else: ?>
    <span><a href="<?php echo $base_url . '/admin/index/'. ($page - 1) ?>">&lt;&lt;　</a></span>
    <?php endif; ?>
    <?php
     for ($i = 1; $i <= $pageNumber; $i++) {
         if ($page == $i) {
             echo '<span class="current">' . $i . '</span>' . (($i != $pageNumber) ? ' | ' : '');
         } else {
             $url = $base_url . '/admin/index/' . $i;
             echo "<span><a href=\"{$url}\">{$i}</a></span>" . (($i != $pageNumber) ? ' | ' : '');
         }
     }
    ?>
    <?php if (($pageNumber != 1 && $page == $pageNumber) || ($displayCount > count($buildings))): ?>
    <span class="disabled">&gt;&gt;</span>
    <?php else: ?>
    <span>　<a href="<?php echo $base_url . '/admin/index/'. ($page + 1) ?>">&gt;&gt;</a></span>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>

<div class="align-center">
  <a href="<?php echo $base_url ?>/admin/add" class="btn-red button">新規登録</a>
</div>
