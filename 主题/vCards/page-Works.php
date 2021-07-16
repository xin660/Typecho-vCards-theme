<?php 
/**
 * 作品
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<?php $this->need('sidebar.php'); ?>
<div class="col-12 col-md-12 col-lg-10 col_12" id=''>
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


                        <!-- Filter -->
                        <div class="select">
			                <span class="placeholder">项目</span>
			                <ul class="filter">
			                    <li class="filter__item">Category</li>
				                <li class="filter__item active" data-filter="*"><a class="filter__link active" href="#filter">全部</a></li>
				                <li class="filter__item" data-filter=".category-web"><a class="filter__link" href="#filter">网站</a></li>
				                <li class="filter__item" data-filter=".category-app"><a class="filter__link" href="#filter">软件</a></li>
				                <li class="filter__item" data-filter=".category-xcx"><a class="filter__link" href="#filter">小程序</a></li>
                                <li class="filter__item" data-filter=".category-ps"><a class="filter__link" href="#filter">设计</a></li>
			                </ul>
			                <input type="hidden" name="changemetoo"/>
		                </div>

                        <!-- Gallery -->
				        <div class="gallery-grid js-grid-row js-filter-container">
					        <div class="gutter-sizer"></div>
					        <!-- Item 1 -->
					        <figure class="gallery-grid__item category-web">
						        <div class="gallery-grid__image-wrap">
                                    <img class="gallery-grid__image cover lazyload" src="https://www.rz.sb/usr/themes/vCards/screenshot.png" data-zoom alt="vcards" />
						        </div>
                                <figcaption class="gallery-grid__caption">
							        <h4 class="title title--h6 gallery-grid__title">vCards-一款typecho模板</h4>
							        <span class="gallery-grid__category">网站</span>
						        </figcaption>
                            </figure>
                        </div><!-- Gallery End -->








    </div>








    <?php $this->need('footer.php'); ?>