/*
 // ============================================================================\

 Functions:
 makeSure()
 errorNotAllLoaded()
 handleError()
 handleErrorAlert()
 disableJSError(w,alert)
 handleContext(e)
 stopContext(w)
 makePullDown(source,name,width,height)
 AssocArray()
 formSubmitOnce(f[,true|false,[time]])

 // ============================================================================/
 */


var W = window;
var T = top;
var D = document;

var NOW = new Date();

var allLoaded = 0;

var TMP;


/**
 * Make sure (ask confirmation)
 * @returns {*}
 */
function makeSure() {
    return confirm('Are you sure?');
}

/**
 * Error handling functions
 * @returns {boolean}
 */
function errorNotAllLoaded() {
    alert("Page was not comletely load. Operation terminated.\nReload the page before continue working.");
    return false;
}

/**
 * handleError
 * @returns {boolean}
 */
function handleError() {
    return true;
}

/**
 * handleErrorAlert
 * @returns {boolean}
 */
function handleErrorAlert() {
    alert("There was an Java-Script error. Operation terminated");
    return true
}

/**
 * disableJSError
 * @param w
 * @param alert
 */
function disableJSError(w, alert) {
    if (!w) w = window;
    w.onerror = alert ? handleErrorAlert : handleError;
}

/**
 * Disable context menu
 * @param e
 * @returns {boolean}
 */
function handleContext(e) {
    if (e && e.which) return e.which == 1;
    else return false;
}

/**
 * stopContext
 * @param w
 */
function stopContext(w) {
    if (!w) w = window;
    var d = w.document;
    if (d.captureEvents) d.captureEvents(Event.MOUSEDOWN);
    d.oncontextmenu = d.onmousedown = handleContext;
}

/**
 * Make Pull-Down Window
 * @param source
 * @param name
 * @param width
 * @param height
 * @param simple
 * @returns {*|Window}
 */
function makePullDown(source, name, width, height, simple) {
    var win_prop = (simple) ?
    "location=no,toolbar=no,directories=no,menubar=no,status=no," +
    "scrollbars=no,resizable=no,dependent=no,width=" + width + ",height=" + height :
    "location=no,toolbar=no,directories=no,menubar=yes,status=yes," +
    "scrollbars=yes,resizable=yes,dependent=no,width=" + width + ",height=" + height;
    if (window.screen) {
        var x = Math.floor((screen.width - width) / 2);
        var y = Math.floor((screen.height - height) / 2);
        win_prop += ",screenX=" + x + ",screenY=" + y + ",left=" + x + ",top=" + y
    }
    var win = open(source, name, win_prop);
    win.focus();
    return win;
}

/**
 * Create associative array
 * @returns {Object}
 * @constructor
 */
function AssocArray() {
    var obj = this.window ? new Object : this;
    var argv = AssocArray.arguments;
    var l = argv.length;
    for (var i = 0; i < l; i += 2) obj[argv[i]] = argv[i + 1]
    return obj;
}

/**
 * Check if already submitted
 * @param f
 * @param formCorrect
 * @param period
 * @returns {boolean}
 */
function formSubmitOnce(f, formCorrect, period) {
    if (formCorrect === false) return false;

    if (period < 1) period = 5;
    if (!f.SubmittedFormID) f.SubmittedFormID = Math.round(Math.random() * 1000000);
    var a = 'Submitted' + f.SubmittedFormID;

    if (document[a]) {
        alert('Form is already submitted. If you are still on this page, wait about ' + period + ' sec and try again.');
        return false;
    }

    document[a] = 1;
    setTimeout('document["' + a + '"]=0', period * 1000);
    return true;
}

/**
 * checkEmail
 * @param str
 * @returns {*}
 */
function checkEmail(str) {
    var l = str.length;
    if (!l) return false;
    var ata = 0;
    var point = 0;
    var cch = '';
    for (var i = 0; i < l; i++) {
        var ch = str.charAt(i);
        if (ch == '@')
            if (ata == 1 || i == 0 || cch == '.') return false;
            else ata = 1;
        else if (ch == '.')
            if (cch == '.' || cch == '@' || i == l - 1 || i == 0) return false;
            else point = ata;
        else if ((ch < 'A' || ch > 'Z') && (ch < 'a' || ch > 'z') &&
            (ch < '0' || ch > '9') && (ch != '_') && (ch != '-')) return false;
        cch = ch
    }
    return (ata && point)
}

/**
 * checkLogin
 * @param f
 * @param remind
 * @returns {boolean}
 */
function checkLogin(f, remind) {
    if (remind == 2 && f.doreset.value == '1') {
        alert('Please, wait 5 sec. and click this button again');
        return false
    }
    if (!checkEmail(f.email.value)) {
        alert('Please enter valid email!');
        f.email.focus();
        f.email.select();
        return false;
    }
    if (!(remind || f.password.value.length)) {
        alert('Please enter the password');
        f.password.focus();
        return false;
    }
    if (remind == 2)
        if (confirm('Are you sure?')) {
            f.doreset.value = '1';
            setTimeout('document.login.doreset.value="0"', 5000);
            return true;
        }
        else
            return false;

    return true;
}

/**
 * checkRegister
 * @param f
 * @returns {boolean}
 */
function checkRegister(f) {
    if (!checkEmail(f.email.value)) {
        alert('Please enter valid email!');
        f.email.focus();
        f.email.select();
        return false
    }
    if (!f.password.value.length) {
        alert('Please enter the password');
        f.password.focus();
        return false;
    }
    if (f.password.value!=f.password1.value) {
        alert('Password is not confirmed');
        f.password1.focus();
        f.password1.select();
        return false;
    }
    return true;
}

/**
 * scrollToBox
 * @param elements
 */
function scrollToBox(elements) {
    if(!$(elements).length) return false;

    $('html, body').animate({
        scrollTop: $(elements).offset().top
    })
}


function sendMail(elementForm) {

    elementForm.on('submit', function(e) {
        var self = $(this);

        self.addClass('spinner');

        $.ajax({
            method: 'POST',
            url: 'send.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function() {
                self.removeClass('spinner');
            }
        });

        return false;

    });

}

(function($j) {

    $j(function() {

        var footerForm = $j('#footerSend');

        if(footerForm.length) {

            sendMail(footerForm);

        }

    });

})(jQuery);
