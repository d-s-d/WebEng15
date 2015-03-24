/**
 * Created by dsd on 21/03/15.
 */

var cm = $('.corner-menu');
var sticky = $('.sticky');
var collapse = $('img.menu');

sticky.data('sticked', false);
collapse.data('collapsed', false);
var originalSize = 
    {width: cm.css('width'), height: cm.css('height'),
     padding: cm.css('padding')};

const STICKY_PATH  = 'images/corner_menu/sticky_icon_';

cm.draggable();

cm.on('dragstart', function(event, ui){
   cm.data('being_dragged', true);
});

cm.on('dragstop', function(event, ui){
    cm.data('being_dragged', false);
});

cm.on('mouseleave', function(event, ui) {
    if(!cm.data('being_dragged'))
    {
        var sticked = sticky.data('sticked');
        var me = $(this);
        var offset = me.offset();
        var jq_window = $(window);
        if (!sticked)
        {
            var distances = [offset.top, 
                             jq_window.width() - offset.left - me.width(), 
                             jq_window.height() - offset.top - me.height(), 
                             offset.left];
            var targets = [
                /* move up */ {top: 0},
                /* move right */ {left: jq_window.width() - me.outerWidth()},
                /* move down */ {top: jq_window.height() - me.outerHeight()},
                /* move left */ {left: 0}
            ];
            console.log(jq_window.height());
            var i = distances.indexOf(Math.min.apply(Math, distances));
            cm.animate(targets[i], 500);
        }
    }
});

cm.on('mouseenter', function(event, ui) {
    $(this).stop();
});

collapse.on('dblclick', function(event, ui) {
    var collapsed = !$(this).data('collapsed');
    $(this).data('collapsed', collapsed);
    if( collapsed )
    {
        $('.corner-menu > a').hide();
        sticky.hide();
        cm.animate({width: 35, height:35, padding:12.5}, 500);
    } else {
        cm.animate(originalSize, 500, function()
        {
            $('.corner-menu > a').show();
            sticky.show();
        });
    }

});

sticky.on('click', function(event, ui) {
    // adjust image
    var sticked = !$(this).data('sticked');
    $(this).data('sticked', sticked);
    var path = STICKY_PATH + (sticked ? 'off' : 'on') + '.png';
    $(this).attr('src', path);
});

$(window).on('resize', function(event, ui)
{
    if(!$('img.menu').data('collapsed') && $(this).width() <= 720)
    {
        collapse.dblclick()  
    }
});