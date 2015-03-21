/**
 * Created by dsd on 21/03/15.
 */

var cm = $('.corner-menu');
var sticky = $('.sticky');

sticky.data('sticked', false);

const STICKY_PATH  = 'images/corner_menu/sticky_icon_';

cm.draggable();
cm.on('dragstop', function(event, ui) {
    // if menu is not sticked
    // calculate shortest distance to border
    // queue animation
    // done
});

cm.on('hover', function(event, ui) {

});

sticky.on('click', function(event, ui) {
    // adjust image
    var sticked = !$(this).data('sticked');
    $(this).data('sticked', sticked);
    var path = STICKY_PATH + (sticked ? 'off' : 'on') + '.png';
    $(this).attr('src', path);
});