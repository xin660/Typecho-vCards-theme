<?php 
/**
 * 文章归档
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
			<h1 class="title title--h1 first-title title__separate">[归档页]</h1>
		</div>
		<?php 
			$this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);   
			$year=0; $mon=0; $i=0; $j=0;   
			$output = '<div id="archives" class="col-12 archive-con">';   
			while($archives->next()):   
				$year_tmp = date('Y',$archives->created);   
				$mon_tmp = date('m',$archives->created);   
				$y=$year; $m=$mon;   
				if ($mon != $mon_tmp && $mon > 0) $output .= '</div></article>';   
				if ($year != $year_tmp && $year > 0) $output .= '</div>';   
				if ($year != $year_tmp) {   
					$year = $year_tmp;   
					$output .= '<h2 class="title title--h2">['. $year .'年]</h2><div class="timeline">';    
				}   
				$output .= '<article class="timeline__item">
								<a href="'.$archives->permalink .'"><h5 class="title title--h5 timeline__title">'. $archives->title .'</h5></a>
								<span class="timeline__period">'.date('n-d',$archives->created).'</span>
							</article>'; //输出文章日期和标题   
			endwhile;   
			$output .= '</div></div>';
			echo $output;
		?>
	</div>

	<?php $this->need('layout/footer.php'); ?>

