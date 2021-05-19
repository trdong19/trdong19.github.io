<?php
/**
 * 一切从心出发，从零开始，只为让您的站点拥有速度与优雅兼具的极致体验。
 *
 * @package splity
 * @author 小灯泡设计
 * @version 1.6.0
 * @link http://www.dpaoz.com
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>	
<!--幻灯片s-->	
<?php $this->need('index - hd.php'); ?>
<!--幻灯片e-->
  <main class="py-3  pt-md-4 pb-md-5">
  <div class="container">
  <div class="row no-gutters">
  <div class="col-lg-8">
<!--正常列表样式s-->

<?php $this->need('index - post.php'); ?>

<!--正常列表样式e-->
<!--加载s-->

<?php $this->pageLink('加载更多','next'); ?>

</div>

<!--右边栏样式s-->
					
<?php $this->need('sidebar.php'); ?>

<!--右边栏样式e-->

</div>
</div>
	</main>	

<!--底部样式s-->

<?php $this->need('footer.php'); ?>