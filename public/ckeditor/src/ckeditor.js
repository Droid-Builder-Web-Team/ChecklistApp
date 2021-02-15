/**
 * @license Copyright (c) 2014-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
// Import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor.js';
const ClassicEditor = require('@ckeditor/ckeditor5-editor-classic/src/classiceditor.js');
const Alignment = require( '@ckeditor/ckeditor5-alignment/src/alignment.js');
const AutoImage = require( '@ckeditor/ckeditor5-image/src/autoimage.js');
const Autoformat = require( '@ckeditor/ckeditor5-autoformat/src/autoformat.js');
const Autolink = require( '@ckeditor/ckeditor5-link/src/autolink.js');
const Autosave = require( '@ckeditor/ckeditor5-autosave/src/autosave.js');
const BlockQuote = require( '@ckeditor/ckeditor5-block-quote/src/blockquote.js');
const Bold = require( '@ckeditor/ckeditor5-basic-styles/src/bold.js');
const CKFinder = require( '@ckeditor/ckeditor5-ckfinder/src/ckfinder.js');
const CKFinderUploadAdapter = require( '@ckeditor/ckeditor5-adapter-ckfinder/src/uploadadapter.js');
const Essentials = require( '@ckeditor/ckeditor5-essentials/src/essentials.js');
const ExportToPDF = require( '@ckeditor/ckeditor5-export-pdf/src/exportpdf.js');
const ExportToWord = require( '@ckeditor/ckeditor5-export-word/src/exportword.js');
const FontColor = require( '@ckeditor/ckeditor5-font/src/fontcolor.js');
const FontSize = require( '@ckeditor/ckeditor5-font/src/fontsize.js');
const Heading = require( '@ckeditor/ckeditor5-heading/src/heading.js');
const Highlight = require( '@ckeditor/ckeditor5-highlight/src/highlight.js');
const HtmlEmbed = require( '@ckeditor/ckeditor5-html-embed/src/htmlembed.js');
const Image = require( '@ckeditor/ckeditor5-image/src/image.js');
const ImageCaption = require( '@ckeditor/ckeditor5-image/src/imagecaption.js');
const ImageInsert = require( '@ckeditor/ckeditor5-image/src/imageinsert.js');
const ImageResize = require( '@ckeditor/ckeditor5-image/src/imageresize.js');
const ImageStyle = require( '@ckeditor/ckeditor5-image/src/imagestyle.js');
const ImageToolbar = require( '@ckeditor/ckeditor5-image/src/imagetoolbar.js');
const ImageUpload = require( '@ckeditor/ckeditor5-image/src/imageupload.js');
const Indent = require( '@ckeditor/ckeditor5-indent/src/indent.js');
const Italic = require( '@ckeditor/ckeditor5-basic-styles/src/italic.js');
const Link = require( '@ckeditor/ckeditor5-link/src/link.js');
const LinkImage = require( '@ckeditor/ckeditor5-link/src/linkimage.js');
const List = require( '@ckeditor/ckeditor5-list/src/list.js');
const MediaEmbed = require( '@ckeditor/ckeditor5-media-embed/src/mediaembed.js');
const MediaEmbedToolbar = require( '@ckeditor/ckeditor5-media-embed/src/mediaembedtoolbar.js');
const Paragraph = require( '@ckeditor/ckeditor5-paragraph/src/paragraph.js');
const PasteFromOffice = require( '@ckeditor/ckeditor5-paste-from-office/src/pastefromoffice');
const SpecialCharacters = require( '@ckeditor/ckeditor5-special-characters/src/specialcharacters.js');
const StandardEditingMode = require( '@ckeditor/ckeditor5-restricted-editing/src/standardeditingmode.js');
const Table = require( '@ckeditor/ckeditor5-table/src/table.js');
const TableToolbar = require( '@ckeditor/ckeditor5-table/src/tabletoolbar.js');
const TextTransformation = require( '@ckeditor/ckeditor5-typing/src/texttransformation.js');
const Title = require( '@ckeditor/ckeditor5-heading/src/title.js');
const TodoList = require( '@ckeditor/ckeditor5-list/src/todolist');
const Underline = require( '@ckeditor/ckeditor5-basic-styles/src/underline.js');
const WordCount = require( '@ckeditor/ckeditor5-word-count/src/wordcount.js');

class Editor extends ClassicEditor {}

// Plugins to include in the build.
Editor.builtinPlugins = [
	Alignment,
	AutoImage,
	Autoformat,
	Autolink,
	Autosave,
	BlockQuote,
	Bold,
	CKFinder,
	CKFinderUploadAdapter,
	Essentials,
	ExportToPDF,
	ExportToWord,
	FontColor,
	FontSize,
	Heading,
	Highlight,
	HtmlEmbed,
	Image,
	ImageCaption,
	ImageInsert,
	ImageResize,
	ImageStyle,
	ImageToolbar,
	ImageUpload,
	Indent,
	Italic,
	Link,
	LinkImage,
	List,
	MediaEmbed,
	MediaEmbedToolbar,
	Paragraph,
	PasteFromOffice,
	SpecialCharacters,
	StandardEditingMode,
	Table,
	TableToolbar,
	TextTransformation,
	Title,
	TodoList,
	Underline,
	WordCount
];

export default Editor;
