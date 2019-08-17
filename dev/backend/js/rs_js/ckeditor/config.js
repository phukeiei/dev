/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.resize_enabled = false;
	config.toolbar_Forum =
	[
		{ name: 'riga1',      items : ['Bold','Italic','Underline','-','SpecialChar','Subscript', 'Superscript','-','Undo','Redo'] },'/',
		{ name: 'riga2',      items : ['Cut','Copy','-','Maximize'] }
	];

	config.toolbar = 'Forum';
};
