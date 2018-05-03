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

  // function setOpen(data) {

  //   var open = false;

  //   if (data.open.length) {
  //     open = true;
  //   } else {
  //     open = false;
  //   }

  //   if (open) {
  //     var currentOpen = 0;
  //     var currentClose = 0;
  //     var soon = false;
  //     var currentTime = Date.now() / 1000;
  //     var info;
  //     var months = ['Jan','Feb','March','April','May','June','July','Aug','Sept','Oct','Nov','Dec'];

  //     //console.log(currentTime + ' currenttime');
  //     //console.log(data.open[0].start + ' Open Time');

  //     for (i = 0; i < data.open.length; i++) {
  //       if (data.open[i].start < currentTime && data.open[i].end > currentTime) {
  //         currentClose = data.open[i].end;
  //         info = data.open[i].display;
  //         soon = true;
  //       } else if (data.open[i].start > currentTime && soon === false) {
  //         currentClose = data.open[i].end;
  //         currentOpen = data.open[i].start;
  //         info = data.open[i].display;
  //         soon = true;
  //       }

  //       var thisDateOpen = new Date(data.open[i].start*1000);
  //       var thisDateClose =  new Date(data.open[i].end*1000);
  //       var thisDateMonth = months[thisDateOpen.getMonth()];
  //       var thisDateDate = thisDateOpen.getDate();
  //       var thisDateOpenHour = thisDateOpen.getHours();
  //       var thisDateCloseHour = thisDateClose.getHours();
  //       var thisLat = data.open[i].latitude;
  //       var thisLong = data.open[i].longitude;

  //       if (thisDateOpenHour > 12) {
  //         thisDateOpenHour = thisDateOpenHour - 12 + 'PM';
  //       } else if (thisDateOpenHour === 0) {
  //         thisDateOpenHour = '12AM';
  //       } else {
  //         thisDateOpenHour = thisDateOpenHour + 'AM';
  //       }
  //       if (thisDateCloseHour > 12) {
  //         thisDateCloseHour = thisDateCloseHour - 12 + 'PM';
  //       } else if (thisDateCloseHour === 0) {
  //         thisDateCloseHour = '12AM';
  //       } else {
  //         thisDateCloseHour = thisDateCloseHour + 'AM';
  //       }
  //       var html = $('.schedule dl').html() + '<dt>'+ thisDateMonth +' '+ thisDateDate +'</dt> <dd> <div><strong>'+thisDateOpenHour+' - '+thisDateCloseHour+'</strong>'+data.open[i].display+'<a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'"><svg><use xlink:href="#maps-icon"></use></svg><span>View on Google Maps</span></a></div> </dd>';
  //       $('.schedule dl').html(html);
  //     }

  //       //console.log(currentOpen);
  //       //console.log(currentClose);

  //     if (currentClose === 0) {

  //       $('#status-copy').html('<span>Currently Closed</span>Sorry, we\'re is closed right now!');

  //     } else if(currentOpen !== 0){

  //       var date = new Date(currentOpen*1000);
  //       var hours = date.getHours();
  //       var closeDate = new Date(currentClose*1000);
  //       var closeHours = closeDate.getHours();

  //       if (hours > 12) {
  //         hours = hours - 12 + 'PM';
  //       } else if (hours === 0) {
  //         hours = '12AM';
  //       } else {
  //         hours = hours + 'AM';
  //       }

  //       if (closeHours > 12) {
  //         closeHours = closeHours - 12 + 'PM';
  //       } else if (closeHours === 0) {
  //         closeHours = '12AM';
  //       } else {
  //         closeHours = closeHours + 'AM';
  //       }

  //       $('#status-copy').html('<span>Will be open at ' + hours + ' until ' + closeHours + '</span>' + info);
  //       $('.status').removeClass('closed');
  //       $('.status').addClass('soon');
  //       $('.status .controls').prepend('<a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'"><svg><use xlink:href="#maps-icon"></use></svg><span>View on Google Maps</span></a>');
  //       $('.status .loading').remove();

  //     } else {

  //       date = new Date(currentClose*1000);
  //       hours = date.getHours();

  //       if (hours > 12) {

  //         hours = hours - 12 + 'PM';

  //       } else if (hours === 0) {

  //         hours = '12AM';

  //       } else {

  //         hours = hours + 'AM';

  //       }

  //       $('#status-copy').html('<span>Open Now Until ' + hours + '</span>' + info);
  //       $('.status').removeClass('closed');
  //       $('.status').addClass('open');
  //       $('.status .controls').prepend('<a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'"><svg><use xlink:href="#maps-icon"></use></svg><span>View on Google Maps</span></a>');
  //       $('.status .loading').remove();



  //     }

  //   } else {

  //     $('#status-copy').html('<span>Currently Closed</span>Sorry, we\'re is closed right now!');
  //     $('.status .loading').remove();

  //          var html = $('.schedule dl').html() + '<dt>THIS WEEKS SCHEDULE WILL BE POSTED SHORTLY.</dt> <dd></dd>';
  //       $('.schedule dl').html(html);

  //   }


  // }


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
