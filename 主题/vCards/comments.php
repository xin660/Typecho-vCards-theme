<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

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
    <!--  -->

    <?php
            /* 评论QQ邮箱QQ头像
            */
            $host = '//sdn.geekzu.org/';  //gravatar第三方
            $reg = "/^\d{5,11}@[qQ][Qq]\.(com)$/";  //QQ数字邮箱
            $mail = $comments->mail;  //评论者邮箱
            //判断是否为数字QQ邮箱
            if (preg_match($reg, $mail)) {
                $img = explode("@", $mail); // 截取数字
                // 拼接
                $avatar = "//q2.qlogo.cn/headimg_dl?dst_uin={$img[0]}&spec=100";
                } else {
                // gravatar头像
                if (!empty($mail)) {
                $hash = md5(strtolower(trim($mail)));
                }
                $url = '/avatar/';
                $size = '80';
                $rating = Helper::options()->commentsAvatarRating;
                $hash = md5(strtolower($comments->mail));
                $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
            }
            ?>

    <div id="<?php $comments->theId(); ?>">
    <div class="comment-box__inner">
		<svg class="avatar avatar--60">
            <g class="avatar__hexagon">
                <image xlink:href="<?php echo $avatar ?>" height="100%" width="100%" />
            </g>
        </svg>
        <div class="comment-box__body">
            <h5 class="comment-box__details">
			<span><?php $comments->author(); ?><span class="badge"><?php echo $group; ?></span></span> 
			<span class="comment-box__details-date"><?php echo timesince($comments->created);?></span>
            </h5>
            <div><b><?php echo getPermalinkFromCoid($comments->parent); ?></b></div>
			<p><?php echo reEmo($comments->content); ?></p>
			<ul class="comment-box__footer">
				<li><i class="font-icon icon-like-fill"></i> <span>80</span></li>
				<li><i class="font-icon icon-reply"></i> <span><?php $comments->reply(); ?> </span></li>
                <li> <span><?php GetOs($comments->agent); ?> · <?php GetBrowser($comments->agent); ?></span></li>
			</ul>
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
    

        <h2 class="title title--h3">Comments <span class="color--light">(<?php $this->commentsNum(_t('暂无评论'), _t('唉呀 ~ 仅有一条评论'), _t(' %d ')); ?>)</span></h2>
        <div id="<?php $this->respondId(); ?>" class="respond">
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
                    <div class="row">
				                <div class="form-group col-12 col-md-4">
								<input type="text" name="author" id="author" class="form-control" placeholder="* 怎么称呼" autocomplete="on" oninvalid="setCustomValidity('Fill in the field')" value="<?php $this->remember('author'); ?>" required />
								    <div class="help-block with-errors"></div>
				                </div>
				                <div class="form-group col-12 col-md-4">
								<input type="email" name="mail" id="mail" lay-verify="email" class="form-control" placeholder="<?php if ($this->options->commentsRequireMail): ?>* <?php endif; ?>邮箱(放心~会保密~.~)" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> autocomplete="on" oninvalid="setCustomValidity('Fill in the field')" required<?php endif; ?> />
								    <div class="help-block with-errors"></div>
				                </div>
								<div class="form-group col-12 col-md-4">
								<input type="url" name="url" id="url" lay-verify="url" class="form-control" placeholder="<?php if ($this->options->commentsRequireURL): ?>* <?php endif; ?><?php _e('http://您的主页'); ?>" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> autocomplete="on" oninvalid="setCustomValidity('Fill in the field')" required<?php endif; ?> />
								    <div class="help-block with-errors"></div>
				                </div>
					</div>
                                <textarea rows="5" cols="0" name="text" id="textarea" class="textarea form-control OwO-textarea" required="required" placeholder="请输入评论内容..."></textarea>
								<button type="submit" class="btn"><i class="font-icon icon-send"></i></button>
								<div class="dropdown dropup OwO"></div>		
                
                                <?php endif; ?>
            </form>
        </div>

        <?php if ($comments->have()): ?>
            <br/>
            <h3><?php $this->commentsNum(_t('暂无评论'), _t('唉呀 ~ 仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
            <br/>
            <div class="pinglun">
                <?php $comments->listComments(); ?>
            </div>

            <div class="page-navigator">
                <?php $comments->pageNav('<', '>', 1, ''); ?>
            				</div>


        <?php endif; ?>
            <?php else: ?>
                <h3><?php _e('评论已关闭'); ?></h3>
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
