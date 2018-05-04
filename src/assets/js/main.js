
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




$('.type-items').click(function() {
  var postid = $(this).attr('data-postid');
  var container = $("#menu-target");
  if (!$(this).hasClass('active')) {
    $(this).find('.image').append( '<div class="egg-loading"><svg><use xlink:href="#egg-cross"></use></svg></div>');
    $('.type-items').removeClass('active');
    $(container).empty();
    $(this).addClass('active');
    menu_item(postid);
  } else {
    $(this).removeClass('active');
    $(container).slideUp();
  }
});

/**
 * Function to get Schedule
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

function process_item(data) {
    data = $.parseJSON(data);
    var container = $("#menu-target");
    console.log(data);
    $(container).prepend('<div class="close-menu"><svg><use xlink:href="#icon-close"></use></svg></div>');
    $(container).prepend('<div class="content">'+data.content+'</div>');
    $(container).prepend('<h1>'+data.title+'</h1>');
    $(container).prepend('<div class="img-wrap"><img src="'+data.image+'"></div>');
    $('.item.active').find('.egg-loading').remove();
    $(container).slideDown();
}

$('body').on('click', '.close-menu', function() {
  console.log('click');
  $('.item.active').removeClass('active');
  $("#menu-target").slideUp().removeClass('open');
});




// $('.twitter-wrapper .twitter:last-child').prev('div').andSelf().appendTo(".twitter-wrapper.post");




// //
// // Pulls in press articles via ajax
// // Fucntion located in ???
// //
//   $('.press .lmore').click(function() {
//     var currentWidth = $(this).outerWidth();
//     //console.log(currentWidth);
//     $(this).css("width",currentWidth + "px");
//     $(this).text('Loading\u2026').append( '<div class="loading"><svg><use xlink:href="#egg-cross"></use></svg></div>' );

//     $("<div>").load("media-posts", function() {
//       var mdata = $(this).html();
//       $('.press ul .last').fadeOut( "slow", function() {
//         $(".press ul").append(mdata);
//       });
//     });

//   });



// //
// // Pulls in menu items via ajax
// // Fucntion located in _inc / items / _menu_functions.php
// //


// $('.type-items').click(function() {
//   var postid = $(this).attr('data-postid');
//   var $container = $(".menu_target");
//   var data = {
//     action: 'menu_item', // Call function
//     post_id: postid // Pass post id data
//   };

//   if (!$(this).hasClass('active')) {
//     $('.item.active').removeClass('active');
//     $(this).toggleClass('active');
//     $(this).append( '<div class="loading"><svg><use xlink:href="#egg-cross"></use></svg></div>' );

//     $.post(ajaxurl, data, function(response){
//       $container.html(response);
//       //console.log(response);
//       $container.slideDown().addClass('open');
//       $('.item .loading').fadeOut( 'fast', function() {
//         $('.item .loading').remove();
//       });
//     });

//   } else {
//     $container.slideUp().removeClass('open');
//     $(this).toggleClass('active');
//   }
//   return false;
// });

// $(".menu_target").on("click", ".close", function() {
//   $('.item.active').removeClass('active');
//   $(".menu_target").slideUp().removeClass('open');
// });

// // End Menu Ajax Call


// //
// // Pulls in Staff items via ajax
// // Fucntion located in
// //


// $('.meet').click(function() {
//   var $container = $(".team_target");
//   var data = {
//     action: 'staff_archive', // Call function
//   };

//  var currentWidth = $(this).outerWidth();
//   console.log(currentWidth);
//   $(this).css("width",currentWidth + "px");
//   $(this).text('Loading\u2026').append( '<div class="loading"><svg><use xlink:href="#egg-cross"></use></svg></div>' );

//  var currentHeight = $('.team').outerHeight();
//  $('.team').css("min-height",currentHeight + "px");

//     $.post(ajaxurl, data, function(response){
//       $('.pre_target').fadeOut( "slow", function() {
//         $(".pre_target").remove();
//         $container.html(response);
//         $container.slideDown();
//       });
//       //console.log(response);
//     });
//   return false;
// });


// // End Menu Ajax Call


// //
// // Open/Close Contact form
// //
// //

//   $("#contact-open-trigger").click(function(e) {
//     e.preventDefault();
//     $('body').css('overflow-y', 'hidden');
//     $('.contact-form-wrap').fadeIn();
//   });

//   $("#contact-close").click(function(e) {
//     e.preventDefault();
//     $('body').css('overflow-y', 'auto');
//     $('.contact-form-wrap').fadeOut();
//   });


// //
// // Scroll to Schedule
// //
// //

//   $('#schedule-trigger').click(function(e) {
//     e.preventDefault();
//     $('html, body').animate({
//         scrollTop: $(".schedule").offset().top
//     }, 700);
//   });
