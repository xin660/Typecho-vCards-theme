<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>
<?php $this->need('layout/sidebar.php'); ?>

<div class="col-12 col-md-12 col-lg-10 col_12" id='pjax'>
    <div class="box box-content">
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="pb-2">
                <h1 class="title title--h1 first-title title__separate" itemprop="name headline">[
                    <?php $this->title() ?>]
                </h1>
            </div>
            <div class="caption-post" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
        </article>
        <?php $this->need('layout/comments.php'); ?>
    </div><!-- end #main-->
    <?php $this->need('layout/footer.php'); ?>