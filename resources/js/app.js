import './bootstrap';
import flatpickr from "flatpickr";
import "flatpickr/dist/l10n/ja.js";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

flatpickr(document.getElementById('due_date'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
});
