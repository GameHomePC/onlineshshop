/*
// ============================================================================\

Functions (constructors):
  Rollover(name,dir,current,disable_roll_current,
	imgs_off,imgs_on,imgs_off_current,imgs_on_transparent,
	nn_document,preload)

  Layer(name,nn_document)

  DropDownMenu(name,centeredWidth,delayOff,
	hSubLeft,hSubTop,subLeft,subTop,subWidth,
	bgColor,headHTML,tailHTML,hItemDelimHTML,
	subBgColor,subHoverColor,subHeadHTML,subTailHTML,itemDelimHTML,
	hItemHoverColor,hItemHeadHTML,hItemTailHTML,hItemLinkClass,hItemLinkAttrs,
	itemHoverColor,itemHeadHTML,itemTailHTML,itemLinkClass,itemLinkAttrs,
	rollover,items)

  Item(text,href,target,
	bgColor,hoverColor,headHTML,tailHTML,linkClass,linkAttrs,beforeHTML,afterHTML,
	subMenu)

  SubMenu(left,top,width,bgColor,hoverColor,headHTML,tailHTML,itemDelimHTML,
	itemHoverColor,itemHeadHTML,itemTailHTML,itemLinkClass,itemLinkAttrs,
	rollover,items)
  or SubMenu(direction,alignment,...) 
	direction='[value][+/-offset]'
		t - top
		b - bottom
		v - vertical ('t' or 'b' choosed automatically)
		l - left
		b - right
		h - horizontal ('l' or 'r' choosed automatically)
	alignment='[value][+/-offset]'
		b - begin
		c - center
		e - end
		a - auto

// ============================================================================/
*/



var tStr='string'



// ========================\
// Special DHTML functions
// ============================================================================\

var DOM=D.getElementById ? 1 : 0;
var IE4=D.all ? 1 : 0
var NN4=D.layers ? 1 : 0
var DHTML=(DOM || IE4 || NN4)


var LAYERS=[]
var ROLL=[]
var MENU=[]


if (!DOM) D.getElementById=function (id) { return (IE4 ? D.all[id] : null) }


// -------------------------------\
// Create special rollover object
// ----------------------------------------------------------------------------\
function Rollover(name,dir,current,disable_roll_current,
	imgs_off,imgs_on,imgs_off_current,imgs_on_transparent,
	nn_document,preload) {
  var obj=this.window ? {} : this
  obj.name=name
  obj.rollover=(D.images && imgs_off)
  obj.dir=dir
  if (IE4 && imgs_on_transparent) imgs_on=imgs_on_transparent
  obj.imgs=[]
  for (var i in imgs_off) obj.imgs[i]=[imgs_off[i],imgs_on[i]]
  if (current>=0) {
    var curr=obj.imgs[current]
    if (imgs_off_current) curr[0]=imgs_off_current[current]
    if (disable_roll_current) curr[1]=curr[0]
    }
  obj.nn_document=nn_document
  obj.TMP=[]
// ------------------------------------\
  obj.preload=function() {
    if (this.rollover) {
      var tmp=this.TMP
      var dir=this.dir
      var imgs=this.imgs
      for (var i in imgs)
	if (imgs[i][0]) (tmp[i]=new Image).src=dir+'/'+imgs[i][1]
      }
    }
// ------------------------------------/
// ------------------------------------\
  obj.Switch=function(num,pos,nn_document) {
    var t=this
    if (!nn_document) nn_document=t.nn_document
    var d=(NN4 && nn_document) ? eval(nn_document) : D
    var img=d.images[t.name+num]
    var im=t.imgs[num]
    if (t.rollover && img && im && im[0]) img.src=t.dir+'/'+im[pos ? 1 : 0]
    }
// ------------------------------------/
  if (preload!=0) obj.preload()
  W.ROLL[name]=obj
  return obj
  }
// ----------------------------------------------------------------------------/



// ---------------------\
// Special layer object
// ----------------------------------------------------------------------------\
function Layer(name,nn_document) {
  var obj=this.window ? {} : this
  obj.name=name
  obj.nn_document=nn_document+'.layers.'+name+'.document'
  var l=null
  var d=(NN4 && nn_document) ? eval(nn_document) : D
  if (DHTML) l=DOM ? D.getElementById(name) : d[IE4 ? 'all' : 'layers'][name]
  obj.layer=l
  obj.properties=(l && !NN4) ? l['style'] : l
// ------------------------------------\
  obj.params=function(left,top,layerLeft,layerTop,pageLeft,pageTop,width,height) {
    var t=this
    var l=t.layer
    var p=t.properties
    if (!l) return null
    var x,y,layerX,layerY,pageX,pageY,w,h
    // ------------|
    if (NN4) {
      x=l.left
      y=l.top
      layerX=pageX=l.pageX
      layerY=pageY=l.pageY
      var pL=l.parentLayer
      if (pL!=W) {
	layerX-=pL.pageX
	layerY-=pL.pageY
	}
      var d=l.document
      w=d.width
      h=d.height
// =============\
// VERY SPECIAL |
// ====================================\
var l1
if (l1=d.layers['layerBody']) {
  d=l1.document
  w=d.width
  h=d.height
  }
if ((l1=d.layers['layerWidth']) && (l1.document.width>w)) w=l1.document.width
// ====================================/
      }
    else {
      x=parseInt(p.left) || 0
      y=parseInt(p.top) || 0
      layerX=pageX=l.offsetLeft
      layerY=pageY=l.offsetTop
      var pL=l
      while (pL=pL.offsetParent) {
	pageX+=pL.offsetLeft
	pageY+=pL.offsetTop
	}
      w=l.offsetWidth
      h=l.offsetHeight
      }
    // ------------|
    if (left!=null) p.left=(typeof(left)==tStr) ? eval(x+'+('+left+')') : left
    if (top!=null) p.top=(typeof(top)==tStr) ? eval(y+'+('+top+')') : top
    if (layerLeft!=null) p.left=eval(x+'+('+layerLeft+')')-(typeof(layerLeft)!=tStr)*layerX
    if (layerTop!=null) p.top=eval(y+'+('+layerTop+')')-(typeof(layerTop)!=tStr)*layerY
    if (pageLeft!=null) p.left=eval(x+'+('+pageLeft+')')-(typeof(pageLeft)!=tStr)*pageX
    if (pageTop!=null) p.top=eval(y+'+('+pageTop+')')-(typeof(pageTop)==tStr)*pageY
    if (!NN4) {
      if (width!=null) p.width=width
      if (height!=null) p.height=height
      }
    // ------------|
    return {
	left: x,
	top: y,
	layerLeft: layerX,
	layerTop: layerY,
	pageLeft: pageX,
	pageTop: pageY,
	width: w,
	height: h
	}
    }
// ------------------------------------/
// ------------------------------------\
  obj.color=function(color) {
    var t=this
    var p=t.properties
    if (!p) return null
    var c=NN4 ? p.bgColor : p.backgroundColor
    if (color!=null) p[NN4 ? 'bgColor' : 'backgroundColor']=(NN4 && !color) ? null : color
    return c
    }
// ------------------------------------/
// ------------------------------------\
  obj.visibility=function(pos) {
    var t=this
    var p=t.properties
    if (!p) return null
    var v=(p.visibility.substr(0,3)=='hid') ? 0 : 1;
    if (pos!=null) p.visibility=pos ? 'visible' : 'hidden'
    return v
    }
// ------------------------------------/
  return obj
  }
// ----------------------------------------------------------------------------/



// ===============\
// Drop-down menu
// ============================================================================\

// -------------\
// VERY SPECIAL
// ----------------------------------------------------------------------------\
var SCREEN={
  size: 0,
  params: function() {
    if (!DHTML) return null
    var size=this.size.params()
    var x=NN4 ? pageXOffset : D.body.scrollLeft
    var y=NN4 ? pageYOffset : D.body.scrollTop
    return {
	left: x,
	top: y,
	width: size.width,
	height: size.height
	}
    }
  }
// ----------------------------------------------------------------------------/


// -------------------\
// Create menu object
// ----------------------------------------------------------------------------\
function DropDownMenu(name,centeredWidth,delayOff,
	hSubLeft,hSubTop,subLeft,subTop,subWidth,
	bgColor,headHTML,tailHTML,hItemDelimHTML,
	subBgColor,subHoverColor,subHeadHTML,subTailHTML,itemDelimHTML,
	hItemHoverColor,hItemHeadHTML,hItemTailHTML,hItemLinkClass,hItemLinkAttrs,
	itemHoverColor,itemHeadHTML,itemTailHTML,itemLinkClass,itemLinkAttrs,
	rollover,items) {
  var obj=this.window ? {} : this
  obj.allItems=[]
  obj.z=1
  // --------------|
  obj.name=name
  obj.centeredWidth=centeredWidth
  obj.delayOff=(delayOff>0) ? delayOff : 0
  obj.hSubLeft=hSubLeft
  obj.hSubTop=hSubTop
  obj.subLeft=subLeft
  obj.subTop=subTop
  obj.subWidth=subWidth
  obj.bgColor=(bgColor || '')
  obj.headHTML=(typeof(headHTML)==tStr) ? headHTML : '<table border=0 cellspacing=0 cellpadding=0><tr><td>'
  obj.tailHTML=(typeof(tailHTML)==tStr) ? tailHTML : '</td></tr></table>'
  obj.hItemDelimHTML=(typeof(hItemDelimHTML)==tStr) ? hItemDelimHTML : '</td><td>'
  obj.subBgColor=(subBgColor || '')
  obj.subHoverColor=(subHoverColor || '')
  obj.subHeadHTML=(typeof(subHeadHTML)==tStr) ? subHeadHTML : '<table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td width=100%>'
  obj.subTailHTML=(typeof(subTailHTML)==tStr) ? subTailHTML : '</td></tr></table>'
  obj.itemDelimHTML=(typeof(itemDelimHTML)==tStr) ? itemDelimHTML : '</td></tr><tr><td width=100%>'
  obj.hItemHoverColor=(hItemHoverColor || '')
  obj.hItemHeadHTML=(hItemHeadHTML || '')
  obj.hItemTailHTML=(hItemTailHTML || '')
  obj.hItemLinkClass=(hItemLinkClass || '')
  obj.hItemLinkAttrs=(hItemLinkAttrs || '')
  obj.itemHoverColor=(itemHoverColor || '')
  obj.itemHeadHTML=(itemHeadHTML || '')
  obj.itemTailHTML=(itemTailHTML || '')
  obj.itemLinkClass=(itemLinkClass || '')
  obj.itemLinkAttrs=(itemLinkAttrs || '')
  obj.rollover=rollover
  obj.items=items
// ------------------------------------\
  obj.init=function() {
    if (DHTML && !SCREEN.size) {
      D.write(NN4 ?
	"<layer name='pageSize' left=0 top=0 height=100% visibility=hide><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td></td></tr></table></layer>" : 
	"<div id='pageSize' style='position:absolute;left:0;top:0;width:100%;height:100%;visibility:hidden;'></div>")
      SCREEN.size=Layer('pageSize');
      }
    var t=this
    var items=t.items
    // ------------|
    for (var i in items) {
      var item=items[i]
      item.init(t,t,i)
      if (item.subMenu) item.subMenu.create(t,item)
      }
    }
// ------------------------------------/
// ------------------------------------\
  obj.create=function() {
    var t=this
    var items=t.items
    // ------------|
    D.write(t.headHTML)
    // ------------|
    var n=0
    for (var i in items) {
      if (n) D.write(t.hItemDelimHTML)
      items[i].create()
      n=1
      }
    // ------------|
    D.write(t.tailHTML)
    // ------------|
    if (DHTML)
      for (var i in items) {
        var item=items[i]
        item.layer=Layer((NN4 ? 'layerBody' : item.name),'D.layers.'+item.name+'.document')
        }
    }
// ------------------------------------/
// ------------------------------------\
  obj.Switch=function(allNum,pos,fromSubMenu) {
    var t=this
    var inc=pos ? +1 : -1
    var item=this.allItems[allNum]
    // ------------|
    var sM=item.subMenu
    if (sM) sM.layer.color((fromSubMenu && pos) ? sM.hoverColor : sM.bgColor)
    // ------------|
    do item.position+=inc
    while (item=item.parent.parent)
    // ------------|
    setTimeout('W.MENU["'+t.name+'"].allItems['+allNum+'].Switch()',15)//40)
    }
// ------------------------------------/
  W.MENU[name]=obj
  obj.init()
  return obj
  }
// ----------------------------------------------------------------------------/


// -----------------\
// Create menu item
// ----------------------------------------------------------------------------\
function Item(text,href,target,
	bgColor,hoverColor,headHTML,tailHTML,linkClass,linkAttrs,beforeHTML,afterHTML,
	subMenu) {
  var obj=this.window ? {} : this
  obj.menu=obj.parent=0
  obj.allNum=0
  obj.isHead=0
  obj.num=0
  obj.name=''
  obj.layer=0
  obj.position=0
  //---------------|
  obj.text=text
  obj.href=href
  obj.target=target
  obj.bgColor=(typeof(bgColor)==tStr) ? bgColor : 0
  obj.hoverColor=(typeof(hoverColor)==tStr) ? hoverColor : 0
  obj.headHTML=(typeof(headHTML)==tStr) ? headHTML : 0
  obj.tailHTML=(typeof(tailHTML)==tStr) ? tailHTML : 0
  obj.linkClass=(typeof(linkClass)==tStr) ? linkClass : 0
  obj.linkAttrs=(typeof(linkAttrs)==tStr) ? linkAttrs : 0
  obj.beforeHTML=(beforeHTML || '')
  obj.afterHTML=(afterHTML || '')
  obj.subMenu=subMenu
// ------------------------------------\
  obj.init=function(menu,parent,num) {
    var t=this
    var m=t.menu=menu
    var p=t.parent=parent
    t.num=num
    var isHead=t.isHead=(menu==parent) ? 1 : 0
    t.allNum=m.allItems.length
    // ------------|
    m.allItems[t.allNum]=t
    t.name=m.name+'_'+t.allNum
    // ------------|
    if (typeof(t.bgColor)!=tStr) t.bgColor=isHead ? m.bgColor : ''
    if (typeof(t.hoverColor)!=tStr)
      if (isHead) t.hoverColor=m.hItemHoverColor
      else t.hoverColor=(typeof(p.itemHoverColor)==tStr) ? p.itemHoverColor : m.itemHoverColor
    if (!t.hoverColor) t.hoverColor=t.bgColor
    // ------------|
    if (typeof(t.linkClass)!=tStr)
      if (isHead) t.linkClass=m.hItemLinkClass
      else t.linkClass=(typeof(p.itemLinkClass)==tStr) ? p.itemLinkClass : m.itemLinkClass
    if (typeof(t.linkAttrs)!=tStr)
      if (isHead) t.linkAttrs=m.hItemLinkAttrs
      else t.linkAttrs=(typeof(p.itemLinkAttrs)==tStr) ? p.itemLinkAttrs : m.itemLinkAttrs
    }
// ------------------------------------/
// ------------------------------------\
  obj.create=function() {
    var t=this
    var m=t.menu
    var p=t.parent
    var isHead=t.isHead
    // ------------|
    D.write(t.beforeHTML)
    D.write(NN4 ?
	'<ilayer name="'+t.name+'" z-index='+p.z+'><layer name="layerBody" width=100% '+
		'bgcolor='+(t.bgColor || '""') :
	'<div ID="'+t.name+'" style="position:relative;width:100%;background:'+t.bgColor+
		';z-index:'+p.z+'"')
    D.write(' onmouseover="W.MENU.',m.name,'.Switch(',t.allNum,',1)"',
	' onmouseout="W.MENU.',m.name,'.Switch(',t.allNum,')">')
// =============\
// VERY SPECIAL |
// ====================================\
if (NN4) D.write('<layer name="layerWidth" width=100% visibility=hide><table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td></td></tr></table></layer>')
// ====================================/
    // ------------|
    if (typeof(t.headHTML)==tStr) D.write(t.headHTML)
    else if (isHead) D.write(m.hItemHeadHTML)
    else D.write((typeof(p.itemHeadHTML)==tStr) ? p.itemHeadHTML :m.itemHeadHTML)
    // ------------|
    if (t.href && t.href.length)
      D.write('<a href="',t.href,'" ',t.linkAttrs,
		(t.linkClass ? ' class="'+t.linkClass+'"' : ''),
		(t.target ? ' target="'+t.target+'"' : ''),
		'>',t.text,'</a>')
    else
      D.write(t.text)
    // ------------|
    if (typeof(t.tailHTML)==tStr) D.write(t.tailHTML)
    else if (isHead) D.write(m.hItemTailHTML)
    else D.write((typeof(p.itemTailHTML)==tStr) ? p.itemTailHTML : m.itemTailHTML)
    // ------------|
    D.write(NN4 ? '</layer></ilayer>' : '</div>')
    D.write(t.afterHTML)
    }
// ------------------------------------/
// ------------------------------------\
  obj.Switch=function(immediate) {
    var t=this
    var m=t.menu
    var p=t.parent
    var pos=t.position
    var del=m.delayOff
    // ------------|
    var b=0
    for (var i in m.allItems) if (m.allItems[i].position) b=1
    // ------------|
    if (del && t.subMenu && !(pos || immediate || b))
      setTimeout('W.MENU["'+m.name+'"].allItems['+t.allNum+'].Switch(1)',del)
    else {
      var r=p.rollover
      if (r) r.Switch(t.num,pos,t.layer.nn_document)
      t.layer.color(pos ? t.hoverColor : t.bgColor)
      if (t.subMenu) t.subMenu.Switch()
      var pI=t    
      while (pI=pI.parent.parent) pI.Switch(immediate)
      }
    }
// ------------------------------------/
  return obj
  }
// ----------------------------------------------------------------------------/


// ---------------\
// Create submenu
// ----------------------------------------------------------------------------\
function SubMenu(left,top,width,bgColor,hoverColor,headHTML,tailHTML,itemDelimHTML,
	itemHoverColor,itemHeadHTML,itemTailHTML,itemLinkClass,itemLinkAttrs,
	rollover,items) {
  var obj=this.window ? {} : this
  obj.menu=obj.parent=0
  obj.name=''
  obj.direction=obj.dirOff=0
  obj.alignment=obj.alignOff=0
  obj.z=0
  obj.layer=0
  obj.layerW=obj.layerH=0
  // --------------|
  obj.left=left
  obj.top=top
  obj.width=width
  obj.bgColor=(typeof(bgColor)==tStr) ? bgColor : 0
  obj.hoverColor=(typeof(hoverColor)==tStr) ? hoverColor : 0
  obj.headHTML=(typeof(headHTML)==tStr) ? headHTML : 0
  obj.tailHTML=(typeof(tailHTML)==tStr) ? tailHTML : 0
  obj.itemDelimHTML=(typeof(itemDelimHTML)==tStr) ? itemDelimHTML : 0
  obj.itemHoverColor=(typeof(itemHoverColor)==tStr) ? itemHoverColor : 0
  obj.itemHeadHTML=(typeof(itemHeadHTML)==tStr) ? itemHeadHTML : 0
  obj.itemTailHTML=(typeof(itemTailHTML)==tStr) ? itemTailHTML : 0
  obj.itemLinkClass=(typeof(itemLinkClass)==tStr) ? itemLinkClass : 0
  obj.itemLinkAttrs=(typeof(itemLinkAttrs)==tStr) ? itemLinkAttrs : 0
  obj.rollover=rollover
  obj.items=items
// ------------------------------------\
  obj.create=function(menu,parent) {
    if (!DHTML) return
  // --------------|
  function parsePos(str) {
    if (typeof(str)!=tStr) return null
    var off=0
    var i=str.indexOf('+')
    if (i<0) i=str.indexOf('-')
    if (i>=0) {
      off=str.substr(i)
      str=str.substr(0,i)
      }
    str=(str.charAt(0) || 0)
    off=(parseInt(off) || 0)
    return [str,off]
    }
  // --------------|
    var t=this
    var m=t.menu=menu
    var p=t.parent=parent
    var name=this.name=p.name+'_body'
    this.z=parent.parent.z+1
    var items=this.items
    // ------------|
    if (t.left==null) t.left=p.isHead ? m.hSubLeft : m.subLeft
    if (t.top==null) t.top=p.isHead ? m.hSubTop : m.subTop
    if (t.width==null) t.width=m.subWidth
    if (typeof(t.bgColor)!=tStr) t.bgColor=m.subBgColor
    if (typeof(t.hoverColor)!=tStr) t.hoverColor=(m.subHoverColor || t.bgColor)
    // ------------|
    var d=parsePos(t.left)
    var a=parsePos(t.top)
    if (d) {
      t.direction=(d[0] || (p.isHead ? 'v' : 'h'))
      t.dirOff=d[1]
      t.alignment=(a[0] || (a[1] ? 'b' : 'a'))
      if (a[0]!='a') t.alignOff=(a[1] || 0)
      t.left=t.top=0
      }
    // ------------|
    if (NN4)
      D.write('<layer name="',t.name,'" left=0 top=0 width=',t.width,
	' bgcolor=',(t.bgColor || '""'),' visibility=hide z-index=',t.z)
    else
      D.write('<div id="',t.name,'" style="position:absolute;left:0;top:0;',
	'background-color:',t.bgColor,';visibility:hidden;z-index:',t.z,'"')
    D.write(' onmouseover="W.MENU.',m.name,'.Switch(',p.allNum,',1,1)"',
	' onmouseout="W.MENU.',m.name,'.Switch(',p.allNum,',0,1)">')
    if (!NN4)
      D.write('<table border=0 cellspacing=0 cellpadding=0 width=',t.width,
	'><tr><td width=100%>')
    // ------------|
    D.write((typeof(t.headHTML)==tStr) ? t.headHTML : m.subHeadHTML)
    // ------------|
    var delim=(typeof(t.itemDelimHTML)==tStr) ? t.itemDelimHTML : m.itemDelimHTML
    var n=0
    for (var i in items) {
      if (n) D.write(delim)
      items[i].init(menu,t,i)
      items[i].create()
      n=1
      }
    // ------------|
    D.write((typeof(t.tailHTML)==tStr) ? t.tailHTML : m.subTailHTML)
    // ------------|
    if (!NN4) D.write('</td></tr></table>')
    D.write(NN4 ? '</layer>' : '</div>')
    // ------------|
    t.layer=Layer(t.name)
    for (var i in items) {
      var item=items[i]
      item.layer=Layer((NN4 ? 'layerBody' : item.name),'D.layers.'+t.name+'.document.layers.'+item.name+'.document')
      if (item.subMenu) item.subMenu.create(menu,item)
      }
    }
// ------------------------------------/
// ------------------------------------\
  obj.Switch=function() {
    if (!DHTML) return
    var t=this
    var m=t.menu
    var p=t.parent
    var l=t.layer
    var pos=p.position
    // ------------|
    if (pos) {
      var tmp
      tmp=SCREEN.params()
      var scrW=tmp.width
      var scrH=tmp.height
      var scrL=tmp.left
      var scrT=tmp.top
      var scrR=scrL+scrW-1
      var scrB=scrT+scrH-1
      // ----------|
      tmp=p.layer.params()
      var elW=tmp.width
      var elH=tmp.height
      var elL=tmp.pageLeft
      var elT=tmp.pageTop
      var elR=elL+elW-1
      var elB=elT+elH-1
      // ----------|
      var w=t.layerW
      var h=t.layerH
      if (!w) {		// MOZILLA & OPERA BUG CORRECTION
        var tmp=l.params()
        w=t.layerW=tmp.width
        h=t.layerH=tmp.height
        }
      if (!NN4) l.params(null,null,null,null,null,null,w,h)
      // ----------|
      var d=t.direction
      var dO=t.dirOff
      var a=t.alignment
      var aO=t.alignOff
      // ----------|
      var x=t.left
      var y=t.top
      var l1,l2
      // ----------|
      if (d) {
        if (d=='h') {
          l1=(elL-dO)-scrL
          l2=scrR-(elR+dO)
          d=(l2<w && l1>l2) ? 'l' : 'r'
          if (d=='l') dO=-dO
          }
        if (d=='v') {
          l1=(elT-dO)-scrT
          l2=scrB-(elB+dO)
          d=(l2<h && l1>l2) ? 't' : 'b'
          if (d=='t') dO=-dO
          }
        // --------|
        if (d=='l') {
          x=elL+dO-w
          d='h'
          }
        else if (d=='r') {
          x=elR+dO+1
          d='h'
          }
        else if (d=='t') {
          y=elT+dO-h
          d='v'
          }
        else { // (d=='b')
          y=elB+dO+1
          d='v'
          }
        // --------|
        if (d=='v') {
          if (a=='a') {
            l1=(elR+aO)-scrL+1
            l2=scrR-(elL+aO)+1
            a=(l2<w && l1>l2) ? 'e' : 'b'
            }
          if (a=='c') x=elL-Math.floor((w-elW)/2)+aO
          else if (a=='e') x=elR+aO-w+1
          else x=elL+aO // (a=='b')
          }
        else { // (d=='h')
          if (a=='a') {
            l1=(elB+aO)-scrT+1
            l2=scrB-(elT+aO)+1
            a=(l2<w && l1>l2) ? 'e' : 'b'
            }
          if (a=='c') y=elT-Math.floor((h-elH)/2)+aO
          else if (a=='e') y=elB+aO-h+1
          else y=elT+aO // (a=='b')
          }
        // --------|
        }
      else if (m.centeredWidth) {
        var offsetX=Math.floor((scrW-m.centeredWidth)/2)
        x=t.left+((offsetX>0) ? offsetX : 0)
        y=t.top
        }
      // ----------|
      l.params(x,y)
      }
    // ------------|
    l.visibility(pos)
    }
// ------------------------------------/
  return obj
  }
// ----------------------------------------------------------------------------/

// ============================================================================/

// ============================================================================/

