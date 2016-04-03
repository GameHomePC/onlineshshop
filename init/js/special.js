/*
// ============================================================================\

Functions:
	autoRefresh()
	setUserOnline()
	changePortion(sel)
	checkFilled(field,alertMessage)

// ============================================================================/
*/



// ------------------------------------\
// Special online monitoring functions
// ------------------------------------\
var SET_USER_ONLINE_IMG
var userActive=new Array(0,1)

function setUserActive(e) {
  if (!W.CONTROL_USER_ACTIVITY) return
  userActive[0]=userActive[1]=1
  if (D.releaseEvents) D.releaseEvents(Event.MOUSEMOVE)
  W.onfocus=D.onmousemove=D.onkeydown=null
  }

function setUserPassive(n) {
  userActive[n]=1
  if (!W.CONTROL_USER_ACTIVITY) return
  userActive[n]=0
  if (D.captureEvents) D.captureEvents(Event.MOUSEMOVE)
  setTimeout("W.onfocus=D.onmousemove=D.onkeydown=setUserActive",100)
  }

function autoRefresh() {
  if (userActive[0]) location.reload()
  setUserPassive(0)
  if (W.AUTO_REFRESH_TIME) setTimeout("autoRefresh()",AUTO_REFRESH_TIME)
  }

function setUserOnline() {
  if (userActive[1]) {
    var IMG=new Image
    IMG.src=SET_USER_ONLINE_IMG
    }
  setUserPassive(1)
  if (W.AUTO_ONLINE_TIME) setTimeout("setUserOnline()",AUTO_ONLINE_TIME)
  }
// ------------------------------------/



// ---------------------------------\
// See special.php, make_page_bar()
// ------------------------------------\
function changePortion(sel) {
  var f=sel.form
  var pageURL=f.pageURL.value
  var oldInd=eval(f.oldIndex.value)
  var ind=sel.selectedIndex;
  if (ind!=oldInd) location.href=pageURL+sel.options[ind].value
  }
// ------------------------------------/


// ----------------------\
// Check if field is filled
// ------------------------------------\
function checkFilled(field,alertMessage) {
  if (! field.value.length) {
    alert((alertMessage!=null) ? alertMessage : "Empty value is no allowed!")
    field.focus()
    return false
    }
  return true
  }
// ------------------------------------/

