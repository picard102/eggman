
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


  // $.ajax({
  //     dataType: "jsonp",
  //     url: themeurl + "/_objects/jsonp-wrapper.php",
  //     success: function(data) {
  //       setOpen(data);
  //     },
  //     error: function(error) {
  //       console.log(error);
  //     }
  // });
