function timeNow() {
  var d = new Date();
  return d.getTime();
}

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
* Test Data
*
*/

var testNow = Date.now()+(0.01*3600*1000);
var testStart = testNow/1000;
var testEnd = (testNow+(0.01*3600*1000))/1000;
var testData = '{"open":[{"start":'+testStart+',"end":'+testEnd+',"display":"TEST DATA STRING","latitude":43.64187239,"longitude":-79.41293414}]}';

// console.log(testStart + ' testStart');
// console.log(testEnd + ' testEnd');


/**
 * Process Schedule
 *
 */
function process_status(data) {
  var hasData = false;
  var sched_soon = false;
  var nextOpen;
  var nextClose;
  var currentTime = timeNow();
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

      // console.log(nextOpen + ' dataOpen');
      // console.log(nextClose + ' dataClosed');
      // console.log( currentTime - nextOpen + ' openMinus');
      // console.log( currentTime - nextClose + ' EndMinus');

      $('.status .content').empty();
      $('.status .controls').empty();
      $('.status').attr('class', 'status');

    if ( (currentTime + 3*3600*1000) > nextOpen && currentTime < nextOpen ) {
      console.log('Soon');
      document.title = 'Eggman - Open Soon!';
      $('.status').addClass('soon');
      $('.status .content').html('<p>Opening Soon at '+startHour+'</p> <small>'+address+' </small>');
      $('.status .controls').prepend('<a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'" class="maplink"><svg><use xlink:href="#maps-icon"></use></svg><span>View on Google Maps</span></a>');
    } else if ( currentTime > nextOpen && currentTime < nextClose ) {
      console.log('Open Now');
      document.title = 'Eggman - Now Open!';
      $('.status').addClass('open');
      $('.status .content').html('<p>Open Now Till '+endHour+'</p> <small>'+address+' </small>');
      $('.status .controls').prepend('<a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'" class="maplink"><svg><use xlink:href="#maps-icon"></use></svg><span>View on Google Maps</span></a>');
    } else {
      console.log('Closed');
      $('.status').addClass('closed');
      $('.status .content').html('<p>Currently Closed</p> <small>Open again on '+nextWeekday+' '+nextMonth+' '+nextDay + ordinal(nextDay)+' </small>');
      $('.status .controls').prepend('<a href="#" id="schedule-trigger"><svg><use xlink:href="#calendar-icon"></use></svg><span>See Schedule</span></a>');
    }

  } else {
    //console.log('Closed');
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
    $('.schedule dl').html('<p>Error</p>');
    return;
  }

  if (data.open.length) {
    hasData = true;
  }

  if (hasData) {
    var prev;
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
      var html = '';

      if (prev !== nextWeekday+nextMonth+nextDay) {
        html += '<dt>';
          html += nextWeekday+' '+nextMonth+' '+nextDay + ordinal(nextDay);
        html += '</dt>';
        html += '<dd>';
          html += '<div class="time">'+startHour+' <span>till</span> '+endHour+'</div>';
          html += '<div class="content">'+data.open[i].display+'</div>';
          html += '<div class="controls"><a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'" class="maplink"><svg><use xlink:href="#maps-icon"></use></svg> <span>View on Google Maps</span> </a></div>';
        html += '</dd>';
      } else {
        html += '<dd class="sameday">';
          html += '<div class="time">'+startHour+' <span>till</span> '+endHour+'</div>';
          html += '<div class="content">'+data.open[i].display+'</div>';
          html += '<div class="controls"><a href="http://maps.google.com/maps?z=18&q='+ thisLat +',' + thisLong +'" class="maplink"><svg><use xlink:href="#maps-icon"></use></svg> <span>View on Google Maps</span> </a></div>';
        html += '</dd>';
      }
      $('.schedule dl').append(html);
      prev = nextWeekday+nextMonth+nextDay;
    }
  } else {
    $('.schedule dl').empty();
    $('.schedule dl').append('<div class="no-schedule">This weeks schedule will be posted shortly.</div>');
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
