$(document).ready(function() {
  // $('.' + $("select[name='categoryType']").val()).show();
  $("select[name='advisorFilter']").on('change', function() {
    $('.adv').hide();
    $('.' + $(this).val()).show();
  });

});
