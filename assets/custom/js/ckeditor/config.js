/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
    config.language = 'vi'; 
    config.extraPlugins = 'base64image';
    //config.extraPlugins = 'pastebase64';
    //config.extraPlugins = 'uploadfile';
    config.removePlugins = 'dragdrop,easyimage';
    //config.extraPlugins = 'video';
    // config.uiColor = '#AADC6E'; 
    config.extraPlugins = 'youtube,html5video,widget,widgetselection,clipboard,lineutils';
    
};
