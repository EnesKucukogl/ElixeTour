///////////////////////////////////////POP UP///////////////////////////////////////
function popups(name,open){
    if(open){
      $("." + name + "-main").addClass('model-open');
    }
   else{
    $("." + name + "-main").removeClass('model-open');
   }
  
  }



  