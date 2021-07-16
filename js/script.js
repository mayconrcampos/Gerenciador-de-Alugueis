$(document).ready(function(){

    $('#select').on('change', function(){
        
        var selectDiv = $(this).val();
        
        $('#pai').children('div').hide();
        $('#pai').children(selectDiv).show();
    });
});