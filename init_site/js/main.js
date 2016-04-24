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


        $j(window).on('load', function() {

            var header = $j('.header'),
                headerFix = $j('#headerFix'),
                headerHeight = header.outerHeight(true),
                headerFixHeight = headerFix.parent().outerHeight(true),
                headerPositionTop = header.offset().top,
                headerFixPosition = headerFix.offset().top,
                headerFixPositionBottom = headerFixPosition + headerFixHeight,
                headerPositionBottom = headerPositionTop + headerHeight;

            function scrollInit() {
                var self = $j(this),
                    selfScrollTop = self.scrollTop();

                headerFix.parent().css({
                    height: headerFix.height()
                });

                if(selfScrollTop >= headerFixPosition) {
                    headerFix.addClass('fixed');

                    if(selfScrollTop >= headerPositionBottom - headerFixHeight) {
                        headerFix.addClass('shadow');
                    } else {
                        headerFix.removeClass('shadow');
                    }

                } else {
                    headerFix.removeClass('fixed');
                }
            }

            $j(window).on('scroll', scrollInit).trigger('scroll');
            $j(window).on('resize', scrollInit).trigger('resize');

        });
    });

})(jQuery);

