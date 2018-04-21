CKEDITOR.editorConfig = function( config ) {
    //config.uiColor = '#d0d0d0';
	config.toolbar = [
		{ name: 'styles', items: [ 'FontSize' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'insert', items: [ 'Image', 'Table', 'Smiley', 'SpecialChar' ] },
	];
};
