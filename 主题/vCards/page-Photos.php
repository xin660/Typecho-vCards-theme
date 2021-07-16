<?php 
/**
 * 相册
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


    <div class="box box-content">



                        <!-- Filter -->
                        <div class="select">
			                <span class="placeholder">Select category</span>
			                <ul class="filter">
			                    <li class="filter__item">Category</li>
				                <li class="filter__item active" data-filter="*"><a class="filter__link active" href="#filter">全部</a></li>
				                <li class="filter__item" data-filter=".category-'.$this->title.'"><a class="filter__link" href="#filter">生活</a></li>
				                <li class="filter__item" data-filter=".category-'.$this->title.'"><a class="filter__link" href="#filter">旅游</a></li>
				                <li class="filter__item" data-filter=".category-'.$this->title.'"><a class="filter__link" href="#filter">美食</a></li>
                                <li class="filter__item" data-filter=".category-'.$this->title.'"><a class="filter__link" href="#filter">风景</a></li>
			                </ul>
			                <input type="hidden" name="changemetoo"/>
		                </div>



                        <!-- Gallery -->
        <div class="gallery-grid gallery-grid-two js-grid js-filter-container">
                <div class="gutter-sizer"></div>
                                <?php
                $pattern = '/<img(.*?)src="(.*?)"(.*?)alt="(.*?)"(.*?)>/s';
                $replacement = '
                <figure class="gallery-grid__item">
                <div class="gallery-grid__image-wrap">
                    <img class="gallery-grid__image cover lazyload" ${1}src="${2}"${3} data-zoom alt="'.$this->title.'"/>
                </div>
                <figcaption class="gallery-grid__caption">
                <center>
				<span class="gallery-grid__category">${4}</span>
                </center>
				</figcaption>
                </figure>';
                $content = preg_replace($pattern, $replacement, $this->content);
                echo $content;
                ?>
					        
		</div>
                    <!-- Gallery End -->


        
        



        

    </div>








    <?php $this->need('footer.php'); ?>