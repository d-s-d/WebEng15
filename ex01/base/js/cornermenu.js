/**
 * Created by dsd on 21/03/15.
 */

var cm = $('.corner-menu');
var sticky = $('.sticky');

sticky.data('sticked', false);

const STICKY_PATH  = 'images/corner_menu/sticky_icon_';

cm.draggable();

cm.on('dragstop', function(event, ui) {
    var sticked = sticky.data('sticked');
    var me = $(this);
    var offset = me.offset();
    var jq_window = $(window);
    if(!sticked)
    {
        var distances = [offset.top, jq_window.width() - offset.left, jq_window.height()-offset.top, offset.left];
        var targets = [
            /* move up */ {top: 0},
            /* move right */ {left: jq_window.width()-me.width()},
            /* move down */ {top: jq_window.height()-me.height()},
            /* move left */ {left: 0}
        ];
        console.log(jq_window.height());
        var i = distances.indexOf(Math.min.apply(Math, distances));
        cm.animate(targets[i], 500);
    }
});

cm.on('mouseenter', function(event, ui) {
    $(this).stop();
});

sticky.on('click', function(event, ui) {
    // adjust image
    var sticked = !$(this).data('sticked');
    $(this).data('sticked', sticked);
    var path = STICKY_PATH + (sticked ? 'off' : 'on') + '.png';
    $(this).attr('src', path);
});