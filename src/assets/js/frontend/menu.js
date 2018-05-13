
/**
 * Horizontal Scroll
 *
 */
$.fn.hScroll = function (amount) {
  amount = amount || 120;
  $(this).bind("DOMMouseScroll mousewheel", function (event) {
    var oEvent = event.originalEvent,
    direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta,
    position = $(this).scrollLeft();
    position += direction > 0 ? -amount : amount;
    $(this).scrollLeft(position);
    event.preventDefault();
  });
};
$('#scroll').hScroll(60);


/**
 * Click on Menu Item
 *
 */
$('.type-items').click(function() {
  var postid = $(this).attr('data-postid');
  var container = $("#menu-target");
  if (!$(this).hasClass('active')) {
    $(this).find('.image').append( '<div class="egg-loading"><svg><use xlink:href="#egg-cross"></use></svg></div>');
    $('.type-items').removeClass('active');
    $(this).addClass('active');
    menu_item(postid);
    $('html, body').animate({
        scrollTop: $(".menu-section").offset().top
    }, 700);
  } else {
    $(this).removeClass('active');
    $(container).slideUp();
  }
});

/**
 * Function to get Menu item
 *
 */
function menu_item(pid) {
  var request = {
    'action': 'menu_item',
    'id': pid,
  };
  jQuery.post( ajaxurl, request, function(response){
    console.log('Menu: ' + response);
    process_item(response);
  });

}

/**
 * Process Menu Item
 *
 */
function process_item(data) {
    data = $.parseJSON(data);
    var container = $("#menu-target");
    $(container).empty();
    console.log(data);
    $(container).prepend('<div class="close-menu"><svg><use xlink:href="#icon-close"></use></svg></div>');
    $(container).prepend('<div class="wrap"></div>');
    $(container).find('.wrap').prepend('<div class="content">'+data.content+'</div>');
    $(container).find('.wrap').prepend('<header><h1>'+data.title+'</h1></header>');
    if (data.special) {
      $(container).find('.wrap header').prepend('<small>Today\'s Special</small>');
    }
    $(container).find('.wrap').prepend('<div class="img-wrap"><img src="'+data.image+'"></div>');

    $('.item.active').find('.egg-loading').remove();
    $(container).slideDown();
}

$('body').on('click', '.close-menu', function() {
  console.log('click');
  $('.item.active').removeClass('active');
  $("#menu-target").slideUp().removeClass('open');
});
