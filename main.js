$(document).ready(function() {

  $("#signup").css("display", "none");
  $("#uploadForm").css("display", "none");

  //index
  $(".change").click(function() {
    $("#signup").toggle();
    $("#login").toggle();
  });

  //homepage
  $("#show").click(function() {
    $("#uploadForm").toggle();
  });

  $("#hide").click(function() {
    $("#uploadForm").css("display", "none");
  });

  $(".fa-close").css("display", "none");

  $(".fa-bars").click(function() {
      $("#sidemenu").toggleClass("sidemenu");
      $("#heading .fa-bars").toggleClass("fa-rotate-90");
  });	  

  //common for all
  $(document).mouseup(function(e) {
    var getSidemenu = $("#sidemenu");
    if(!getSidemenu.is(e.target) && getSidemenu.has(e.target).length === 0 && $("#heading").has(e.target).length === 0) {
      getSidemenu.removeClass("sidemenu");
      $("#heading .fa-bars").removeClass("fa-rotate-90");
    }
  });	
});	