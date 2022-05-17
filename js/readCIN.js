
        $(document).ready(function(){
            $("#search-box").keyup(function(){
                $.ajax({
                type: "POST",
                url: "../model/readCIN.php",
                data:'keyword='+$(this).val(),
                beforeSend: function(){
                    $("#search-box");
                },
                success: function(data){
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search-box").css("background","#FFF");
                    window.onclick = function() {
                        $("#suggesstion-box").hide();
                }
                }
                });
            });
        });

        function selectCIN(cin, nomComplet, adresse, numTele) {
            $("#search-box").val(cin);
            $("#name").val(nomComplet);
            $("#adresse").val(adresse);
            $("#numTele").val(numTele);
            $("#suggesstion-box").hide();}
  