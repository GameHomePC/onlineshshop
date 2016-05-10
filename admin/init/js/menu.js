/*
 // ============================================================================\

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

 // ============================================================================/
 */

var SR = SITE_ROOT;
var AR = ADMIN_ROOT;

m1 = DropDownMenu('menu1', 0, 500,
    '', '', '', '-4', 200,
    0, 0, 0, '</td><td class=menuText>&nbsp;|&nbsp;</td><td>',
    0, 0,
    '<table border=0 cellspacing=0 cellpadding=1 width=100%>\
    <tr></tr><tr></tr><tr><td width=100% class=subMenuBorder>\
    <table border=0 cellspacing=0 cellpadding=2 width=100% class=subMenuBg>\
    <tr><td width=100%>',
    '</td></tr>\
    </table>\
    </td></tr>\
    </table>',
    '</td></tr><tr><td width=100%>',
    '#6486A6', '&nbsp;', '&nbsp;', 'menuHItem', '',
    '#6486A6', '&nbsp;', '&nbsp;', 'menuItem', '',
    0, [
        Item('Settings', AR + '/home.php', 0,
            0, 0, 0, 0, 0, 0, 0, 0,
            SubMenu(null, null, null, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0,
                0, [
                    Item('Main System Settings', AR + '/home.php'),
                    Item('robots.txt', AR + '/robots/')
                ])),
        Item('Catalog', AR + '/sc_product/', 0,
            0, 0, 0, 0, 0, 0, 0, 0,
            SubMenu(null, null, null, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0,
                0, [
                    Item('Products', AR + '/sc_product/'),
                    Item('Product Categories', AR + '/sc_category/'),
                    Item('Manufacturers', AR + '/sc_manufacturer/'),
                    Item('Additional Product Lists', AR + '/sc_list/'),
                    Item('<b>Get New Bases</b>', AR + '/get_base.php?continue=1', '_blank'),
                    Item('Submit Google SiteMap', AR + '/sitemap.php', '_blank')
                ])),
        Item('Site Content', AR + '/page/', 0,
            0, 0, 0, 0, 0, 0, 0, 0,
            SubMenu(null, null, null, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0,
                0, [
                    Item('Page Management', AR + '/page/', 0,
                        0, 0, 0, 0, 0, 0, 0, 0,
                        SubMenu(null, null, null, 0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, [
                                Item('Page List', AR + '/page/'),
                                Item('Add Page', AR + '/page/view.php')
                            ])),
                    //Item('Menu Management',AR+'/menu/'),
                    Item('Image Gallery', AR + '/gallery/'),
                    Item('Uploaded Files', AR + '/files/')
                ])),
        Item('Additional Modules', AR + '/news/', 0,
            0, 0, 0, 0, 0, 0, 0, 0,
            SubMenu(null, null, null, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0,
                0, [
                    Item('News', AR + '/news/', 0,
                        0, 0, 0, 0, 0, 0, 0, 0,
                        SubMenu(null, null, null, 0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, [
                                Item('All News', AR + '/news/'),
                                Item('Add News', AR + '/news/view.php')
                            ])),
                    Item('Live Stories', AR + '/stories/', 0,
                        0, 0, 0, 0, 0, 0, 0, 0,
                        SubMenu(null, null, null, 0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, [
                                Item('All Stories', AR + '/stories/'),
                                Item('Add Story', AR + '/stories/view.php')
                            ])),
                    Item('Partners/Links', AR + '/links/', 0,
                        0, 0, 0, 0, 0, 0, 0, 0,
                        SubMenu(null, null, null, 0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, [
                                Item('Links List', AR + '/links/'),
                                Item('Add Link', AR + '/links/view.php')
                            ])),
                    Item('Mailing', AR + '/mailing/', 0,
                        0, 0, 0, 0, 0, 0, 0, 0,
                        SubMenu(null, null, null, 0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, [
                                Item('Mailing', AR + '/mailing/'),
                                Item('Mailing List', AR + '/mailing/?ShowEmails=1'),
                                Item('Mail Templates', AR + '/mailing/templates/')
                            ]))
                ])),
        Item('Site', SR + '/', '_blank')
    ]);
