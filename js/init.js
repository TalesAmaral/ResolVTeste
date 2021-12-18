(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space


$(".dropdown-trigger").dropdown();

$('#textarea1').val('');
M.textareaAutoResize($('#textarea1'));
