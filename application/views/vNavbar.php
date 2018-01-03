<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 5px;">
	<a href="<?=base_url()?>" class="navbar-brand"><?=lang('app_title')?></a>

	<ul class="navbar-nav mr-auto">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="mnuFileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?=lang('app_file_menu')?>
			</a>
			
			<div class="dropdown-menu" aria-labelledby="mnuFileDropdown">
				<a class="dropdown-item app-handler" id="mnuFileNew" href="#">
					<?=lang('app_file_new')?>
				</a>
				<a class="dropdown-item app-handler" id="mnuFileSave" href="#">
					<?=lang('app_file_save')?>
				</a>
				<a class="dropdown-item app-handler" id="mnuFileSaveAs" href="#">
					<?=lang('app_file_save_as')?>
				</a>
				<div class="divider"></div>
				<a class="dropdown-item app-handler" id="mnuFileRemove" href="#">
					<?=lang('app_file_remove')?>
				</a>
			</div>
		</li>
		<li class="nav-item" style="margin-left: 50px;">
			<span class="nav-link re-file-changed" onclick="return false"></span>
		</li>
		<li class="nav-item" style="">
			<a class="nav-link re-curr-path" href="#" onclick="return false">/</a>
		</li>
	</ul>
	
	<ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" href="<?=base_url()?>login/doLogout"><?=lang('app_logout')?></a></li>
	</ul>
</nav>