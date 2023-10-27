import './bootstrap';

import '../sass/app.scss'

$(document).ready(function(){

    $(".editableBox").change(function(){
        $(".timeTextBox").val($(".editableBox option:selected").html());
    });
});
