<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- Sidebar nav -->
<aside class="col-12 col-md-12 col-lg-2 col_12">
	<div class="sidebar box sticky-column">
		<ul class="nav">
			<li class="nav__item"><a class="<!-- <?php if($this->is('index')): ?>active <?php endif; ?> --> "
					href="<?php $this->options->siteUrl(); ?>"><i class="icon-home"></i>[ 首页 ]</a></li>
			<li class="nav__item"><a class="<!-- <?php if($this->is('page','Archives')): ?>active <?php endif; ?> --> "
					href="<?php $this->options->siteUrl(); ?>Archives.html"><i class="icon-archive"></i>[ 归档
					]</a></li>
			<li class="nav__item"><a class="<!-- <?php if($this->is('page','Cross')): ?>active <?php endif; ?> --> "
					href="<?php $this->options->siteUrl(); ?>Cross.html"><i class="icon-navigation"></i>[ 动态
					]</a></li>
			<li class="nav__item"><a class="<!-- <?php if($this->is('page','Links')): ?>active <?php endif; ?>  --> "
					href="<?php $this->options->siteUrl(); ?>Messages.html"><i class="icon-message-square"></i>[ 留言 ]</a>
			</li>
			<li class="nav__item"><a class="<!-- <?php if($this->is('page','More')): ?>active <?php endif; ?>  --> "
					href="<?php $this->options->siteUrl(); ?>More.html"><i class="icon-more-horizontal"></i>[
					更多 ]</a></li>



		</ul>

	</div>
</aside>