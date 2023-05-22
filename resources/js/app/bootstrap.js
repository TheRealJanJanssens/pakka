
import Alpine from 'alpinejs'
import FormsAlpinePlugin from '../../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../../vendor/filament/notifications/dist/module.esm'

import 'flowbite';

import './tailwind/darkmode';
import './tailwind/sidebar';

/****************
//needs to be refactored
import './masonry';
import './charts';
import './popover';
import './scrollbar';
import './search';
import './sidebar';
// import './skycons';
import './vectorMaps';
import './chat';
import './datatable';
// import './datepicker';
import './email';

import './fullcalendar';
import './googleMaps';
import './utils';
import './product';
import './custom/jquery-ui.js';
import './custom/colorpicker.js';
import './custom/dropzone.js';
import './custom/main.js';

*/

Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)

window.Alpine = Alpine

Alpine.start()
