$(document).ready(function() {
 
    console.log("document ready"); // **** ADD THIS LINE ****
 
  $("#signup").click(function() {
 
    console.log("#signup clicked"); // **** ADD THIS LINE ****
 
    $("#first").slideUp("slow", function() {
      $("#second").slideDown("slow");
    });
  });
  
 
  $("#signin").click(function() {
 
    console.log("#signin clicked"); // **** ADD THIS LINE ****
    
    $("#second").slideUp("slow", function() {
      $("#first").slideDown("slow");
    });
  });
  });