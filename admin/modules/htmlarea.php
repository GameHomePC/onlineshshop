<? void(); ?>

<style>
TEXTAREA.htmlArea {
	width: 570px; /*630px;*/
	height: 200px;
	}
</style>


<script language="Javascript1.2"><!--
_editor_url = "<?= $ADMIN_ROOT ?>/modules/htmlarea/";
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }


var htmlareaConfig = new Object();
htmlareaConfig.width = "570px"; //"630px";
htmlareaConfig.height = "200px";
htmlareaConfig.bodyStyle = 'margin: 10; color: #333333; font-family: Tahoma,Helvetica,Arial,sans-serif; font-size: 11px;';
htmlareaConfig.toolbar = [
    ['fontname'],
    ['fontsize'],
    ['bold','italic','underline','separator'],
    ['forecolor','backcolor','separator'],
    ['htmlmode','popupeditor'],
    ['linebreak'],
    ['justifyleft','justifycenter','justifyright','justifyfull','separator'],
    ['OrderedList','UnOrderedList','Outdent','Indent','separator'],
    ['HorizontalRule','Createlink','InsertImage','InsertTable']
  ];
htmlareaConfig.fontnames = {
    "Arial":           "arial, helvetica, sans-serif",
    "Courier New":     "courier new, courier, mono",
    "Georgia":         "Georgia, Times New Roman, Times, Serif",
    "Tahoma":          "Tahoma, Arial, Helvetica, sans-serif",
    "Times New Roman": "times new roman, times, serif",
    "Verdana":         "Verdana, Arial, Helvetica, sans-serif"
//    "impact":          "impact",
//    "WingDings":       "WingDings"
  };
htmlareaConfig.fontsizes = {
    "1 (8 pt)":  "1",
    "2 (10 pt)": "2",
    "3 (12 pt)": "3",
    "4 (14 pt)": "4",
    "5 (18 pt)": "5"
//    "6 (24 pt)": "6",
//    "7 (36 pt)": "7"
  };


htmlareaConfig.tagstyles = {
    "BODY" : "margin: 0;background-color: #FFFFFF; color: #000000; font-family: Verdana,Arial,Helvetica,Tahoma,sans-serif; font-size: 12px;",
    "TD" : "color: #000000; font-family: Verdana,Arial,Helvetica,Tahoma,sans-serif; font-size: 12px;",
    "H1" : "text-align: center;color: #00366B;font-weight: bold;font-size: 18px;margin: 2;",
    "A" : "color: #00266B;text-decoration: none;",
    "A:visited" : "color: #00266B;text-decoration: none;",
    "A:hover" : "color: #0000FF;text-decoration: underline;",
    "P": "margin: 2 0 1 0;"
  };

htmlareaConfig.galleryImages = [
    {'comment': '', 'name': '', 'src': '', 'width': '', 'height': '', 'alt': ''},
<?
  $res=db_query("select comment,alt,width,height,path,name
		from site_gallery as g,uploads as u where g.uplID=u.uplID
		order by time DESC");
  while ($row=@$sql_fetch_assoc($res)) {
    $row=call('to_js',$row);
    echo "{
	'comment': '$row[comment]',
	'name': '$row[name]',
	'src': '$SITE_ROOT/$row[path]/$row[name]',
	'width': '$row[width]',
	'height': '$row[height]',
	'alt': '$row[alt]'
	},";
    }
?>
  ];
//-->
</script>
