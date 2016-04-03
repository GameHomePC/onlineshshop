/*
// ============================================================================\

Special data structure and functions

// ============================================================================/
*/


// ------------------------------------\
// Must be defined as property of form
// ------------------------------------\
function CheckStruct(errBadValue,errNotChange,errNotChoose,askConfirm,checkValue,
		errNotEmpty,errAddDenied,allObjList,childForm) {
  var obj=this.window ? new Object : this

  obj.errBadValue=errBadValue
  obj.errNotChange=errNotChange
  obj.errNotChoose=errNotChoose
  obj.askConfirm=askConfirm

  obj.checkValue=checkValue	// Function for value checking

  obj.errNotEmpty=errNotEmpty
  obj.errAddDenied=errAddDenied

  obj.allObjList=allObjList
  obj.childForm=childForm

  obj.oldVal=""
  obj.forDelete=0
  obj.currObj=0

  return obj
  }
// ------------------------------------/


// ------------------------------------\
function changeObj(sel) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (! (sel && sel.form)) sel=this
  var f=sel.form
  var ind=sel.selectedIndex
  var CS=f.checkStruct
  CS.oldVal=f.name.value=ind ? sel.options[ind].text : ""
  }
// ------------------------------------/


// ------------------------------------\
function changeID(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  var CS=f.checkStruct
  if (CS.forDelete) return true
  var sel=f.ID
  if (f.oldID.value==sel.options[sel.selectedIndex].value) {
    location.href="#edit"
    return false
    }
  }
// ------------------------------------/


// ------------------------------------\
function checkValue(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  var CS=f.checkStruct
  var val=f.name.value
  if (!val.length || (CS.checkValue && !CS.checkValue(val))) return false
  var ID=f.ID
  var ind=ID.selectedIndex
  var opt=ID.options
  var l=opt.length
  for (var i=1; i<l; i++)
    if (i!=ind && val==opt[i].text) return false
  return true
  }
// ------------------------------------/


// ------------------------------------\
function checkChange(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  var CS=f.checkStruct
  if (CS.forDelete) return true
  if (f.ID.selectedIndex && f.name.value==CS.oldVal) {
    alert(CS.errNotChange)
    return false
    }
  if (!checkValue(f)) {
    alert(CS.errBadValue)
    f.name.focus()
    f.name.select()
    return false
    }
  }
// ------------------------------------/


// ------------------------------------\
function checkDelete(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  var CS=f.checkStruct
  if (f.ID.selectedIndex) {
    if (confirm(CS.askConfirm)) {
      CS.forDelete=1
      return true
      }
    }
  else alert(CS.errNotChoose)
  return false
  }
// ------------------------------------/

