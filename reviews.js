$(function () {
    $("#rateYo").rateYo({ 
        fullStar: true,
        spacing: "5px",
        rating: 4,
        score: 4,
        multiColor: {

            "startColor": "#444444", 
            "endColor": "#4d0000"
        },
        onSet: function (rating, rateYoInstance) {
            document.getElementById('hiddenRating').value=rating; 
        },
        onChange: function (rating, rateYoInstance) {
          document.getElementById('hiddenRating').value=rating; 
          }
    });
   
    $(".rateyo").rateYo({
        readOnly: true,
        spacing: "5px",
        multiColor: {

            "startColor": "#444444", 
            "endColor": "#4d0000"
        }
    });
});


var normalFill = $("#rateYo").rateYo("option", "fullStar"); 
var ratedFill = $("#rateYo").rateYo("option", "multiColor");
var readOnly = $(".rateyo").rateYo("option", "readOnly");
var onSet = $("#rateYo").rateYo("option", "onSet");
var onChange = $("#rateYo").rateYo("option", "onChange");


$("#rateYo").rateYo("option", "fullStar", true);
$("#rateYo").rateYo("option", "multiColor", false);
$(".rateYo").rateYo("option", "readOnly", false);
$("#rateYo").rateYo("option", "onSet", function () {
 
    console.log("This is a new function");
       });
$("#rateYo").rateYo("option", "onChange", function () {
 
    console.log("this is a new function");
       });