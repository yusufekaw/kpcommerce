$(document).ready(function() {

    $('select[name="provinsi"]').on('change', function(){
        var provinsiId = $(this).val();
        if(provinsiId) {
            $.ajax({
                url: 'http://localhost/kpupload/kota/get/'+provinsiId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('select[name="kota"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="kota"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="kota"]').empty();
        }

    });

});