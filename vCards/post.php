<?php 
//  判断是否是点赞的 POST 请求
if (isset($_POST['agree'])) {
    //  判断 POST 请求中的 cid 是否是本篇文章的 cid
    if ($_POST['agree'] == $this->cid) {
        //  调用点赞函数，传入文章的 cid，然后通过 exit 输出点赞数量
        exit(agree($this->cid));
    }
    //  如果点赞的文章 cid 不是本篇文章的 cid 就输出 error 不再往下执行
    exit('error');
}

?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>

<?php $this->need('layout/sidebar.php'); ?>
<div class="col-12 col-md-12 col-lg-10 col_12" id='pjax'>
    <header class="header-post">
        <div class="header-post__image-wrap">
            <div class="news-item__sort"><span style="color:#fff;">
                    <?php $this->category('.'); ?>
                </span></div>
            <div class="news-item__date">
                <span>
                    	<?php $this->date('Y-m-d'); ?>
                </span>
            </div>
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

        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">

            <div class="caption-post" itemprop="articleBody">
                <?php
                $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
                $replacement = '<a href="$1" data-fancybox="gallery"  ><img src="$1" alt="'.$this->title.'" title="点击放大图片" ></a>';
                $content = preg_replace($pattern, $replacement, $this->content);
                echo $content;
            ?>
            </div>

            <p itemprop="keywords" class="tags">
                <?php _e('#标签: '); ?>
                <?php $this->tags(', ', true, 'none'); ?>
            </p>
        </article>


        
        <div class="dianzan text-center">
        <?php $agree = $this->hidden?array('agree' => 0, 'recording' => true):agreeNum($this->cid); ?>   
                <button class="" 
                <?php echo $agree['recording']?'disabled':''; ?> type="button" id="agree-btn" data-cid="<?php echo $this->cid; ?>" data-url="<?php $this->permalink(); ?>">
                <i class="font-icon icon-like-fill"></i>
                <span class="agree-num"><?php echo $agree['agree']; ?></span> 
                </button>
        </div>
        
        
        <div class="post_end">- THE END -</div>
        <!--     <footer class="footer-post">
 
        <a class="footer-post__share" href="http://facebook.com"><i class="font-icon icon-facebook"></i><span _msthash="2658461" _msttexthash="10556117">脸谱网</span></a><a class="footer-post__share" href="http://twitter.com"><i class="font-icon icon-twitter"></i><span _msthash="2658462" _msttexthash="1985711">唽</span></a><a class="footer-post__share" href="http://linkedin.com"><i class="font-icon icon-linkedin"></i><span _msthash="2658463" _msttexthash="107016">LinkedIn</span></a>
    </footer> -->

        <div class="copy-text">
            <div>
                <p>非特殊说明，本博所有文章均为博主原创。</p>
                <p class="hidden-xs">如若转载，请注明出处：<a href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a></p>
            </div>
        </div>
    



        <div style="margin-bottom: 15px;">
            <span class="post-next">上一篇:</span>
            <?php $this->theNext('%s','没有了'); ?>
        </div>





        <div>
            <span class="post-next">下一篇:</span>
            <?php $this->thePrev('%s','没有了'); ?>
        </div>


        <br>
        <?php $this->need('layout/comments.php'); ?>
    </div>


    <script>
//  点赞按钮点击
$('#agree-btn').on('click', function () {
  $('#agree-btn').get(0).disabled = true;  //  禁用点赞按钮
  //  发送 AJAX 请求
  $.ajax({
    //  请求方式 post
    type: 'post',
    //  url 获取点赞按钮的自定义 url 属性
    url: $('#agree-btn').attr('data-url'),
    //  发送的数据 cid，直接获取点赞按钮的 cid 属性
    data: 'agree=' + $('#agree-btn').attr('data-cid'),
    async: true,
    timeout: 30000,
    cache: false,
    //  请求成功的函数
    success: function (data) {
      var re = /\d/;  //  匹配数字的正则表达式
      //  匹配数字
      if (re.test(data)) {
        //  把点赞按钮中的点赞数量设置为传回的点赞数量
        $('#agree-btn .agree-num').html(data);
      }
    },
    error: function () {
      //  如果请求出错就恢复点赞按钮
      $('#agree-btn').get(0).disabled = false;
    },
  });
});
        </script>

    <?php $this->need('layout/footer.php'); ?>

