$(document).ready(
function(){
  /* This is the function that will get executed after the DOM is fully loaded */
    /* Next part of code handles hovering effect and submenu appearing */
    $("#topicmenua").click({param1:"0"},topicmovewrap);
    $("#topicmenub").click({param1:"1"},topicmovewrap);
    $("#topicmenuc").click({param1:"2"},topicmovewrap);
    $("#topicmenud").click({param1:"3"},topicmovewrap);
    $("#topicmenue").click({param1:"4"},topicmovewrap);
    $("#topicmenuf").click({param1:"5"},topicmovewrap);
    $("#topicmenug").click({param1:"6"},topicmovewrap);

    t = setInterval(picTurn, 3000);
    $(".topic-preview").hover(function(){clearInterval(t);},function(){t=setInterval(picTurn,3000);});
    $("#topic-preview-menu-wrapper").hover(function(){clearInterval(t);},function(){t=setInterval(picTurn,3000);});
    /*$("#banner").hover(
      function(){
        clearInterval(t)
      }, 
      function(){
        t = setInterval("showAuto()", 500);
      });*/
});
var count = 0;
function picTurn(){
  switch(count){
    case 0:
      topicmove('0');
      break;
    case 1:
      topicmove('1');
      //count++;
      break;
    case 2:
      topicmove('2');
      //count++;
      break;
    case 3:
      topicmove('3');
      //count++;
      break;
    case 4:
      topicmove('4');
      //count++;
      break;
    case 5:
      topicmove('5');
      //count++;
      break;
    case 6:
      topicmove('6');
      //count = 0;
      break;
  }
}

function topicmovewrap(x){
  var v = x.data.param1;
  topicmove(v);
}

function resetsakura(){
  $("#topicmenua").css('background-image', 'url("./pic/sakurapiece.png")');
  $("#topicmenua").addClass("sakura");
  $("#topicmenub").css('background-image', 'url("./pic/sakurapiece.png")');
  $("#topicmenub").addClass("sakura");
  $("#topicmenuc").css('background-image', 'url("./pic/sakurapiece.png")');
  $("#topicmenuc").addClass("sakura");
  $("#topicmenud").css('background-image', 'url("./pic/sakurapiece.png")');
  $("#topicmenud").addClass("sakura");
  $("#topicmenue").css('background-image', 'url("./pic/sakurapiece.png")');
  $("#topicmenue").addClass("sakura");
  $("#topicmenuf").css('background-image', 'url("./pic/sakurapiece.png")');
  $("#topicmenuf").addClass("sakura");
  $("#topicmenug").css('background-image', 'url("./pic/sakurapiece.png")');
  $("#topicmenug").addClass("sakura");
}

function topicmove(v){
  switch(v){
    case '0':
      $(".topic-preview").css("margin-left","0%");
      resetsakura();
      $("#topicmenua").css('background-image', 'url("./pic/sakura.png")');
      $("#topicmenua").removeClass("sakura");
      count = 1;
    break;

    case '1':
      $(".topic-preview").css("margin-left","-100%");
      resetsakura();
      $("#topicmenub").css('background-image', 'url("./pic/sakura.png")');
      $("#topicmenub").removeClass("sakura");
      count = 2;
    break;

    case '2':
      $(".topic-preview").css("margin-left","-200%");
      resetsakura();
      $("#topicmenuc").css('background-image', 'url("./pic/sakura.png")');
      $("#topicmenuc").removeClass("sakura");
      count = 3;
    break;

    case '3':
      $(".topic-preview").css("margin-left","-300%");
      resetsakura();
      $("#topicmenud").css('background-image', 'url("./pic/sakura.png")');
      $("#topicmenud").removeClass("sakura");
      count = 4;
    break;

    case '4':
      $(".topic-preview").css("margin-left","-400%");
      resetsakura();
      $("#topicmenue").css('background-image', 'url("./pic/sakura.png")');
      $("#topicmenue").removeClass("sakura");
      count = 5;
    break;

    case '5':
      $(".topic-preview").css("margin-left","-500%");
      resetsakura();
      $("#topicmenuf").css('background-image', 'url("./pic/sakura.png")');
      $("#topicmenuf").removeClass("sakura");
      count = 6;
    break;

    case '6':
      $(".topic-preview").css("margin-left","-600%");
      resetsakura();
      $("#topicmenug").css('background-image', 'url("./pic/sakura.png")');
      $("#topicmenug").removeClass("sakura");
      count = 0;
    break;
  }
}