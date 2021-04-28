$(function () {
    $("#rateYo").rateYo({ //uso l'id per il valore da inserire a db
        fullStar: true,
        spacing: "5px",
        rating: 4,
        score: 4,
        multiColor: {

            "startColor": "#444444", //GRAY
            "endColor": "#4d0000" //RED
        },
        onSet: function (rating, rateYoInstance) {
            document.getElementById('hiddenRating').value=rating; //add rating value to input field
        },
        onChange: function (rating, rateYoInstance) {
          document.getElementById('hiddenRating').value=rating; //add rating value to input field
          }
    });
   
    $(".rateyo").rateYo({ //uso la classe perchè questi sono utilizzati come output delle recessioni già avvenute
        readOnly: true,
        spacing: "5px",
        multiColor: {

            "startColor": "#444444", //GRAY
            "endColor": "#4d0000" //RED
        }
    });
});

// Getter
var normalFill = $("#rateYo").rateYo("option", "fullStar"); //returns true
var ratedFill = $("#rateYo").rateYo("option", "multiColor");
var readOnly = $(".rateyo").rateYo("option", "readOnly");
var onSet = $("#rateYo").rateYo("option", "onSet");
var onChange = $("#rateYo").rateYo("option", "onChange");

// Setter
$("#rateYo").rateYo("option", "fullStar", true); //returns a jQuery Element
$("#rateYo").rateYo("option", "multiColor", false);
$(".rateYo").rateYo("option", "readOnly", false);
$("#rateYo").rateYo("option", "onSet", function () {
 
    console.log("This is a new function");
       });
$("#rateYo").rateYo("option", "onChange", function () {
 
    console.log("this is a new function");
       });