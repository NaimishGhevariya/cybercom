
$flag1 =false;
$flag2 =false;
$flag3 =false;
$(document).ready(function(){

    $(".name").focusout(function(){
        if($(".name").is(":valid")){
            $(".nameholder").removeClass("errorborder");   
            $(".nameholder i").removeClass("errortext");
            $(".nameholder").addClass("valid");
            $(".nameholder i").addClass("validtext");
            $flag1 = true;
        }
        else{
             $(".nameholder").removeClass("valid");   
             $(".nameholder i").removeClass("validtext");
             $(".nameholder").addClass("errorborder");
             $(".nameholder i").addClass("errortext");
             $flag1 = false;
       }
    }),
    $(".email").focusout(function(){
        if($(".email").is(":valid")){
            $(".emailholder").removeClass("errorborder");   
            $(".emailholder i").removeClass("errortext");
            $(".emailholder").addClass("valid");
            $(".emailholder i").addClass("validtext");
            $flag2 = true;
        }
        else{
             $(".emailholder").removeClass("valid");   
             $(".emailholder i").removeClass("validtext");
             $(".emailholder").addClass("errorborder");
             $(".emailholder i").addClass("errortext");
             $flag2 = false;
       }
    }),

       $(".mobileno").focusout(function(){
        if($(".mobileno").is(":valid")){
            $(".mobilenoholder").removeClass("errorborder");  
            $(".mobilenoholder i").removeClass("errortext"); 
            $(".mobilenoholder").addClass("valid");
            $(".mobilenoholder i").addClass("validtext");
            $flag3 = true;
        }
        else{
             $(".mobilenoholder").removeClass("valid");   
             $(".mobilenoholder i").removeClass("validtext");
             $(".mobilenoholder").addClass("errorborder");
             $(".mobilenoholder i").addClass("errortext");
             $flag3 = false;
       };
})
})

function display(){
    if($flag1 && $flag2 && $flag3)
    alert("Your request has been submitted !!");
    else
    alert("Enter valid input.");
}