$(document).ready(function(){
    function validate_inputs(){
        let errors = $(".error");
        let err_length = errors.length;
        for(let i = 0; i < err_length; i++) {
            if($(errors[i]).html() !== ""){
                $($(errors[i]).parent().children()[1]).css("border-color", "red");
            }
        }
    }
    validate_inputs();

    // validate verification code
    $("#code_btn").css("opacity","0.9");
    $("#v_code").on("keyup", function(){
        if($(this).val() !== ""){
            if(isNaN($(this).val())){
                $(this).css({"border-color": "red", "box-shadow":"none"});
            }
            else{
                $(this).css({"border-color": "#ced4da","box-shadow": "0 0 0 0.2rem rgba(40, 200, 69, 0.25)"});
                if($(this).val().length == 6){
                    $("#code_btn").css("opacity","1");
                    $("#code_btn").removeAttr("disabled");
                    
                }
                else{
                    $("#code_btn").css("opacity","0.9");
                }
            }
        }
        else{
            $(this).css({"border-color": "#ced4da","box-shadow": "0 0 0 0.2rem rgba(40, 200, 69, 0.25)"});
            $("#code_btn").css("opacity","0.9");
        }
    });
    
    
});