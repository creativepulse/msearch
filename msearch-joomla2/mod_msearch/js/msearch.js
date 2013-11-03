
/**
 * mod_msearch
 *
 * @version 1.2
 * @author Creative Pulse
 * @copyright Creative Pulse 2010-2013
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link http://www.creativepulse.gr
 */


function mod_msearch_h_submit(frm) {
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
    var qsite = encodeURIComponent(frm.q.value + " site:" + document.mod_msearch_site_url).replace(/%20/g, "+");

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

        case "virtuemart":
            frm.action = document.mod_msearch_vm_link;
            frm.method = "get";
        
            var inp = document.createElement("input");
            inp.setAttribute("type", "hidden");
            inp.setAttribute("name", "keyword");
            inp.setAttribute("value", q);
            frm.appendChild(inp);

            return true;

            break;

        case "joomla":
        default:
            frm.action = document.mod_msearch_site_url;
            frm.method = "get";

            var inp = document.createElement("input");
            inp.setAttribute("type", "hidden");
            inp.setAttribute("name", "option");
            inp.setAttribute("value", "com_search");
            frm.appendChild(inp);

            var inp = document.createElement("input");
            inp.setAttribute("type", "hidden");
            inp.setAttribute("name", "searchword");
            inp.setAttribute("value", q);
            frm.appendChild(inp);

            return true;
    }

    return false;
}

