var rooms_data = {};

function initPage() {
  $.ajax({
    url: '/roomorder/roomdata',
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

function changeQty(obj) {
  var num = 0;
  if( Number($(obj).val()) === NaN ) {
    num = 0;
  } else {
    num = Number($(obj).val());
  }

  var price = Number($(obj).closest('tr').find('td:eq(3)').html());
  $(obj).closest('tr').find('td:eq(4)').html(price * num);
  var gtotal = 0;
  console.log($(obj).closest('tbody').find('tr').length)
  $(obj).closest('tbody').find('tr').each(function() {
    console.log('IN')
    gtotal += Number($(this).find('td:eq(4)').html());
  });
  console.log(gtotal);
  $(obj).closest('table').find('tfoot').find('tr').find('th:eq(4)').html(gtotal);
}

function saveOrder() {
  $('#orderTable').find('tbody').find('tr').each(function() {
    console.log('IN')
    var cobject = $(this).find('td:eq(2)').find('input.qty');
    // cobject.prop('name');
    gtotal += Number($(this).find('td:eq(4)').html());
  });
}

function changeRoomType(obj) {
  var rooms = rooms_data[$(obj).val()].rooms;
  var selObj = $(obj).closest('.form-group').siblings('.form-group').find('select[name="room"]');
  // console.log(rooms.length);
  selObj.html('<option value="">Select Room</option>');
  for(i=0;i<rooms.length;i++) {
    selObj.append('<option value="'+ rooms[i].id +'">'+ rooms[i].room_no +'</option>');
  }
}
