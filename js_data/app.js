var app = {
	base_url: '<?=base_url()?>',
	cPath: '/',
	editor: null,
	reCurrObjType: '',
	cFileName: '',
	isChanged: false,

	init: function () {
		app.loadFileList();

		app.editor = ace.edit('editor');
		app.editor.focus();
		app.editor.on('change', function(e) {app.setChanged(true); });
		
		$('.app-handler').on('click', function(e){
			app.menuItemClick(e.currentTarget.id);
			e.preventDefault();
		});
		
	},
	
	menuItemClick: function(e) {
		switch(e) {
			case 'mnuFileSave':
				app.saveFile();
			break;
			case 'mnuFileSaveAs':
				var newFileName = prompt('Введите новое имя файла', app.cFileName);
				if(newFileName) {
					app.saveFile(newFileName);
				}
			break;
			case 'mnuFileNew':
				if(app.isChanged) {
					if(!confirm('Файл был изменён. Закрыть его и создать новый файл?')){
						return false;
					}
				}
				app.newFile();
			break;
		}
	},
	
	onResize: function(){
		app.editor.resize();
	},

	loadFileList: function(path) {
		if(typeof path == 'undefined')
			path = app.cPath;
		
		app.cPath = path;
		
		$('.re-file-list')
			.html('<img src="' + app.base_url + 'img/loading.gif" />')
			.load(app.base_url + 'filelist/get', {path: path}, function(data, status, ajax){ });
	},

	FSItemClick: function(item_type, item_name) {
		switch(item_type) {
			case 'folder':
			case 'up':
				app.loadFileList(item_name);
				if(app.reCurrObjType != 'file') {
					$('.re-curr-path').text(item_name);
					app.reCurrObjType = 'folder';
				}
			break;
			case 'file':
				app.loadFile(item_name);
				$('.re-curr-path').text(item_name);
				app.reCurrObjType = 'file';
			break;
		}
	},
	
	loadFile: function(filename) {
		if(app.isChanged) {
			if(!confirm('Файл изменён. Открыть новый файл без сохранения текущего?')){
				return false;
			}
		}
		
		app.cFileName = '';
		$.getJSON(app.base_url + 'file/load/?filename=' + filename, {}, function(json,status,ajax) {
			if(json.status == 'ok') {
				app.setChanged(false);
				
				var content = json.data.fileContent;
				
				app.editor.setValue(content);
				app.editor.getSelection().clearSelection();
				app.editor.moveCursorTo(1,0);
				app.editor.focus();
				
				if(json.data.isWritable == 'Y') {
					app.editor.setReadOnly(false);
				}
				else {
					app.editor.setReadOnly(true);
					$('.re-file-changed').html("<?=insert_icon('lock', 16)?>");
				}
				app.cFileName = filename;
			}
			else {
				app.showInfo(json.message);
			}
		});
	},
	
	saveFile: function(filename) {
		var re = /\//i;
		if(typeof filename == 'undefined') {
			filename = app.cFileName;
		}
		if(!re.test(filename)){
			filename = app.cPath + '/' + filename;
		}
		app.cFileName = filename;

		if(app.cFileName == '') {
			app.showInfo('Для того, чтобы сохранить файл, нужно сначала его открыть. <br />Если нужно сохранить файл под повым именем, используйте команду меню "Сохранить как..."');
			return false;
		}
		
		var content = app.editor.getValue();
		
		$.postJSON(app.base_url + 'file/save/?filename=' + filename, {content: content}, function(json, status, ajax){
			if(json.status == 'ok') {
				app.setChanged(false);
				app.loadFileList(app.cPath);
			}
			else {
				app.showInfo(json.message);
			}
		});
	},
	
	newFile: function(e) {
		var path = app.cPath;
		
		$('.re-curr-path').text(path);
		app.reCurrObjType = 'folder';		

		app.cFileName = '';
		app.editor.setValue('');
		app.editor.focus();
		
	},
	
	removeFile: function(filename) {
		if(confirm('Удалить файл "'+filename+'" ?')) {
			$.getJSON(app.base_url + 'file/remove/?filename='+filename, {}, function(json, status, ajax){
				if(json.status == 'ok') {
					app.cFileName = '';
					app.setChanged(false);
					app.newFile();
					app.loadFileList(app.cPath);
				}
				else {
					app.showInfo(json.message);
				}
			});
		}
	},
	
	showInfo: function(message, title) {
		if(typeof title != 'undefinde') {
			title = "Info";
		}
		$('.re-info-title').html(title);
		$('.re-info-body').html(message);
		$('#reFrameInfo').modal('show');
	},
		
	setChanged: function(isChanged) {
		if(app.cFileName != '') {
			app.isChanged = isChanged;
			if(isChanged){
				$('.re-file-changed').text('*');
			}
			else {
				$('.re-file-changed').text('');
			}
		}
		else {
			app.isChanged = false;
			$('.re-file-changed').text('');
		}
	}

};

$(app.init);