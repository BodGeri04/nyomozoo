;(function($) {
    "use strict";  


    //* Form js
    function verificationForm(){
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches
        $(".next").click(function () {
            var form = $("#msform");
            form.validate({
                errorElement: 'span',
                errorClass: 'help-block',
                highlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-group').addClass("has-error");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-group').removeClass("has-error");
                },
                rules: {
                    title: {
                        required: true,
                        minlength: 6,
                        maxlength: 100,
                    },
                    animal_type:{
                        required: true,
                    },
                    search_find:{
                        required: true,
                    },
                    sex:{
                        required: true,
                    },
                    name: {
                        required: true,
                        minlength: 3,
                    },
                    disappeared: {
                        required: true,
                        date:true,
                    },
                    pre_phone_number: {
                        required:true,
                    },
                    phone_number: {
                        required: true,
                        minlength: 9,
                        number:true,
                    },
                    zip_number: {
                        required: true,
                        minlength: 4,
                        maxlength: 4,
                        number:true,
                    },
                    characteristics: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: "A mező kitöltése kötelező.",
                        minlength: "Írj be minimum 6 karaktert.",
                        maxlength: "Maximum 100 karakter fogadható el.",
                    },
                    name: {
                        required: "A mező kitöltése kötelező.",
                        minlength: "Írj be minimum 3 karaktert.",
                    },
                    animal_type: {
                        required: "Kérjük válassz ki egyet.",
                    },
                    search_find: {
                        required: "Kérjük válassz ki egyet.",
                    },
                    sex: {
                        required: "Kérjük válassz ki egyet.",
                    },
                    disappeared: {
                        required: "A mező kitöltése kötelező.",
                        date: "A mező csak dátum értékeket tartalmazhat."
                    },
                    pre_phone_number: {
                        required: "A mező kitöltése kötelező.",
                    },
                    phone_number: {
                        required: "A mező kitöltése kötelező.",
                        minlength: "Írj be minimum 9 karaktert.",
                        number:"A betűk használata nem engedett.",
                    },
                    zip_number: {
                        required: "A mező kitöltése kötelező.",
                        minlength: "Írj be minimum 4 karaktert.",
                        maxlength: "Maximum 4 szám fogadható el.",
                        number: "A betűk használata nem engedett.",
                    },
                    characteristics: {
                        required: "A mező kitöltése kötelező.",
                    },
                }
            });
            if (form.valid() === true){
               if ($(".next").click){
                    if (animating) return false;
                     animating = true;
                     current_fs = $(this).parent();
                     next_fs = $(this).parent().next();
                }
                 //activate next step on progressbar using the index of next_fs
             $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
             //show the next fieldset
             next_fs.show();
             //hide the current fieldset with style
             current_fs.animate({
                 opacity: 0
             },{
             step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
            }
            
        });

        $(".previous").click(function () {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1 - now) * 50) + "%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".submit").click(function () {
            return false;
        })
    }; 
        //* Add Phone no select
    function phoneNoselect(){
        if ( $('#msform').length ){   
            $("#phone").intlTelInput(); 
            $("#phone").intlTelInput("setNumber", "+36"); 
        };
    }; 
    //* Select js
    function nice_Select(){
        if ( $('.product_select').length ){ 
            $('select').niceSelect();
        };
    }; 
    /*Function Calls*/  
    verificationForm ();
    phoneNoselect ();
    nice_Select ();
})(jQuery); 
