<?php 
/**
 * 语录
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/header.php');
?>

<?php $this->need('layout/sidebar.php'); ?>
<div class="col-12 col-md-12 col-lg-10 col_12" id='pjax'>
	<header class="header-post">
        <div class="header-post__image-wrap">
            <div class="header-post-news-item__con">
                <p itemprop="name headline" style="text-shadow: 0 0 5px #000; font-size: 1.5rem;margin-bottom: 3rem;">
                    <?php $this->title() ?>
                </p>
            </div>
            <?php if($this->options->slimg && 'guanbi'==$this->options->slimg): ?>
            <?php else: ?>
            <?php if($this->options->slimg && 'showoff'==$this->options->slimg): ?>
            <?php else: ?>
            <img class="header-post-news-item-image" src="<?php showThumbnail($this); ?>" alt="">
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </header>
	<div class="box box-content" style="border-radius:0 0 20px 20px;">

				<?php function threadedComments($comments, $options) {
					$commentClass = '';$group = '';
					if ($comments->authorId) {
						if ($comments->authorId == $comments->ownerId) {
							$group = '博主';
							$commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
						} else {
							$group = '';
							$commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
						}
					} 
					$commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
				?>


											

				<li id="li-<?php $comments->theId(); ?>" class="<?php 
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
						<div class="comment-box__body">
								    <div class="swiper-slide review-item" style="border-radius: 10px;">
										<div class="review-item__textbox">
											<h4 class="title title--h5" style="font-size: 1rem;font-weight: unset;"><?php echo reEmo($comments->content); ?></h4>
											<p class="review-item__caption"></p>
									    </div>
									</div>
						</div><!-- 单条评论者信息及内容 -->
					</div>
					</div>



					<?php if ($comments->children) { ?>
						<div class="comment-children">
							<?php $comments->threadedComments($options); ?>
						</div>
					<?php } ?>


					<!--  -->
					</li>

				<?php } ?>


					<?php if($this->allow('comment')): ?>


				<div id="comments" >
					<?php $this->comments()->to($comments); ?>
						<div id="<?php $this->respondId(); ?>" class="respond-dt">
							<div class="cancel-comment-reply">
								<span class="response">
										<span class="cancel-reply" class="margin-left: 1rem;">
											<?php $comments->cancelReply(); ?>
										</span>
								</span>
							</div>
						

							<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" class="comment-form">
								<?php if($this->user->hasLogin()): ?>
									<ul class="social-auth">
												<li class="social-auth__item"><?php _e('登录身份: '); ?></li>
												<li class="social-auth__item"><a class="social-auth__link" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a></li>
												<li class="social-auth__item"><a class="social-auth__link" href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></li>
									</ul>
									<textarea rows="5" cols="0" name="text" id="textarea" class="textarea form-control OwO-textarea" required="required" placeholder="请输入评论内容..."></textarea>
												<button type="submit" class="btn"><i class="font-icon icon-send"></i></button>
												<div class="dropdown dropup OwO"></div>	
								<?php else: ?>
									
								
								<?php endif; ?>
							</form>
						</div>

						<?php if ($comments->have()): ?>

							<div class="cross">
								<?php $comments->listComments(); ?>
							</div>
							<div class="page-navigator">
                <?php $comments->pageNav('<', '>', 1, ''); ?>
            				</div>
						<?php endif; ?>
							<?php else: ?>
								<h3><?php _e('动态已关闭'); ?></h3>
							<?php endif; ?>
				</div>


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
	<?php $this->need('layout/footer.php'); ?>