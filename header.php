<?php


include __DIR__."/head.php";

?>

<div id="full-page-container">
<div class="pt-wrapper">
	<div class="pt-header">
		<div class="pt-header-top">
			<?=(page != "index" ?'<div class="over"><span class="pt-bg"></span></div>':"")?>

			<div class="container">
				<div class="pt-logo"><a href="<?=path?>"><img src="./uploads/settings/book_dish.jpg" alt="BookDish"></a></div>
				<div class="pt-menu">
					<ul>
						<li><a href="<?=path?>"><?=$lang['header']['home']?></a></li>
						<li><a href="<?=path?>/cuisines.php"><?=$lang['header']['explore']?></a></li>
						<li><a href="<?=path?>/restaurants.php"><?=$lang['header']['restaurants']?></a></li>
						<li class="pt-mobile-menu">
							<a href="#"><i class="icon-menu icons"></i></a>
							<ul class="pt-drop">
								<li><a href="<?=path?>"><?=$lang['header']['home']?></a></li>
								<li><a href="<?=path?>/cuisines.php"><?=$lang['header']['explore']?></a></li>
								<li><a href="<?=path?>/restaurants.php"><?=$lang['header']['restaurants']?></a></li>
							</ul>
						</li>
						<li class="pt-cart">
							<a href="<?=path?>/cart.php">
								<i class="icon-basket icons"></i>
								<b><?=(isset($_COOKIE['addtocart'])?count(json_decode($_COOKIE['addtocart'],true), 1)-count(json_decode($_COOKIE['addtocart'],true)):'0')?></b>
							</a>
						</li>
						<?php if(us_level): ?>
							<li class="pt-img">
								<div class="pt-thumb"><img src="<?=path?>/<?=us_photo?>" onerror="this.src='<?=nophoto?>'"></div>
							</li>
							<li class="pt-author">
								<?php
								$head_orders = db_rows("orders WHERE status = 0 and user = '".us_id."'");
								if($head_orders) echo "<b>".$head_orders."</b>";
								?>
								<span class="pt-showmenudetails"><?=us_username?> <i class="fas fa-caret-down"></i></span>
								<ul class="pt-drop">
									<?php if(us_level == 6): ?>
									<li><a href="<?=path?>/dashboard.php"><i class="icons icon-speedometer"></i> <?=$lang['header']['dashboard']?></a></li>
									<?php endif; ?>
									<li><a href="<?=path?>/myorders.php"><i class="icons icon-wallet"></i> <?=$lang['header']['my_orders']?></a></li>
									<?php if(us_plan): ?>
									<li><a href="<?=path?>/restaurant.php"><i class="fas fa-store"></i> <?=$lang['header']['your_restaurant']?></a></li>
									<?php endif; ?>
									<li><a href="#testimonialModal" data-toggle="modal"><i class="far fa-comment"></i> <?=$lang['header']['testimonial']?></a></li>
									<li><a href="#passwordModal" data-toggle="modal"><i class="icons icon-lock-open"></i> <?=$lang['header']['change_password']?></a></li>
									<li><a href="<?=path?>/userdetails.php"><i class="fas fa-pencil-alt"></i> <?=$lang['header']['edit_details']?></a></li>
									<li><a href="#" class="pt-logout"><i class="icons icon-power"></i> <?=$lang['header']['logout']?></a></li>
								</ul>
							</li>
						<?php else: ?>
							<li class="pt-login"><a data-toggle="modal" href="#loginModal"><i class="icon-user icons"></i> <?=$lang['header']['login']?></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div><!-- End header top -->

		<?php if(page == "index"): ?>
		<div class="pt-header-content">
			<
		</div><!-- End header Content -->
		<?php endif; ?>
	</div><!-- End header -->
