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
