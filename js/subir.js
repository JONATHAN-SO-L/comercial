$(document).ready(function(){ irArriba(); }); //Hacia arriba

function irArriba(){
  $('.ir-arriba').click(function(){ $('body,html').animate({ scrollTop:'0px' },100); });
  $(window).scroll(function(){
    if($(this).scrollTop() > 0){ $('.ir-arriba').slideDown(100); }else{ $('.ir-arriba').slideUp(100); }
  });
  $('.ir-abajo').click(function(){ $('body,html').animate({ scrollTop:'100px' },100); });
}