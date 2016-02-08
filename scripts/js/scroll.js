$(document).on('scroll', function() {
  if ($(document).scrollTop() > $('.header .content').height()) {
    $('.header .navigation').addClass('fixed');
  }
  else {
    $('.header .navigation').removeClass('fixed');
  }
});
