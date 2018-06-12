








$('.cta-nav [class$="-cta"]').click(function() {
  //console.log('click');
  //$(this).addClass('active');
  //$('html, body').animate({ scrollTop: $(this).offset().top }, 700);
  // $(this).parent().parent().find('div[class*="-content"]').hide();
  // $(this).parent().find('div[class*="-content"]').slideDown();

  if (!$(this).siblings().hasClass('active') &&  !$(this).hasClass('active') ){
    $('html, body').animate({ scrollTop: $(this).offset().top }, 700);
  }

  if (!$(this).hasClass('active')) {
    $('div[class*="-cta"]').removeClass('active');
    $(this).addClass('active');
    $('.cta-nav').find('div[class*="-content"]').slideUp();
    $(this).parent().find('div[class*="-content"]').slideDown();

  } else {
    $(this).parent().find('div[class*="-content"]').slideUp();
    $(this).removeClass('active');
  }

});






$(document).on('click','#schedule-trigger',function(){
    event.preventDefault();
    $('html, body').animate({
        scrollTop: $(".schedule").offset().top
    }, 700);

});

