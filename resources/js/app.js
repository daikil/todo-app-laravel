import './bootstrap';
import flatpickr from "flatpickr";
import "flatpickr/dist/l10n/ja.js";

/* flatpickr(指定要素名, オプション) */
flatpickr(document.getElementById('due_date'), {
    /* 言語設定：日本語を指定 */
    locale: 'ja',
    /* 日付形式：年月日を指定 */
    dateFormat: "Y/m/d",
    /* 開始日設定（選択日付の最小値）：現在日より過去日付を制限するに指定 */
    minDate: new Date()
});
