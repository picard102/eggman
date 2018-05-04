/**
 * Function to get Schedule
 *
 */
function schedule() {
  var request = {
    'action': 'get_schedule',
  };

  jQuery.post( ajaxurl, request, function(response){
    console.log('Schedule: ' + response);
    process_status(response);
    process_schedule(response);
  });

}

schedule();
setInterval(schedule, 60*60*5);

/**
 * Process Schedule
 *
 */
function process_status(data) {
  var hasData = false;
  var sched_soon = false;
  var nextOpen;
  var nextClose;
  var currentTime = Date.now();
  data = $.parseJSON(data);

  if (data == null) {
    console.log('error');
    $('.status .content').empty();
    $('.status .controls').empty();
    $('.status').attr('class', 'status');
    $('.status').addClass('error');
    $('.status .content').html('<p>Error</p>');
    return;
  }

  if (data.open.length) {
    hasData = true;
  }

  if (hasData) {
      nextOpen = data.open[0].start * 1000;
      nextClose = data.open[0].end * 1000;
      var thisLat = data.open[0].latitude;
      var thisLong = data.open[0].longitude;
      var address = data.open[0].display;
      var locale = "en-us";
      var nextDay = new Date(nextOpen).getDate();
      var nextWeekday = new Date(nextOpen).toLocaleString(locale, {weekday: "short"});
      var nextMonth = new Date(nextOpen).toLocaleString(locale, {month: "short"});
      var endHour = new Date(nextClose).toLocaleTimeString(locale, {hour: '2-digit', minute:'2-digit'});
      var startHour = new Date(nextOpen).toLocaleTimeString(locale, {hour: '2-digit', minute:'2-digit'});

      $('.status .content').empty();
      $('.status .controls').empty();
      $('.status').attr('class', 'status');

      if (nextOpen > currentTime ) {
        if (nextOpen < currentTime + 60*60*1000*6) {
          console.log('soon');
          $('.status').addClass('soon');
          $('.status .content').html('<p>Opening Soon at '+startHour+'</p> <small>'+address+' </small>');
          $('.status .controls').prepend('<a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'"><svg><use xlink:href="#maps-icon"></use></svg><span>View on Google Maps</span></a>');
        } else {
          console.log('before');
          $('.status').addClass('closed');
          $('.status .content').html('<p>Currently Closed</p> <small>Open next '+nextWeekday+' '+nextMonth+' '+nextDay + ordinal(nextDay)+' </small>');
          $('.status .controls').prepend('<a href="#" id="schedule-trigger"><svg><use xlink:href="#calendar-icon"></use></svg><span>See Future Schedule</span></a>');
        }
      }

      if (nextOpen < currentTime || nextClose < currentTime ) {
        console.log('current');
        $('.status').addClass('open');
        $('.status .content').html('<p>Open Now Till '+endHour+'</p> <small>'+address+' </small>');
        $('.status .controls').prepend('<a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'"><svg><use xlink:href="#maps-icon"></use></svg><span>View on Google Maps</span></a>');
      }

  } else {
    console.log('current');
    $('.status').addClass('closed');
    $('.status .content').html('<p>Currently Closed</p> <small>Schedule to be posted shortly.</small>');
  }

}






/**
 * Process Schedule
 *
 */
function process_schedule(data) {
  var hasData = false;
  data = $.parseJSON(data);

  if (data == null) {
    console.log('error');
    //$('.status').addClass('error');
    $('.schedule dl').html('<p>Error</p>');
    return;
  }

  if (data.open.length) {
    hasData = true;
  }

  if (hasData) {
    $('.schedule dl').empty();

    for (i = 0; i < data.open.length; i++) {
      var nextOpen = data.open[i].start * 1000;
      var nextClose = data.open[i].end * 1000;
      var thisLat = data.open[i].latitude;
      var thisLong = data.open[i].longitude;
      var address = data.open[i].display;
      var locale = "en-us";
      var nextDay = new Date(nextOpen).getDate();
      var nextWeekday = new Date(nextOpen).toLocaleString(locale, {weekday: "short"});
      var nextMonth = new Date(nextOpen).toLocaleString(locale, {month: "short"});
      var endHour = new Date(nextClose).toLocaleTimeString(locale, {hour: '2-digit', minute:'2-digit'});
      var startHour = new Date(nextOpen).toLocaleTimeString(locale, {hour: '2-digit', minute:'2-digit'});

      var html = '<dt>';
      //html += nextMonth +' '+ nextDay +'</dt> <dd> <div><strong>'+startHour+' - '+endHour+'</strong>'+data.open[i].display+'<div class="controls"><a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'"><svg><use xlink:href="#maps-icon"></use></svg><span>View on Google Maps</span></a></div></div> </dd>';
        html += nextWeekday+' '+nextMonth+' '+nextDay + ordinal(nextDay);
      html += '</dt>';
      
      html += '<dd>';
        html += '<div class="time">'+startHour+' <span>till</span> '+endHour+'</div>';
        html += '<div class="content">'+data.open[i].display+'</div>';
        html += '<div class="controls"><a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'"><svg><use xlink:href="#maps-icon"></use></svg> <span>View on Google Maps</span> </a></div>';
      html += '</dd>';


      $('.schedule dl').append(html);
    }
  }



}


  function ordinal(date) {
  if(date > 20 || date < 10) {
    switch(date%10) {
      case 1:
        return "st";
      case 2:
        return "nd";
      case 3:
        return "rd";
    }
  }
  return "th";
}
