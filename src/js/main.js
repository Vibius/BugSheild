$(document).ready(function(){
  
   $('.stack-function').click(function(){
       $(this).siblings('.stack-slideable').slideToggle(400);
       $(this).children('span').toggleClass('fa-angle-up').toggleClass('fa-angle-down');
   });
    
   $('.main-panel-details-block').children('p').click(function(){
       $(this).siblings('pre').slideToggle(400);
       $(this).children('span').toggleClass('fa-angle-up').toggleClass('fa-angle-down');
   });

});