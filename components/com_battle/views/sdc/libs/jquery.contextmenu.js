//
// This is a modified version of the jQuery context menu plugin. Credits below.
//

// jQuery Context Menu Plugin
//
// Version 1.01
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
//
// More info: http://abeautifulsite.net/2008/09/jquery-context-menu-plugin/
//
// Terms of Use
//
// This plugin is dual-licensed under the GNU General Public License
//   and the MIT License and is copyright A Beautiful Site, LLC.
//
(function($)
{
    $.extend($.fn,
    {
        contextMenu: function(options)
        {
            // Defaults
            var defaults =
                {
                    fadeIn:        150,
                    fadeOut:       75
                },
                o = $.extend(true, defaults, options || {}),
                d = document;

            // Loop each context menu
            $(this).each( function()
            {
                var el = $(this),
                    offset = el.offset(),
                    $m = $('#' + o.menu);

                // Add contextMenu class
                $m.addClass('contextMenu');

                // Simulate a true right click
                $(this).mousedown( function(e) {

                    // e.stopPropagation(); // Terry: No, thank you
                    $(this).mouseup( function(e) {
                        // e.stopPropagation(); // Terry: No, thank you
                        var target = $(this);

                        $(this).unbind('mouseup');

                        if( e.button == 2 ) {
                            // Hide context menus that may be showing
                            $(".contextMenu").hide();
                            // Get this context menu

                            if( el.hasClass('disabled') ) return false;

                            // show context menu on mouse coordinates or keep it within visible window area
                            var x = Math.min(e.pageX, $(document).width() - $m.width() - 5),
                                y = Math.min(e.pageY, $(document).height() - $m.height() - 5);

                            // Show the menu
                            $(document).unbind('click');
                            $m
                                .css({ top: y, left: x })
                                .fadeIn(o.fadeIn)
                                .find('A')
                                    .mouseover( function() {
                                        $m.find('LI.hover').removeClass('hover');
                                        $(this).parent().addClass('hover');
                                    })
                                    .mouseout( function() {
                                        $m.find('LI.hover').removeClass('hover');
                                    });

                            if (o.onShow) o.onShow( this, {x: x - offset.left, y: y - offset.top, docX: x, docY: y} );

                            // Keyboard
                            $(document).keypress( function(e) {
                                var $hover = $m.find('li.hover'),
                                    $first = $m.find('li:first'),
                                    $last  = $m.find('li:last');

                                switch( e.keyCode ) {
                                    case 38: // up
                                        if( $hover.size() == 0 ) {
                                            $last.addClass('hover');
                                        } else {
                                            $hover.removeClass('hover').prevAll('LI:not(.disabled)').eq(0).addClass('hover');
                                            if( $hover.size() == 0 ) $last.addClass('hover');
                                        }
                                    break;
                                    case 40: // down
                                        if( $hover.size() == 0 ) {
                                            $first.addClass('hover');
                                        } else {
                                            $hover.removeClass('hover').nextAll('LI:not(.disabled)').eq(0).addClass('hover');
                                            if( $hover.size() == 0 ) $first.addClass('hover');
                                        }
                                    break;
                                    case 13: // enter
                                        $m.find('LI.hover A').trigger('click');
                                    break;
                                    case 27: // esc
                                        $(document).trigger('click');
                                    break
                                }
                            });

                            // When items are selected
                            $m.find('A').unbind('click');
                            $m.find('LI:not(.disabled) A').click( function() {
                                var checked = $(this).attr('checked');

                                switch ($(this).attr('type')) // custom attribute
                                {
                                    case 'radio':
                                        $(this).parent().parent().find('.checked').removeClass('checked').end().find('a[checked="checked"]').removeAttr('checked');
                                        // break; // continue...
                                    case 'checkbox':
                                        if ($(this).attr('checked') || checked)
                                        {
                                            $(this).removeAttr('checked');
                                            $(this).parent().removeClass('checked');
                                        }
                                        else
                                        {
                                            $(this).attr('checked', 'checked');
                                            $(this).parent().addClass('checked');
                                        }

                                        //if ($(this).attr('hidemenu'))
                                        {
                                            $(".contextMenu").hide();
                                        }
                                        break;
                                    default:
                                        $(document).unbind('click').unbind('keypress');
                                        $(".contextMenu").hide();
                                        break;
                                }
                                // Callback
                                if( o.onSelect )
                                {
                                    o.onSelect( $(this), $(target), $(this).attr('href'), {x: x - offset.left, y: y - offset.top, docX: x, docY: y} );
                                }
                                return false;
                            });

                            // Hide bindings
                            setTimeout( function() { // Delay for Mozilla
                                $(document).click( function() {
                                    $(document).unbind('click').unbind('keypress');
                                    $m.fadeOut(o.fadeOut);
                                    return false;
                                });
                            }, 0);
                        }
                    });
                });

                // Disable text selection
                if( $.browser.mozilla ) {
                    $m.each( function() { $(this).css({ 'MozUserSelect' : 'none' }); });
                } else if( $.browser.msie ) {
                    $m.each( function() { $(this).bind('selectstart.disableTextSelect', function() { return false; }); });
                } else {
                    $m.each(function() { $(this).bind('mousedown.disableTextSelect', function() { return false; }); });
                }
                // Disable browser context menu (requires both selectors to work in IE/Safari + FF/Chrome)
                el.add($('UL.contextMenu')).bind('contextmenu', function() { return false; });

            });
            return $(this);
        },
        // Destroy context menu(s)
        destroyContextMenu: function() {
            // Destroy specified context menus
            $(this).each( function() {
                // Disable action
                $(this).unbind('mousedown').unbind('mouseup');
            });
            return( $(this) );
        }

    });
})(jQuery);
