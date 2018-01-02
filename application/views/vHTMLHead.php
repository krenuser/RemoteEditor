<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=lang('app_title').(isset($title_suffix) ? ' - '.$title_suffix : '')?></title>

    <script src="<?=base_url()?>js/jquery.min.js"></script>
    <script src="<?=base_url()?>js/Popper.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>css/app.css" />
    <?=isset($load_ace) ? '<script src="'.base_url().'js/ace.js"></script>' : ''?>
    <?=isset($load_ace_module) ? '<script src="'.base_url().'js/ace.'.$load_ace_module.'.js"></script>' : ''?>
</head>
<body>