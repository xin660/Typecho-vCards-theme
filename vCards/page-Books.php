<?php 
/**
 * 书单
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
    <div class="box box-content">
        <article class="books"> 
            <div class="caption" itemprop="articleBody">
                <div id="book">
                    <div class="page">
                        <ul class="content" style="min-height: 678px;">
                            <li>
                                <div class="info">
                                    <a href="https://weread.qq.com/web/reader/6a732ce07201202c6a7b30a?autoscroll=1" target="_blank" rel="noreferrer noopener"
                                        class="book-container">
                                        <div class="book">
                                            <img src="https://wfqqreader-1252317822.image.myqcloud.com/cover/204/33628204/t6_33628204.jpg" alt="认知觉醒">
                                        </div>
                                    </a>
                                    <div>
                                        <h3>《 认知觉醒 》</h3>
                                        <p>作者：周岭</p>
                                        <p>出版时间：2020年9月</p>
                                        <p>阅读进度：正在阅读...</p>
                                        <p>
                                            <span>读书笔记：</span>
                                            <a href="/" target="_blank" rel="noopener noreferrer">更多</a>
                                        </p>
                                        
                                    </div>
                                </div>
                                <p class="description">“ 读书的意义在于站在智者的肩膀上看世界，与智者对话，听智者的经验，发现自我认知的有限性。”
                                </p>
                            </li>
                            <li>
                                <div class="info">
                                    <a href="https://weread.qq.com/web/reader/ce032b305a9bc1ce0b0dd2a?autoscroll=1" target="_blank" rel="noreferrer noopener"
                                        class="book-container">
                                        <div class="book">
                                            <img src="https://wfqqreader-1252317822.image.myqcloud.com/cover/233/695233/t6_695233.jpg" alt="三体">
                                        </div>
                                    </a>
                                    <div>
                                        <h3>《 三体 》</h3>
                                        <p>作者：刘慈欣</p>
                                        <p>出版时间：2018年12月</p>
                                        <p>阅读进度：正在阅读...</p>
                                        <p><span>读书笔记：</span><a href="javascript:;" target="" rel="noopener noreferrer"> 更多 </a></p>
                                    
                                    </div>
                                </div>
                                <p class="description">“ 越透明的东西越神秘，宇宙本身就是透明的，只要目力能及，你想看多远就看多远，但越看越神秘。 ”</p>
                            </li>
                            <li>
                                <div class="info"><a href="https://weread.qq.com/web/reader/840321c071900bfb840cabc" target="_blank" rel="noreferrer noopener"
                                        class="book-container">
                                        <div class="book">
                                            <img src="https://wfqqreader-1252317822.image.myqcloud.com/cover/467/26217467/t6_26217467.jpg" alt="大秦帝国">
                                        </div>
                                    </a>
                                    <div>
                                        <h3>《 大秦帝国 》</h3>
                                        <p>作者：萧然</p>
                                        <p>出版时间：2017年1月</p>
                                        <p>阅读进度：正在阅读...</p>
                                        <p><span>读书笔记：</span><a href="javascript:;" target="" rel="noopener noreferrer">更多</a></p>
                                        
                                    </div>
                                </div>
                                <p class="description">“ 浪淘沙，风扬尘。当大秦帝国落幕锣声响起的时候，一切繁华显赫都化作烟云飘散而去，留下来的只有朴实而厚重的东西，它们积聚到我们脚下的大地。 ”</p>
                            </li>
                            <li>
                                <div class="info">
                                    <a href="https://weread.qq.com/web/reader/d6d320d05715b5d6d8faeff?autoscroll=1" target="_blank"
                                        rel="noreferrer noopener" class="book-container">
                                        <div class="book">
                                            <img src="https://wfqqreader-1252317822.image.myqcloud.com/cover/309/464309/t6_464309.jpg" alt="盗墓笔记">
                                        </div>
                                    </a>
                                    <div>
                                        <h3>《 盗墓笔记 》</h3>
                                        <p>作者：南派三叔</p>
                                        <p>出版时间：2007年1月</p>
                                        <p>阅读进度：正在阅读...</p>
                                        <p><span>读书笔记：</span><a href="javascript:;" target="" rel="noopener noreferrer"> 更多 </a></p>
                                        
                                    </div>
                                </div>
                                <p class="description">“ 那个时候云彩还没有死，胖子整天嬉皮笑脸，闷油瓶还没有到青铜门背后去，吴邪从没有带上那个长在心里的面具。
                                    ”</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </article>
    </div><!-- end #main-->
    <?php $this->need('layout/footer.php'); ?>