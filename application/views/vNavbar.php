<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 5px;">
	<a href="<?=base_url()?>" class="navbar-brand"><?=lang('app_title')?></a>

	<ul class="navbar-nav mr-auto">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="mnuFileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?=lang('app_file_menu')?>
			</a>
			
			<div class="dropdown-menu" aria-labelledby="mnuFileDropdown">
				<a class="dropdown-item app-handler" id="mnuFileNew" href="#">
					<?=insert_icon('new-message')?> 
					<?=lang('app_file_new')?>
				</a>
				<a class="dropdown-item app-handler" id="mnuFileOpen" href="#">
					<?=insert_icon('folder')?> 
					<?=lang('app_file_open')?>
				</a>
				<a class="dropdown-item app-handler" id="mnuFileSave" href="#">
					<?=insert_icon('save')?> 
					<?=lang('app_file_save')?>
				</a>
			</div>
		</li>
	</ul>
	
	<ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" href="<?=base_url()?>login/doLogout"><?=lang('app_logout')?></a></li>
	</ul>
</nav>