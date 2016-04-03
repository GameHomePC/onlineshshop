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


var W=window
var T=top
var D=document

var NOW=new Date()

var allLoaded=0

var TMP


// ---------------------\
// Make sure (ask confirmation)
// ------------------------------------\
function makeSure() {
  return confirm('Are you sure?')
  }
// ------------------------------------/



// -------------------------\
// Error handling functions
// ------------------------------------\
function errorNotAllLoaded() {
  alert("Page was not comletely load. Operation terminated.\nReload the page before continue working.")
  return false
  }

function handleError() {
  return true
  }
function handleErrorAlert() {
  alert("There was an Java-Script error. Operation terminated")
  return true
  }
function disableJSError(w,alert) {
  if (! w) w=window
  w.onerror=alert ? handleErrorAlert : handleError
  }
// ------------------------------------/




// ---------------------\
// Disable context menu
// ------------------------------------\
function handleContext(e) {
  if (e && e.which) return e.which==1
  else return false
  }
function stopContext(w) {
  if (! w) w=window
  var d=w.document
  if (d.captureEvents) d.captureEvents(Event.MOUSEDOWN)
  d.oncontextmenu=d.onmousedown=handleContext
  }
// ------------------------------------/



// ----------------------\
// Make Pull-Down Window
// ------------------------------------\
function makePullDown(source,name,width,height,simple) {
  var win_prop=(simple) ?
	"location=no,toolbar=no,directories=no,menubar=no,status=no,"+
	"scrollbars=no,resizable=no,dependent=no,width="+width+",height="+height :
	"location=no,toolbar=no,directories=no,menubar=yes,status=yes,"+
	"scrollbars=yes,resizable=yes,dependent=no,width="+width+",height="+height
  if (window.screen) {
    var x=Math.floor((screen.width-width)/2)
    var y=Math.floor((screen.height-height)/2)
    win_prop+=",screenX="+x+",screenY="+y+",left="+x+",top="+y
    }
  var win=open(source,name,win_prop)
  win.focus()
  return win
  }
// ------------------------------------/



// -------------------------\
// Create associative array
// ------------------------------------\
function AssocArray() {
  var obj=this.window ? new Object : this
  var argv=AssocArray.arguments
  var l=argv.length
  for (var i=0; i<l; i+=2) obj[argv[i]]=argv[i+1]
  return obj
  }
// ------------------------------------/



// ----------------------\
// Check if already submitted
// ------------------------------------\
function formSubmitOnce(f,formCorrect,period) {
  if (formCorrect===false) return false

  if (period<1) period=5
  if (!f.SubmittedFormID) f.SubmittedFormID=Math.round(Math.random()*1000000)
  var a='Submitted'+f.SubmittedFormID

  if (document[a]) {
    alert('Form is already submitted. If you are still on this page, wait about '+period+' sec and try again.')
    return false
    }

  document[a]=1
  setTimeout('document["'+a+'"]=0',period*1000)
  return true
  }
// ------------------------------------/
