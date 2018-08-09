$(function() {

  if ($('#toTop')) {
    $(window).scroll(function() {

      if($(this).scrollTop() != 0){
        $('#toTop').fadeIn();
      } else {
        $('#toTop').fadeOut();
      }
    });

    $('#toTop').click(function() {
      $('body,html').animate({scrollTop:0},800);
    });
  }

  // function showFocuse() {
  //   var show = document.querySelector('#show');
  //   var focus = document.activeElement.nodeName;
  //   show.innerHTML = focus;
  // };

  document.addEventListener('keydown', function(event){
    if (event.keyCode === 9) {
      // setTimeout(showFocuse, 1000);
      console.dir(document);
    }
  });


});
