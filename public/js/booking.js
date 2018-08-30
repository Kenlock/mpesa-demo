console.log('KKKKKKKKKKKkk')
var rooms_data = {};

function initPage() {
  $.ajax({
    url: '/booking/roomdata',
    type: 'GET',
    dataType: 'JSON',
    success: function(response) {
      console.log(response);
      rooms_data = response;
    },
    error: function() {
      console.log('In Error');
    }
  });
}

function saveBookingSearch() {
  $.ajax({
    url: '/booking/saveSearch',
    type: 'POST',
    dataType: 'JSON',
    data: $("form[name='search_form']").serialize(),
    success: function(response) {
      $('.nav-tabs a[href="#rooms"]').tab('show');
      var firstRow = $('.room-row').eq(0);
      for(var i=response.session_data.search.total_rooms; i > 1; i--) {
        console.log(' --- ' + i)
        var clone = firstRow.clone();
        clone.find('.lbl-room').html('Room ' + (i) );
        // clone.find('.lbl-rt').html('Select Room Type ' + (i+1) );
        // clone.find('.lbl-r').html('Select Room ' + (i+1) );
        clone.insertAfter(firstRow);
      }

      console.log('In SUccess');
    },
    error: function() {
      console.log('In Error');
    }
  });
}

function changeRoomType(obj) {
  var rooms = rooms_data[$(obj).val()].rooms;
  var selObj = $(obj).closest('.room-row').find('select[name="room[]"]');
  // console.log(rooms.length);
  selObj.html('<option value="">Select Room</option>');
  for(i=0;i<rooms.length;i++) {
    selObj.append('<option value="'+ rooms[i].id +'">'+ rooms[i].room_no +'</option>');
  }
}

function saveBookingRooms() {
  $.ajax({
    url: '/booking/saveRooms',
    type: 'POST',
    dataType: 'JSON',
    data: $("form[name='rooms_form']").serialize(),
    success: function(response) {
      $('.nav-tabs a[href="#guests"]').tab('show');
      console.log('In Success');
    },
    error: function() {
      console.log('In Error');
    }
  });
}

function saveBookingGuests() {
  $.ajax({
    url: '/booking/saveGuests',
    type: 'POST',
    dataType: 'JSON',
    data: $("form[name='guests_form']").serialize(),
    success: function(response) {
      $('.nav-tabs a[href="#confirm"]').tab('show');
      console.log('In Success');
    },
    error: function() {
      console.log('In Error');
    }
  });
}

function saveBooking() {
  $.ajax({
    url: '/booking/saveBooking',
    type: 'POST',
    dataType: 'JSON',
    data: $("form[name='confirm_form']").serialize(),
    success: function(response) {
      // $('.nav-tabs a[href="#confirm"]').tab('show');
      console.log('In Success');
    },
    error: function() {
      console.log('In Error');
    }
  });
}
