<?php

include __DIR__."/header.php";

?>



<div class="pt-section pt-best">
	<div class="container">
		<div class="pt-section-title">
			<h3><?=$lang['home']['best']?></h3>
			<p><?=str_replace('[br]', '<br />', $lang['home']['best_desc'])?></p>
		</div>

		<div class="row">
			<?php
			$sql = $db->query("SELECT i.*, r.name AS rname FROM ".prefix."items AS i LEFT JOIN ".prefix."restaurants AS r ON(r.id = i.restaurant) WHERE i.home = 1 LIMIT 6");
			while ($rs = $sql->fetch_assoc()):
			?>
			<div class="col-4">
				<div class="pt-post">
					<div class="pt-thumb"><img src="<?=path.'/'.$rs['image']?>" onerror="this.src='<?=noimage?>'"></div>
					<div class="pt-details">
						<div class="pt-option">
							<?php if (db_get("restaurants", "neworders", $rs['restaurant'])): ?>
							<a data-toggle="modal" href="#addtocartModal" data-id="<?=$rs['id']?>" class="pt-addtobasket pt-addtocart tips"><i class="icons icon-basket"></i><b><?=$lang['home']['addtocart']?></b></a>
							<?php else: ?>
							<a class="pt-addtobasket pt-addtocart tips bg-danger"><i class="icons icon-close"></i><b><?=$lang['home']['unavailable']?></b></a>
							<?php endif; ?>
						</div>
						<a href="#" class="pt-price"><?="₹".$rs['selling_price']?></a>
						<div class="pt-title"><h1><a href="<?=path?>/restaurants.php?id=<?=$rs['restaurant']?>&t=<?=fh_seoURL($rs['rname'])?>"><?=$rs['name']?></a></h1></div>
						<div class="pt-info">
							<span><i class="icons icon-clock"></i> <?=($rs['delivery_time'] ? $rs['delivery_time'] : '--')?></span>
							<span class="pt-stars"><?php echo fh_stars($rs['id'], "item") ?></span>
						</div>
						<div class="pt-tags">
							<a href="<?=path?>/cuisines.php?id=<?=$rs['cuisine']?>&t=<?=fh_seoURL(db_get("cuisines", "name", $rs['cuisine']))?>"><?=db_get("cuisines", "name", $rs['cuisine'])?></a>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			<?php $sql->close(); ?>
		</div><!-- End Row -->

		<div class="pt-link">
			<a href="<?=path?>/cuisines.php"><?=$lang['home']['more']?> <i class="fas fa-long-arrow-alt-right"></i></a>
		</div>

	</div><!-- End container -->

</div><!-- End section -->




<div class="pt-section">
	<div class="container">
		<div class="pt-section-title">
			<h3><?=$lang['home']['customers']?></h3>
			<p><?=str_replace('[br]', '<br />', $lang['home']['customers_desc'])?></p>
		</div>
		<div class="pt-testimonials">
			<div class="owl-carousel owl-theme">
				<?php
				$sql = $db->query("SELECT * FROM ".prefix."testimonials WHERE status = 1 LIMIT 10");
				while ($rs = $sql->fetch_assoc()):
				?>
				<div class="item">
				<div class="pt-item">
					<div class="pt-thumb">
						<img src="<?=db_get("users", "photo", $rs['author'])?>" onerror="this.src='<?=nophoto?>'">
					</div>
					<div class="pt-content"><?=$rs['content']?></div>
					<div class="pt-stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					</div>
					<div class="pt-author"><?=db_get("users", "username", $rs['author'])?></div>
				</div>
				</div>
				<?php endwhile; ?>
				<?php $sql->close(); ?>
			</div>
		</div>
	</div>
</div><!-- End section -->



<?php
include __DIR__."/footer.php";


$path = dirname(__FILE__).'/uploads-temp';
$fi = new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);

if(iterator_count($fi)>1){
if ($handle = opendir($path)) {
  while (false !== ($file = readdir($handle))) {
    if (time() > (filectime($path.'/'.$file) + 86400)) {
      if(!preg_match('/\.html$/i', $file)) {
				if(file_exists($path.'/'.$file))
        	unlink($path.'/'.$file);
      }
    }
  }
}
}
