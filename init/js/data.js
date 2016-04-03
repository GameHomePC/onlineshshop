/*
// ============================================================================\

Date format:
	format=0 - dd.mm.yyyy
	format=1 - mm.dd.yyyy

Functions:
	toUpper(str)
	toLower(str)
	checkInt(str)
	checkFloat(str)
	checkZip(str)
	checkEmail(str)
	checkIP(str)
	getDate(str,format)
	getTime(str)
	cmpDate(str1,str2,format)
	cmpTime(str1,str2)
	getDateStr(date,format)
	getTimeStr(date)
	getFullYear(date)

// ============================================================================/
*/



// -----------\
// Converting 
// ------------------------------------\
// (KOI8-R)
//var lowMaskStr="qwertyuiopasdfghjklzxcvbnm_ÊÃÕËÅÎÇÛİÚÈÆÙ×ÁĞÒÏÌÄÖÜÑŞÓÍÉÔØÂÀß"
//var uppMaskStr="QWERTYUIOPASDFGHJKLZXCVBNM_êãõëåîçûıúèæù÷áğòïìäöüñşóíéôøâàÿ"
// (CP-1251)
 var lowMaskStr="qwertyuiopasdfghjklzxcvbnm_êãõëåîçûıúèæù÷áğòïìäöüñşóíéôøâàÿ"
 var uppMaskStr="QWERTYUIOPASDFGHJKLZXCVBNM_ÊÃÕËÅÎÇÛİÚÈÆÙ×ÁĞÒÏÌÄÖÜÑŞÓÍÉÔØÂÀß"
// ------------------------------------/

// ----------------------\
// Convert to upper case
// ------------------------------------\
function toUpper(str) {
  var str1=""
  var l=str.length
  for (var i=0; i<l; i++) {
    var ch=str.charAt(i)
    var ind=lowMaskStr.indexOf(ch)
    str1+=(ind==-1) ? ch : uppMaskStr.charAt(ind)
    }
  return str1
  }
// ------------------------------------/

// ------------------------\
// Convert to lower case
// ------------------------------------\
function toLower(str) {
  var str1=""
  var l=str.length
  for (var i=0; i<l; i++) {
    var ch=str.charAt(i)
    var ind=uppMaskStr.indexOf(ch)
    str1+=(ind==-1) ? ch : lowMaskStr.charAt(ind)
    }
  return str1
  }
// ------------------------------------/



// --------------------\
// Check integer value
// ------------------------------------\
function checkInt(str) {
  var l=str.length
  if (!l) return null
  for (var i=0; i<l; i++) {
    var ch=str.charAt(i)
    if (ch<'0' || ch>'9') return null
    }
  return eval(str)
  }
// ------------------------------------/



// ------------------\
// Check float value
// ------------------------------------\
function checkFloat(str) {
  var l=str.length
  if (!l) return null
  var point=0
  for (var i=0; i<l; i++) {
    var ch=str.charAt(i)
    if (ch=='.')
      if (point) return null
      else point=1
    else 
      if (ch<'0' || ch>'9') return null
    }
  return eval(str)
  }
// ------------------------------------/




// ----------------\
// Check ZIP value
// ------------------------------------\
function checkZip(str) {
  return (str.length==5 && checkInt(str))
  }
// ------------------------------------/



// -------------------\
// Check E-mail value
// ------------------------------------\
function checkEmail(str) {
  var l=str.length
  if (!l) return false
  var ata=0
  var point=0
  var cch=''
  for (var i=0; i<l; i++) {
    var ch=str.charAt(i)
    if (ch=='@')
      if (ata==1 || i==0 || cch=='.') return false
      else ata=1
    else if (ch=='.')
      if (cch=='.' || cch=='@' || i==l-1 || i==0) return false
      else point=ata
    else if ((ch<'A' || ch>'Z') && (ch<'a' || ch>'z') &&
		(ch<'0' || ch>'9') && (ch!='_') && (ch!='-')) return false
    cch=ch
    }
  return (ata && point)
  }
// ------------------------------------/
 

// ---------\
// Check IP
// ------------------------------------\
function checkIP(str) {
  if (!str.length) return false
  var arr=str.split('.')
  if (arr.length!=4) return false
  var s=0
  for (var i=0; i<4; i++) {
    var val=checkInt(arr[i])
    if (val==null || val>255) return false
    s=s*256+val
    }
  return s
  }
// ------------------------------------/
 


// -----------------------------\
// Check date and get its parts
// ------------------------------------\
function getDate(str,format) {
  if (format==null) format=W.DATE_FORMAT
  var mlen=Array(31,28,31,30,31,30,31,31,30,31,30,31)
  var l=str.length
  var dd=str.substr(0,2)
  var mm=str.substr(3,2)
  var yy=str.substr(6,4)
  if (format) { var tmp=dd; dd=mm; mm=tmp }
  var d=checkInt(dd)
  var m=checkInt(mm)
  var y=checkInt(yy)
  var ml=mlen[m-1]+1+
	((m==2 && (y%400==0 || (y%4==0 && y%100!=0))) ? 1 : 0)
  var res=
    (l==10 && str.charAt(2)=="." && str.charAt(5)=="." && d && d<ml && m && m<13 && y) ? 
	Array(yy,mm,dd) : false
  return res
  }
// ------------------------------------/


// -------------------------------------\
// Check time (hh:mm) and get its parts
// ------------------------------------\
function getTime(str) {
  var l=str.length
  var hh=str.substr(0,2)
  var mm=str.substr(3,2)
  var h=checkInt(hh)
  var m=checkInt(mm)
  var res=
    (l==5 && str.charAt(2)==":" && h!=null && h<24 && m!=null && m<60) ?
	Array(hh,mm) : false
  return res
  }
// ------------------------------------/


// --------------\
// Compare dates
// ------------------------------------\
function cmpDate(str1,str2,format) {
  var date1=getDate(str1,format)
  var date2=getDate(str2,format)
  if (! date1) return -1
  if (! date2) return -2
  date1=eval(date1.join(''))
  date2=eval(date2.join(''))
  if (date1>date2) return 1
  else if (date2>date1) return 2
  else return 0
  }
// ------------------------------------/


// --------------\
// Compare times
// ------------------------------------\
function cmpTime(str1,str2) {
  var time1=getTime(str1)
  var time2=getTime(str2)
  if (! time1) return -1
  if (! time2) return -2
  time1=eval(time1.join(''))
  time2=eval(time2.join(''))
  if (time1>time2) return 1
  else if (time2>time1) return 2
  else return 0
  }
// ------------------------------------/


// ---------------------------------\
// Get dd.mm.yyyy/mm.dd.yyyy string
// ------------------------------------\
function getDateStr(date,format) {
  if (! date) date=new Date
  if (format==null) format=W.DATE_FORMAT
  var dd=date.getDate()
  var mm=date.getMonth()+1
  var yy=date.getYear()
  if (dd<10) dd="0"+dd
  if (mm<10) mm="0"+mm
  if (format) { var tmp=dd; dd=mm; mm=tmp }
  return (""+dd+"."+mm+"."+yy)
  }
// ------------------------------------/


// ----------------------\
// Get hh:mm string
// ------------------------------------\
function getTimeStr(date) {
  if (! date) date=new Date
  var hh=date.getHours()
  var mm=date.getMinutes()
  if (hh<10) hh="0"+hh
  if (mm<10) mm="0"+mm
  return (""+hh+":"+mm)
  }
// ------------------------------------/


// ----------------------\
// Get hh:mm string
// ------------------------------------\
function getFullYear(date) {
  if (! date) date=new Date
  var y=date.getYear()
  if (y<1000) y+=1900
  return y
  }
// ------------------------------------/

