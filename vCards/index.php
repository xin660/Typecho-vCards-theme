<?php
/**
 * 这是一款简约的vcard样式模板
 * 
 * @package vCards
 * @author irils
 * @version 1.0
 * @link https://www.rz.sb
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('layout/header.php');
 ?>
<?php $this->need('layout/sidebar.php'); ?>

<!-- Content -->
<div class="col-12 col-md-12 col-lg-10 col_12" id='pjax'>

	<div class="box box-content">
		<div class="pb-2">
			<h1 class="title title--h1 first-title title__separate">[首页]</h1>
		</div>

		<!-- News -->
		<div class="news-grid" id="content">
			<!-- Post -->
			<?php while($this->next()): ?>
			<article class="news-item box ">
				<div class="news-item__image-wrap overlay overlay--45">
					<div class="news-item__sort"><span style="color:#fff;">
							<?php $this->category('.'); ?>
						</span></div>
					<div class="news-item__date">
                        <span>
							<?php $this->date('Y-m-d'); ?>
						</span>
					</div>
					<div class="news-item__con">
						<p itemprop="name headline">
							<?php $this->sticky(); $this->title(15, '...') ?>
						</p>
						<span>
							<?php $this->excerpt(20, '...');?>
						</span>
					</div>
					<a class="news-item__link" itemprop="url" href="<?php $this->permalink() ?>"></a>
					<?php if($this->options->slimg && 'guanbi'==$this->options->slimg): ?>
					<?php else: ?>
					<?php if($this->options->slimg && 'showoff'==$this->options->slimg): ?>
					<?php else: ?>
					<img class="news-item-image cover ls-is-cached lazyloaded" src="<?php showThumbnail($this); ?>"
						alt="">
					<?php endif; ?>
					<?php endif; ?>

				</div>



			</article>

			<?php endwhile; ?>




		</div>
		<div class="posts-nav" style="
    padding: 1rem 0 1rem 0;
    font-size: 2rem;
">

			<div style="float:right;">
				<?php $this->pageLink('<span class="page-numbers">→</span>','next'); ?>
			</div>
			&nbsp;&nbsp;
			<?php $this->pageLink('<span class="page-numbers">←</span>'); ?>
		</div>

	</div>


	<?php $this->need('layout/footer.php'); ?>