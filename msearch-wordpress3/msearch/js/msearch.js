
/**
 * Multi Search
 *
 * @version 1.3
 * @author Creative Pulse
 * @copyright Creative Pulse 2010-2014
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link http://www.creativepulse.gr
 */


function wdg_msearch_h_submit(frm) {
	frm.q.value = frm.q.value.replace(/^\s+|\s+$/g, '');

	var method = frm.typ.value;
	if (!method) {
		for (var i = 0, len = frm.typ.length; i < len; i++) {
			if (frm.typ[i].checked) {
				method = frm.typ[i].value;
				break;
			}
		}
	}

	if (frm.q.value == "" || !method) {
		return false;
	}

	var q = encodeURIComponent(frm.q.value).replace(/%20/g, "+");
	var qsite = encodeURIComponent(frm.q.value + " site:" + document.wdg_msearch_site_url).replace(/%20/g, "+");

	switch (method) {
		case "google":
			window.location = "http://www.google.com/search?q=" + q;
			break;

		case "googlesite":
			window.location = "http://www.google.com/search?q=" + qsite;
			break;

		case "yahoo":
			window.location = "http://search.yahoo.com/search?p=" + q;
			break;

		case "yahoosite":
			window.location = "http://search.yahoo.com/search?p=" + qsite;
			break;

		case "bing":
			window.location = "http://www.bing.com/search?q=" + q;
			break;

		case "bingsite":
			window.location = "http://www.bing.com/search?q=" + qsite;
			break;

		case "wordpress":
		default:
			window.location = document.wdg_msearch_site_url + "?s=" + q;
	}

	return false;
}

