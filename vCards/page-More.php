<?php 
/**
 * 更多
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
			<h1 class="title title--h1 first-title title__separate">[更多]</h1>
		</div>
		<?php if ($this->options->BooksUrl && $this->options->FilmsUrl && $this->options->MusicUrl && $this->options->PhotosUrl && $this->options->WorksUrl && $this->options->SayUrl && $this->options->LogsUrl && $this->options->LinksUrl && $this->options->AboutUrl): ?>
		<div class="row more-r">
			<?php if (!empty($this->options->more_page) && in_array('Books', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->BooksUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/book.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[ 书单 ]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>

			<?php if (!empty($this->options->more_page) && in_array('Films', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->FilmsUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/film.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[ 影单 ]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>

			<?php if (!empty($this->options->more_page) && in_array('Music', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->MusicUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/music.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[ 歌单 ]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>

			<?php if (!empty($this->options->more_page) && in_array('Photos', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->PhotosUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/image.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[ 相册 ]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>

			<?php if (!empty($this->options->more_page) && in_array('Works', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->WorksUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/package.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[项目]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>

			<?php if (!empty($this->options->more_page) && in_array('Say', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->SayUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/say.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[ 语录 ]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>

			<?php if (!empty($this->options->more_page) && in_array('Logs', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->LogsUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/logs.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[ 日志 ]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>

			<?php if (!empty($this->options->more_page) && in_array('Links', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->LinksUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/users.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[ 友链 ]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>

			<?php if (!empty($this->options->more_page) && in_array('About', $this->options->more_page)): ?>
			<!-- Case Item -->
			<div class="col-4 col-lg-4">
				<a href="<?php $this->options->siteUrl(); ?><?php $this->options->AboutUrl() ?>">
					<div class="case-item mdui-ripple"><img class="case-item__icon"
							src="<?php $this->options->themeUrl('assets/icons/user.svg'); ?>" alt="">
						<div>
							<h3 class="title title--h4">[ 关于 ]</h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div>
	<?php $this->need('layout/footer.php'); ?>

