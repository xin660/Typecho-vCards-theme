<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

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
    <div class="comment-box__inner">
        <svg class="avatar avatar--60">
            <g class="avatar__hexagon">
                <image xlink:href="<?php ParseAvatar($comments->mail); ?>s=100" height="100%" width="100%" />
            </g>
        </svg>
        <div class="comment-box__body">
            <h5 class="comment-box__details">
            <span><?php $comments->author(); ?><span class="badge"><?php echo $group; ?></span></span> 
            <span style="font-size: 0.9375rem;"><?php $comments->reply('<i class="font-icon icon-reply"></i> 回复'); ?> </span>
            </h5>
            <div><?php echo getPermalinkFromCoid($comments->parent);echo preg_replace('#</?[p][^>]*>#','', reEmo($comments->content)); ?></div>
            <ul class="comment-box__footer">
                <li class="comment-box__details-date"> <?php echo timesince($comments->created);?></li>
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
        
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" class="comment-form">
        <?php $comments->cancelReply('
                    <svg class="vclose-icon" viewBox="0 0 1024 1024" width="24" height="24" style="
                    position: absolute;
                    right: 0;z-index: 999;
                ">
                        <path
                            d="M697.173 85.333h-369.92c-144.64 0-241.92 101.547-241.92 252.587v348.587c0 150.613 97.28 252.16 241.92 252.16h369.92c144.64 0 241.494-101.547 241.494-252.16V337.92c0-151.04-96.854-252.587-241.494-252.587z"
                            fill="currentColor"></path>
                        <path
                            d="m640.683 587.52-75.947-75.861 75.904-75.862a37.29 37.29 0 0 0 0-52.778 37.205 37.205 0 0 0-52.779 0l-75.946 75.818-75.862-75.946a37.419 37.419 0 0 0-52.821 0 37.419 37.419 0 0 0 0 52.821l75.947 75.947-75.776 75.733a37.29 37.29 0 1 0 52.778 52.821l75.776-75.776 75.947 75.947a37.376 37.376 0 0 0 52.779-52.821z"
                            fill="#fff"></path>
                    </svg>
                '); ?>
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
<?php endif; ?>

<div class="v-comment" >
    <?php if ($comments->have()): ?>
        <h2 class="title title--h3">Comments <span class="color--light">(<?php $this->commentsNum(_t('暂无评论'), _t('唉呀 ~ 仅有一条评论'), _t(' %d ')); ?>)</span></h2>
        <div id="comments" style="padding: 1rem;">
        <?php $comments->listComments(); ?>
        </div>
        <div class="page-navigator">
        <?php $comments->pageNav('<', '>', 1, ''); ?>
        </div>
    <?php else: ?>
        <h3 class="vcount" style="text-align: center;"><?php if($this->allow('comment')): ?> 暂无评论 &gt;_&lt; <?php else: ?> 评论已关闭 &gt;_&lt; <?php endif; ?></h3>
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
