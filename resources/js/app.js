require('./bootstrap');
require('./stisla/stisla-scripts');
require('./stisla/stisla-custom');

require('tinymce');
require('tinymce/themes/silver');
require('tinymce/plugins/paste');
require('tinymce/plugins/advlist');
require('tinymce/plugins/autolink');
require('tinymce/plugins/lists');
require('tinymce/plugins/link');
require('tinymce/plugins/image');
require('tinymce/plugins/charmap');
require('tinymce/plugins/print');
require('tinymce/plugins/preview');
require('tinymce/plugins/anchor');
require('tinymce/plugins/textcolor');
require('tinymce/plugins/searchreplace');
require('tinymce/plugins/visualblocks');
require('tinymce/plugins/code');
require('tinymce/plugins/fullscreen');
require('tinymce/plugins/insertdatetime');
require('tinymce/plugins/media');
require('tinymce/plugins/table');
require('tinymce/plugins/contextmenu');
require('tinymce/plugins/code');
require('tinymce/plugins/help');
require('tinymce/plugins/wordcount');

// require('./datatables/datatables');

import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';
import toastr from 'toastr';
window.Swal = Swal;
window.Chart = Chart;
window.toastr = toastr;

import * as FilePond from 'filepond';

// Import the plugin code
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';
import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';

window.FilePond = FilePond;
window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginFileValidateSize = FilePondPluginFileValidateSize;
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;
window.FilePondPluginImageResize = FilePondPluginImageResize;
window.FilePondPluginImageValidateSize = FilePondPluginImageValidateSize;
window.FilePondPluginImageExifOrientation = FilePondPluginImageExifOrientation;
window.FilePondPluginFileEncode = FilePondPluginFileEncode;