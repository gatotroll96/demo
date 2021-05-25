<?php
	$linkAddNBook = URL::createLink('admin','book','add');
	$linkBook = URL::createLink('admin','book','index');
	$linkCategory = URL::createLink('admin','category','index');
	$linkGroup = URL::createLink('admin','group','index');
	$linkUser = URL::createLink('admin','user','index');
?>
<div id="element-box">
	<div id="system-message-container"></div>
	<div class="m">
		<div class="adminform">
			<div class="cpanel-left">
				<div class="cpanel">
					<div class="icon-wrapper">
						<div class="icon">
							<a href="<?php echo $linkAddNBook; ?>">
								<img src="<?php echo $this->imagesUrl;?>images/header/icon-48-article-add.png" alt="">
								<span>Add New Book</span>
							</a>
						</div>
					</div>
					<div class="icon-wrapper">
						<div class="icon">
							<a href="<?php echo $linkBook; ?>">
								<img src="<?php echo $this->imagesUrl;?>images/header/icon-48-article.png" alt="">
								<span>Article Manager</span>
							</a>
						</div>
					</div>
					<div class="icon-wrapper">
						<div class="icon">
							<a href="<?php echo $linkCategory; ?>">
								<img src="<?php echo $this->imagesUrl;?>images/header/icon-48-category.png" alt="">
								<span>Category Manager</span>
							</a>
						</div>
					</div>					
					<div class="icon-wrapper">
						<div class="icon">
							<a href="<?php echo $linkGroup; ?>">
								<img src="<?php echo $this->imagesUrl;?>images/header/icon-48-groups.png" alt="">
								<span>Group Manager</span>
							</a>
						</div>
					</div>
					<div class="icon-wrapper">
						<div class="icon">
							<a href="<?php echo $linkUser; ?>">
								<img src="<?php echo $this->imagesUrl;?>images/header/icon-48-user.png" alt="">
								<span>User Manager</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="clr"></div>
	</div>
</div>