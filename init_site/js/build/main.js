/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/js/";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);


/***/ },
/* 1 */
/***/ function(module, exports) {

	/**
	 * Functions:
	 * checkUrlName(str,undAllowed,slashAllowed,psetAllowed)
	 * num2str(num)
	 * calcOrderForm(f,check)
	 */

	DHTML = (DOM || IE4);

	/**
	 * displayBlock
	 * @param id
	 * @param pos
	 */
	function displayBlock(id, pos) {
	    var el = D.getElementById(id);

	    if (el) el.style.display = pos ? 'block' : 'none';
	}

	/**
	 * writeBlock
	 * @param id
	 * @param code
	 * @param pos
	 */
	function writeBlock(id, code, pos) {
	    if (DHTML) D.write("<div ID='", id, "' style='padding-left:10;margin-bottom:5;display:", (pos ? 'block' : 'none'), ";'>", code, "</div>");
	}

	/**
	 * Check url_name value
	 * @param str
	 * @param undAllowed
	 * @param slashAllowed
	 * @param psetAllowed
	 * @returns {*}
	 */
	function checkUrlName(str, undAllowed, slashAllowed, psetAllowed) {
	    if (checkInt(str) !== null || toLower(str) == 'index') return null;
	    var l = str.length;
	    if (l > 0 && (str.charAt(0) == '/' || str.charAt(l - 1) == '/')) return null;
	    for (var i = 0; i < l; i++) {
	        var ch = str.charAt(i);
	        if ((ch < '0' || ch > '9') && (ch < 'A' || ch > 'Z') &&
	            (ch < 'a' || ch > 'z') && (ch != '-') && (ch != '.') && !(ch == '/' && slashAllowed) && !(ch == '_' && undAllowed) && !(ch == '.' && psetAllowed)) return null;
	    }
	    return 1;
	}

	/**
	 * Convert number to %.2f string
	 * @param num
	 * @returns {string}
	 */
	function num2str(num) {
	    var str = "" + Math.round(num * 100);
	    var l = str.length - 2;
	    return str.substr(0, l) + "." + str.substr(l, 2);
	}


	/**
	 * Special features array
	 */
	if (!window.ATTRIBUTES) ATTRIBUTES = Array();
	if (!window.PRICING) PRICING = Array();
	// --------------------------------------/

	/**
	 * Check and calculate order form
	 * @param f
	 * @param check
	 * @returns {boolean}
	 */
	function calcOrderForm(f, check) {
	    if (!checkInt(f.quantity.value)) {
	        alert('Incorrect quantity');
	        f.total.value = '';
	        f.quantity.focus();
	        return false
	    }
	    var attributes = ATTRIBUTES[f.product.value];
	    var pricing = PRICING[f.product.value];
	    var quantity = eval(f.quantity.value);
	    var max_quantity = eval(f.max_quantity.value);

	    if (max_quantity && max_quantity != 1000000 && quantity > max_quantity) {
	        alert('Max quantity = ' + max_quantity);
	        f.quantity.value = f.max_quantity.value;
	        f.quantity.focus();
	        calcOrderForm(f);
	        return false;
	    }

	    for (var opt in pricing)
	        if (quantity >= opt && pricing[opt]) {
	            f.price.value = pricing[opt]
	            break;
	        }
	    var total = eval(f.price.value);
	    for (var i in attributes) {
	        var attr = attributes[i];
	        var t = attr["type"];
	        var options = attr["options"];
	        if (t < 2) {
	            var el = f.elements["attr[" + i + "]"];
	            var ind = el.selectedIndex;
	            var opts = el.options;
	            var l = opts.length;
	            for (var j = 1; j < l; j++) displayBlock(opts[j].id + '-block', j == ind)
	            if (ind) total += options[el.options[ind].value];
	            else if (!t && check) {
	                alert('Please choose all required features!');
	                el.focus();
	                return false
	            }
	        }
	        else
	            for (var j in options) {
	                var el = f.elements["attr[" + i + "][" + j + "]"];
	                displayBlock(el.id + '-block', el.checked);
	                if (el.checked) total += options[j];
	            }
	    }
	    if (f.total) f.total.value = num2str(total * quantity);
	}

	/**
	 * checkTopLogin
	 * @param f
	 * @returns {boolean}
	 */
	function checkTopLogin(f) {
	    if (!f.email.value.length) {
	        alert("Enter Username");
	        f.email.select();
	        f.email.focus();
	        return false
	    }
	    if (!checkEmail(f.email.value)) {
	        alert("Incorrect Username. Username is your Email!");
	        f.email.select();
	        f.email.focus();
	        return false
	    }
	    if (!f.password.value.length) {
	        alert("Enter Password");
	        f.password.select();
	        f.password.focus();
	        return false;
	    }

	    f.dologin.value = 1;
	}

	/**
	 * topForgotPassword
	 * @returns {boolean}
	 */
	function topForgotPassword() {
	    f = document.toploginform;
	    if (!f.email.value.length || f.email.value == 'Username') {
	        alert("Enter Username");
	        f.email.select();
	        f.email.focus();
	        return false;
	    }
	    if (!checkEmail(f.email.value)) {
	        alert("Incorrect Username. Username is your Email!");
	        f.email.select();
	        f.email.focus();
	        return false;
	    }
	    f.dologin.value = 0;
	    f.submit();
	}

	(function($j) {

	    $j(function() {
	        var productSlider = $j('#productSlider');


	        if(productSlider.length) {
	            productSlider.slick({
	                dots: true
	            });
	        }


	    });

	})(jQuery);



/***/ }
/******/ ]);
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoibWFpbi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy93ZWJwYWNrL2Jvb3RzdHJhcCA4MGJhY2U0MmZhYzg2MzQxMWVmYiIsIndlYnBhY2s6Ly8vLi9qcy9tYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIiBcdC8vIFRoZSBtb2R1bGUgY2FjaGVcbiBcdHZhciBpbnN0YWxsZWRNb2R1bGVzID0ge307XG5cbiBcdC8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG4gXHRmdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cbiBcdFx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG4gXHRcdGlmKGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdKVxuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuXG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRleHBvcnRzOiB7fSxcbiBcdFx0XHRpZDogbW9kdWxlSWQsXG4gXHRcdFx0bG9hZGVkOiBmYWxzZVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sb2FkZWQgPSB0cnVlO1xuXG4gXHRcdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG4gXHRcdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbiBcdH1cblxuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZXMgb2JqZWN0IChfX3dlYnBhY2tfbW9kdWxlc19fKVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tID0gbW9kdWxlcztcblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGUgY2FjaGVcbiBcdF9fd2VicGFja19yZXF1aXJlX18uYyA9IGluc3RhbGxlZE1vZHVsZXM7XG5cbiBcdC8vIF9fd2VicGFja19wdWJsaWNfcGF0aF9fXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIi9qcy9cIjtcblxuIFx0Ly8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4gXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXygwKTtcblxuXG5cbi8qKiBXRUJQQUNLIEZPT1RFUiAqKlxuICoqIHdlYnBhY2svYm9vdHN0cmFwIDgwYmFjZTQyZmFjODYzNDExZWZiXG4gKiovIiwiLyoqXHJcbiAqIEZ1bmN0aW9uczpcclxuICogY2hlY2tVcmxOYW1lKHN0cix1bmRBbGxvd2VkLHNsYXNoQWxsb3dlZCxwc2V0QWxsb3dlZClcclxuICogbnVtMnN0cihudW0pXHJcbiAqIGNhbGNPcmRlckZvcm0oZixjaGVjaylcclxuICovXHJcblxyXG5ESFRNTCA9IChET00gfHwgSUU0KTtcclxuXHJcbi8qKlxyXG4gKiBkaXNwbGF5QmxvY2tcclxuICogQHBhcmFtIGlkXHJcbiAqIEBwYXJhbSBwb3NcclxuICovXHJcbmZ1bmN0aW9uIGRpc3BsYXlCbG9jayhpZCwgcG9zKSB7XHJcbiAgICB2YXIgZWwgPSBELmdldEVsZW1lbnRCeUlkKGlkKTtcclxuXHJcbiAgICBpZiAoZWwpIGVsLnN0eWxlLmRpc3BsYXkgPSBwb3MgPyAnYmxvY2snIDogJ25vbmUnO1xyXG59XHJcblxyXG4vKipcclxuICogd3JpdGVCbG9ja1xyXG4gKiBAcGFyYW0gaWRcclxuICogQHBhcmFtIGNvZGVcclxuICogQHBhcmFtIHBvc1xyXG4gKi9cclxuZnVuY3Rpb24gd3JpdGVCbG9jayhpZCwgY29kZSwgcG9zKSB7XHJcbiAgICBpZiAoREhUTUwpIEQud3JpdGUoXCI8ZGl2IElEPSdcIiwgaWQsIFwiJyBzdHlsZT0ncGFkZGluZy1sZWZ0OjEwO21hcmdpbi1ib3R0b206NTtkaXNwbGF5OlwiLCAocG9zID8gJ2Jsb2NrJyA6ICdub25lJyksIFwiOyc+XCIsIGNvZGUsIFwiPC9kaXY+XCIpO1xyXG59XHJcblxyXG4vKipcclxuICogQ2hlY2sgdXJsX25hbWUgdmFsdWVcclxuICogQHBhcmFtIHN0clxyXG4gKiBAcGFyYW0gdW5kQWxsb3dlZFxyXG4gKiBAcGFyYW0gc2xhc2hBbGxvd2VkXHJcbiAqIEBwYXJhbSBwc2V0QWxsb3dlZFxyXG4gKiBAcmV0dXJucyB7Kn1cclxuICovXHJcbmZ1bmN0aW9uIGNoZWNrVXJsTmFtZShzdHIsIHVuZEFsbG93ZWQsIHNsYXNoQWxsb3dlZCwgcHNldEFsbG93ZWQpIHtcclxuICAgIGlmIChjaGVja0ludChzdHIpICE9PSBudWxsIHx8IHRvTG93ZXIoc3RyKSA9PSAnaW5kZXgnKSByZXR1cm4gbnVsbDtcclxuICAgIHZhciBsID0gc3RyLmxlbmd0aDtcclxuICAgIGlmIChsID4gMCAmJiAoc3RyLmNoYXJBdCgwKSA9PSAnLycgfHwgc3RyLmNoYXJBdChsIC0gMSkgPT0gJy8nKSkgcmV0dXJuIG51bGw7XHJcbiAgICBmb3IgKHZhciBpID0gMDsgaSA8IGw7IGkrKykge1xyXG4gICAgICAgIHZhciBjaCA9IHN0ci5jaGFyQXQoaSk7XHJcbiAgICAgICAgaWYgKChjaCA8ICcwJyB8fCBjaCA+ICc5JykgJiYgKGNoIDwgJ0EnIHx8IGNoID4gJ1onKSAmJlxyXG4gICAgICAgICAgICAoY2ggPCAnYScgfHwgY2ggPiAneicpICYmIChjaCAhPSAnLScpICYmIChjaCAhPSAnLicpICYmICEoY2ggPT0gJy8nICYmIHNsYXNoQWxsb3dlZCkgJiYgIShjaCA9PSAnXycgJiYgdW5kQWxsb3dlZCkgJiYgIShjaCA9PSAnLicgJiYgcHNldEFsbG93ZWQpKSByZXR1cm4gbnVsbDtcclxuICAgIH1cclxuICAgIHJldHVybiAxO1xyXG59XHJcblxyXG4vKipcclxuICogQ29udmVydCBudW1iZXIgdG8gJS4yZiBzdHJpbmdcclxuICogQHBhcmFtIG51bVxyXG4gKiBAcmV0dXJucyB7c3RyaW5nfVxyXG4gKi9cclxuZnVuY3Rpb24gbnVtMnN0cihudW0pIHtcclxuICAgIHZhciBzdHIgPSBcIlwiICsgTWF0aC5yb3VuZChudW0gKiAxMDApO1xyXG4gICAgdmFyIGwgPSBzdHIubGVuZ3RoIC0gMjtcclxuICAgIHJldHVybiBzdHIuc3Vic3RyKDAsIGwpICsgXCIuXCIgKyBzdHIuc3Vic3RyKGwsIDIpO1xyXG59XHJcblxyXG5cclxuLyoqXHJcbiAqIFNwZWNpYWwgZmVhdHVyZXMgYXJyYXlcclxuICovXHJcbmlmICghd2luZG93LkFUVFJJQlVURVMpIEFUVFJJQlVURVMgPSBBcnJheSgpO1xyXG5pZiAoIXdpbmRvdy5QUklDSU5HKSBQUklDSU5HID0gQXJyYXkoKTtcclxuLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0vXHJcblxyXG4vKipcclxuICogQ2hlY2sgYW5kIGNhbGN1bGF0ZSBvcmRlciBmb3JtXHJcbiAqIEBwYXJhbSBmXHJcbiAqIEBwYXJhbSBjaGVja1xyXG4gKiBAcmV0dXJucyB7Ym9vbGVhbn1cclxuICovXHJcbmZ1bmN0aW9uIGNhbGNPcmRlckZvcm0oZiwgY2hlY2spIHtcclxuICAgIGlmICghY2hlY2tJbnQoZi5xdWFudGl0eS52YWx1ZSkpIHtcclxuICAgICAgICBhbGVydCgnSW5jb3JyZWN0IHF1YW50aXR5Jyk7XHJcbiAgICAgICAgZi50b3RhbC52YWx1ZSA9ICcnO1xyXG4gICAgICAgIGYucXVhbnRpdHkuZm9jdXMoKTtcclxuICAgICAgICByZXR1cm4gZmFsc2VcclxuICAgIH1cclxuICAgIHZhciBhdHRyaWJ1dGVzID0gQVRUUklCVVRFU1tmLnByb2R1Y3QudmFsdWVdO1xyXG4gICAgdmFyIHByaWNpbmcgPSBQUklDSU5HW2YucHJvZHVjdC52YWx1ZV07XHJcbiAgICB2YXIgcXVhbnRpdHkgPSBldmFsKGYucXVhbnRpdHkudmFsdWUpO1xyXG4gICAgdmFyIG1heF9xdWFudGl0eSA9IGV2YWwoZi5tYXhfcXVhbnRpdHkudmFsdWUpO1xyXG5cclxuICAgIGlmIChtYXhfcXVhbnRpdHkgJiYgbWF4X3F1YW50aXR5ICE9IDEwMDAwMDAgJiYgcXVhbnRpdHkgPiBtYXhfcXVhbnRpdHkpIHtcclxuICAgICAgICBhbGVydCgnTWF4IHF1YW50aXR5ID0gJyArIG1heF9xdWFudGl0eSk7XHJcbiAgICAgICAgZi5xdWFudGl0eS52YWx1ZSA9IGYubWF4X3F1YW50aXR5LnZhbHVlO1xyXG4gICAgICAgIGYucXVhbnRpdHkuZm9jdXMoKTtcclxuICAgICAgICBjYWxjT3JkZXJGb3JtKGYpO1xyXG4gICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgIH1cclxuXHJcbiAgICBmb3IgKHZhciBvcHQgaW4gcHJpY2luZylcclxuICAgICAgICBpZiAocXVhbnRpdHkgPj0gb3B0ICYmIHByaWNpbmdbb3B0XSkge1xyXG4gICAgICAgICAgICBmLnByaWNlLnZhbHVlID0gcHJpY2luZ1tvcHRdXHJcbiAgICAgICAgICAgIGJyZWFrO1xyXG4gICAgICAgIH1cclxuICAgIHZhciB0b3RhbCA9IGV2YWwoZi5wcmljZS52YWx1ZSk7XHJcbiAgICBmb3IgKHZhciBpIGluIGF0dHJpYnV0ZXMpIHtcclxuICAgICAgICB2YXIgYXR0ciA9IGF0dHJpYnV0ZXNbaV07XHJcbiAgICAgICAgdmFyIHQgPSBhdHRyW1widHlwZVwiXTtcclxuICAgICAgICB2YXIgb3B0aW9ucyA9IGF0dHJbXCJvcHRpb25zXCJdO1xyXG4gICAgICAgIGlmICh0IDwgMikge1xyXG4gICAgICAgICAgICB2YXIgZWwgPSBmLmVsZW1lbnRzW1wiYXR0cltcIiArIGkgKyBcIl1cIl07XHJcbiAgICAgICAgICAgIHZhciBpbmQgPSBlbC5zZWxlY3RlZEluZGV4O1xyXG4gICAgICAgICAgICB2YXIgb3B0cyA9IGVsLm9wdGlvbnM7XHJcbiAgICAgICAgICAgIHZhciBsID0gb3B0cy5sZW5ndGg7XHJcbiAgICAgICAgICAgIGZvciAodmFyIGogPSAxOyBqIDwgbDsgaisrKSBkaXNwbGF5QmxvY2sob3B0c1tqXS5pZCArICctYmxvY2snLCBqID09IGluZClcclxuICAgICAgICAgICAgaWYgKGluZCkgdG90YWwgKz0gb3B0aW9uc1tlbC5vcHRpb25zW2luZF0udmFsdWVdO1xyXG4gICAgICAgICAgICBlbHNlIGlmICghdCAmJiBjaGVjaykge1xyXG4gICAgICAgICAgICAgICAgYWxlcnQoJ1BsZWFzZSBjaG9vc2UgYWxsIHJlcXVpcmVkIGZlYXR1cmVzIScpO1xyXG4gICAgICAgICAgICAgICAgZWwuZm9jdXMoKTtcclxuICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVsc2VcclxuICAgICAgICAgICAgZm9yICh2YXIgaiBpbiBvcHRpb25zKSB7XHJcbiAgICAgICAgICAgICAgICB2YXIgZWwgPSBmLmVsZW1lbnRzW1wiYXR0cltcIiArIGkgKyBcIl1bXCIgKyBqICsgXCJdXCJdO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheUJsb2NrKGVsLmlkICsgJy1ibG9jaycsIGVsLmNoZWNrZWQpO1xyXG4gICAgICAgICAgICAgICAgaWYgKGVsLmNoZWNrZWQpIHRvdGFsICs9IG9wdGlvbnNbal07XHJcbiAgICAgICAgICAgIH1cclxuICAgIH1cclxuICAgIGlmIChmLnRvdGFsKSBmLnRvdGFsLnZhbHVlID0gbnVtMnN0cih0b3RhbCAqIHF1YW50aXR5KTtcclxufVxyXG5cclxuLyoqXHJcbiAqIGNoZWNrVG9wTG9naW5cclxuICogQHBhcmFtIGZcclxuICogQHJldHVybnMge2Jvb2xlYW59XHJcbiAqL1xyXG5mdW5jdGlvbiBjaGVja1RvcExvZ2luKGYpIHtcclxuICAgIGlmICghZi5lbWFpbC52YWx1ZS5sZW5ndGgpIHtcclxuICAgICAgICBhbGVydChcIkVudGVyIFVzZXJuYW1lXCIpO1xyXG4gICAgICAgIGYuZW1haWwuc2VsZWN0KCk7XHJcbiAgICAgICAgZi5lbWFpbC5mb2N1cygpO1xyXG4gICAgICAgIHJldHVybiBmYWxzZVxyXG4gICAgfVxyXG4gICAgaWYgKCFjaGVja0VtYWlsKGYuZW1haWwudmFsdWUpKSB7XHJcbiAgICAgICAgYWxlcnQoXCJJbmNvcnJlY3QgVXNlcm5hbWUuIFVzZXJuYW1lIGlzIHlvdXIgRW1haWwhXCIpO1xyXG4gICAgICAgIGYuZW1haWwuc2VsZWN0KCk7XHJcbiAgICAgICAgZi5lbWFpbC5mb2N1cygpO1xyXG4gICAgICAgIHJldHVybiBmYWxzZVxyXG4gICAgfVxyXG4gICAgaWYgKCFmLnBhc3N3b3JkLnZhbHVlLmxlbmd0aCkge1xyXG4gICAgICAgIGFsZXJ0KFwiRW50ZXIgUGFzc3dvcmRcIik7XHJcbiAgICAgICAgZi5wYXNzd29yZC5zZWxlY3QoKTtcclxuICAgICAgICBmLnBhc3N3b3JkLmZvY3VzKCk7XHJcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgfVxyXG5cclxuICAgIGYuZG9sb2dpbi52YWx1ZSA9IDE7XHJcbn1cclxuXHJcbi8qKlxyXG4gKiB0b3BGb3Jnb3RQYXNzd29yZFxyXG4gKiBAcmV0dXJucyB7Ym9vbGVhbn1cclxuICovXHJcbmZ1bmN0aW9uIHRvcEZvcmdvdFBhc3N3b3JkKCkge1xyXG4gICAgZiA9IGRvY3VtZW50LnRvcGxvZ2luZm9ybTtcclxuICAgIGlmICghZi5lbWFpbC52YWx1ZS5sZW5ndGggfHwgZi5lbWFpbC52YWx1ZSA9PSAnVXNlcm5hbWUnKSB7XHJcbiAgICAgICAgYWxlcnQoXCJFbnRlciBVc2VybmFtZVwiKTtcclxuICAgICAgICBmLmVtYWlsLnNlbGVjdCgpO1xyXG4gICAgICAgIGYuZW1haWwuZm9jdXMoKTtcclxuICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICB9XHJcbiAgICBpZiAoIWNoZWNrRW1haWwoZi5lbWFpbC52YWx1ZSkpIHtcclxuICAgICAgICBhbGVydChcIkluY29ycmVjdCBVc2VybmFtZS4gVXNlcm5hbWUgaXMgeW91ciBFbWFpbCFcIik7XHJcbiAgICAgICAgZi5lbWFpbC5zZWxlY3QoKTtcclxuICAgICAgICBmLmVtYWlsLmZvY3VzKCk7XHJcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgfVxyXG4gICAgZi5kb2xvZ2luLnZhbHVlID0gMDtcclxuICAgIGYuc3VibWl0KCk7XHJcbn1cclxuXHJcbihmdW5jdGlvbigkaikge1xyXG5cclxuICAgICRqKGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIHZhciBwcm9kdWN0U2xpZGVyID0gJGooJyNwcm9kdWN0U2xpZGVyJyk7XHJcblxyXG5cclxuICAgICAgICBpZihwcm9kdWN0U2xpZGVyLmxlbmd0aCkge1xyXG4gICAgICAgICAgICBwcm9kdWN0U2xpZGVyLnNsaWNrKHtcclxuICAgICAgICAgICAgICAgIGRvdHM6IHRydWVcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfVxyXG5cclxuXHJcbiAgICB9KTtcclxuXHJcbn0pKGpRdWVyeSk7XHJcblxyXG5cblxuXG4vKioqKioqKioqKioqKioqKipcbiAqKiBXRUJQQUNLIEZPT1RFUlxuICoqIC4vanMvbWFpbi5qc1xuICoqIG1vZHVsZSBpZCA9IDFcbiAqKiBtb2R1bGUgY2h1bmtzID0gMFxuICoqLyJdLCJtYXBwaW5ncyI6IjtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7Ozs7Ozs7Ozs7Ozs7QUN0Q0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7OyIsInNvdXJjZVJvb3QiOiIifQ==