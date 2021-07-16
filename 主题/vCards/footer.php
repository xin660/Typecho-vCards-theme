<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>




<!-- Footer -->
<footer class="footer">© 2021 RZ.SB <!-- <a href="https://travellings.link/" target="_blank" rel="noopener" title="开往-友链接力">
    <img src="https://travellings.link/assets/logo.gif" alt="开往-友链接力" width="120">
</a> --></footer>
</div>
</div>
</div>
</main>

<script src="<?php $this->options->themeUrl('assets/js/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/plugins.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/common.js'); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
	integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
	crossorigin="anonymous"></script>
<script src='//unpkg.com/nprogress@0.2.0/nprogress.js'></script>
<link rel="stylesheet" href="https://cdn.staticfile.org/fancybox/3.5.2/jquery.fancybox.min.css">
<script src="https://cdn.staticfile.org/fancybox/3.5.2/jquery.fancybox.min.js"></script>
<script src="https://cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.js"></script>
<script src='//unpkg.com/nprogress@0.2.0/nprogress.js'></script>



<!-- <div ><a href="https://travellings.link/" target="_blank" rel="noopener" title="开往-友链接力" class="btnTravellings TravellingsOpen "></a></div> -->
<!--  search -->
<div class="btnSearch SearchOpen " mdui-dialog="{target: '#Search'}"> </div>
<div class="mdui-dialog" id="Search" style="border-radius: 20px">
	<div class="mdui-dialog-title" style="">搜索...</div>
	<div class="mdui-dialog-content">

		<form class="search-form" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
			<input type="text" id="s" name="s" class="text textarea form-control"
				placeholder="<?php _e('请输入搜索关键词......'); ?>"
				style="overflow: hidden; overflow-wrap: break-word; outline: none; height: 52px;" />
			<button type="submit" class="search-btn"><i class="font-icon icon-search"></i></button>
		</form>
		<br>
		<div class="tags">
			<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
			<ul class="tags-list" style="padding: unset;">
				<?php while($tags->next()): ?>
				<li class="mdui-chip"><a class="mdui-chip-title" href="<?php $tags->permalink(); ?>"
						title='<?php $tags->name(); ?>'>
						<?php $tags->name(); ?>
					</a></li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
<!--  search -->
<!-- SVG masks -->
<svg class="svg-defs">
	<clipPath id="avatar-box">
		<path
			d="M1.85379 38.4859C2.9221 18.6653 18.6653 2.92275 38.4858 1.85453 56.0986.905299 77.2792 0 94 0c16.721 0 37.901.905299 55.514 1.85453 19.821 1.06822 35.564 16.81077 36.632 36.63137C187.095 56.0922 188 77.267 188 94c0 16.733-.905 37.908-1.854 55.514-1.068 19.821-16.811 35.563-36.632 36.631C131.901 187.095 110.721 188 94 188c-16.7208 0-37.9014-.905-55.5142-1.855-19.8205-1.068-35.5637-16.81-36.63201-36.631C.904831 131.908 0 110.733 0 94c0-16.733.904831-37.9078 1.85379-55.5141z" />
	</clipPath>
	<clipPath id="avatar-hexagon">
		<path
			d="M0 27.2891c0-4.6662 2.4889-8.976 6.52491-11.2986L31.308 1.72845c3.98-2.290382 8.8697-2.305446 12.8637-.03963l25.234 14.31558C73.4807 18.3162 76 22.6478 76 27.3426V56.684c0 4.6805-2.5041 9.0013-6.5597 11.3186L44.4317 82.2915c-3.9869 2.278-8.8765 2.278-12.8634 0L6.55974 68.0026C2.50414 65.6853 0 61.3645 0 56.684V27.2891z" />
	</clipPath>
</svg>

<div class="back-to-top"></div>




<script>
	function getBaseUrl() {
		var ishttps = 'https:' == document.location.protocol ? true : false;
		var url = window.location.host;
		if (ishttps) {
			url = 'https://' + url;
		} else {
			url = 'http://' + url;
		}
		return url;
	}
	let url = '"' + getBaseUrl() + '"';
	$(document).pjax('a[href^=' + url + ']:not(a[target="_blank"], a[no-pjax])', {
		container: '#pjax',
		fragment: '#pjax',
		timeout: 8000
	})
	$(document).on('pjax:start', function () { NProgress.start(); });

	$(document).on('pjax:end', function () { NProgress.done(); });
	if (typeof lazyload === "function") {
		$(document).on('pjax:complete', function () {
			jQuery(function () {
				jQuery("div").lazyload({ effect: "fadeIn" });
			});
			jQuery(function () {
				jQuery("img").lazyload({ effect: "fadeIn" });
			});
		});
	} else {
		console.log('lazyload is closed');
	}

	$(document).on('pjax:complete', function() {
	loadMeting();
	});
</script>




<script type="text/javascript">
	$(document).ready(function () {
		$(".fancybox").fancybox();
	});
</script>



<!-- <script>
document.oncontextmenu = function(){return false;}


document.onkeydown=function (e){
        var currKey=0,evt=e||window.event;
        currKey=evt.keyCode||evt.which||evt.charCode;
        if (currKey == 123) {
            window.event.cancelBubble = true;
            window.event.returnValue = false;
        }
    }
	</script> -->





<?php $this->footer(); ?>
</body>

</html>