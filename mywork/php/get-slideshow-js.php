$(document).ready(function($) {
$(window).bind("load", function() {
$('.dt_fullscreenslider').dtFullScreenSlider({
'height': 280,
'autoAdvance': true,
'autoAdvDuration': 1400,
'autoAdvInterval': 6000,
'showArrows': true,
'keyboardControl': true,
'showGallery': true,
'showDescription': true,
'bgPosition': 'center top',
'bgRepeat': 'no-repeat'
});
});
});
