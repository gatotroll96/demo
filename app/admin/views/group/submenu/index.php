<?php
	$linkGroup = URL::createLink('admin', 'group', 'index');
	$linkUser = URL::createLink('admin','user','index');
	$linkCategory = URL::createLink('admin','category','index');
?>

<div id="submenu-box">
	<div class="m">
		<ul id="submenu">
			<li><a href="<?php echo $linkGroup; ?>" class="active">Group</a></li>
			<li><a  href="<?php echo $linkUser; ?>">User</a></li>
			<li><a  href="<?php echo $linkCategory; ?>">Category</a></li>
			
		</ul>
		<div class="clr"></div>
	</div>
</div>