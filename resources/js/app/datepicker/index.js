import * as $ from 'jquery';
/*
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';
*/

import 'btecu-eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js';
import 'btecu-eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css';

export function pickTime(){	
	$('.start-time, .end-time').datetimepicker({
        format: 'LT',
        allowInputToggle: true,
        locale: $('html').attr('lang'),
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
}

export function pickDate(){	
	$('.pick-date').datetimepicker({
		//format: 'DD/MM/YYYY LT',
		sideBySide: true,
		allowInputToggle: true,
        locale: $('html').attr('lang'),
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
}

export default (function () {
	pickTime();
	pickDate();
}())