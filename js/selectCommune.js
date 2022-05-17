$(document).ready(function(){
    $(function(){
    $('#commune_form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            var post_url = form.attr('action');
            var post_data = form.serialize();

            $.ajax({
                type: 'POST',
                url: post_url, 
                data: post_data,
                success: function(communeData) {
                    document.getElementById('id01').style.display='none';
                    $(form).fadeOut(100, function(){
                        document.getElementById('id01').style.display='none';
                        $('#id01').hide();
                        var array = JSON.parse(communeData);
                        $("#selectCommune").append('<option id="commune'+array[0]+'" value="'+array[0]+'" data-select2-id="select2-data-commune'+array[0]+'" selected="selected">'+array[1]+" "+array[2]+" "+array[3]+" "+array[4]+" "+array[5]+" "+array[6]+'</option>'); 
                    });

                }
    
            });
        
        });
    
    });
    
});