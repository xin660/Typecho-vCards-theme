<?php 
/**
 * 说说
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/header.php');
?>
<?php $this->need('layout/sidebar.php'); ?>
<div class="col-12 col-md-12 col-lg-10 col_12" id='pjax'>
	<div class="box box-content">
		<div class="pb-2">
			<h1 class="title title--h1 first-title title__separate">[动态]</h1>
		</div>
		<?php function threadedComments($comments, $options) {
			$commentClass = '';$group = '';
				if ($comments->authorId) {
					if ($comments->authorId == $comments->ownerId) {
						$group = '博主';
							$commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
						} else {
							$group = '游客';
							$commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
						}
					} 
			$commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
		?>
		<li id="li-<?php $comments->theId(); ?>" class="
			<?php 
			if ($comments->levels > 0) {
				echo ' comment-child';
				$comments->levelsAlt(' comment-level-odd', ' comment-level-even');
			} else {
				echo ' comment-parent';
			}
			$comments->alt(' comment-odd', ' comment-even');
			echo $commentClass;
			?> comment-box">
			<div id="<?php $comments->theId(); ?>">
				<div class="comment-box__inner-dt">
					<svg class="avatar avatar--60">
						<g class="avatar__hexagon">
							<image xlink:href="<?php ParseAvatar($comments->mail); ?>s=100" height="100%" width="100%" />
						</g>
					</svg>
					<div class="cross__body">
						<h5 class="comment-box__details">
						<span><?php $comments->author(); ?><span class="badge"><?php echo $group; ?></span></span> 
						</h5>
						<div class="comm-content-dt">
						<?php echo reEmo($comments->content); ?>
						<ul class="comment-box__footer">
							<li><span class="comment-box__details-date"><?php echo timesince($comments->created);?></span></li>
							<li> <span><?php GetOs($comments->agent); ?> · <?php GetBrowser($comments->agent); ?></span></li>
						</ul>
						</div>
						
					</div><!-- 单条评论者信息及内容 -->
				</div>
			</div>
			<?php if ($comments->children) { ?>
				<div class="comment-children">
					<?php $comments->threadedComments($options); ?>
				</div>
			<?php } ?>
		</li>
		<?php } ?>
		<?php $this->comments()->to($comments); ?>

		<?php if($this->allow('comment')): ?>
			<div id="<?php $this->respondId(); ?>">
				<div class="cancel-comment-reply">
					<span class="response">
							<span class="cancel-reply" class="margin-left: 1rem;">
							
							</span>
					</span>
				</div>
				<?php if($this->user->hasLogin()): ?>
				<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" class="comment-form">
					
						<ul class="social-auth">
									<li class="social-auth__item"><?php _e('登录身份: '); ?></li>
									<li class="social-auth__item"><a class="social-auth__link" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a></li>
									<li class="social-auth__item"><a class="social-auth__link" href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></li>
						</ul>
						<textarea rows="5" cols="0" name="text" id="textarea" class="textarea form-control OwO-textarea" required="required" placeholder="请输入评论内容..."></textarea>
						<button type="submit" class="btn"><i class="font-icon icon-send"></i></button>
						<div class="dropdown dropup OwO"></div>	
						 
					
				</form>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="v-comment" >
			<?php if ($comments->have()): ?>
				<div class="cross">
				<?php $comments->listComments(); ?>
				</div>
				<div class="page-navigator">
				<?php $comments->pageNav('<', '>', 1, ''); ?>
				</div>
			<?php else: ?>
				<h3 class="vcount" style="text-align: center;"><?php if($this->allow('comment')): ?> 暂无动态 &gt;_&lt; <?php else: ?> 动态已关闭 &gt;_&lt; <?php endif; ?></h3>
			<?php endif; ?>	
		</div>

		<script src="<?php $this->options->themeUrl('assets/owo/OwO.min.js'); ?>"></script>
		<script>
			var OwO_demo = new OwO({
				logo: '<i class="font-icon icon-smile"></i>',
				container: document.getElementsByClassName('OwO')[0],
				target: document.getElementsByClassName('OwO-textarea')[0],
				api: '<?php $this->options->themeUrl('assets/owo/OwO.json'); ?>',
				position: 'down',
				width: '100%',
				maxHeight: '250px'
			});
		</script>
	</div>
	<?php $this->need('layout/footer.php'); ?>


	