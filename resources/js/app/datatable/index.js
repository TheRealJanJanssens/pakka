import * as $ from 'jquery';
import 'datatables';

export default (function () {
  $('#dataTable').DataTable({
	  	info: false,
	  	lengthChange: false,
		language: {
			// 'url' : 'https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json'
			// More languages : http://www.datatables.net/plug-ins/i18n/
		},
		"oLanguage": {
			"sSearch": ""
		},
		aaSorting: []
	});
}());
