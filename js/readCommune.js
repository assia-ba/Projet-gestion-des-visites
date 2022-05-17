$(document).ready(function(){
    $("#searchCommune").keyup(function(){
        $.ajax({
        type: "POST",
        url: "../model/readCommune.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#searchCommune");
        },
        success: function(data){
            $("#suggesstionCommune").show();
            $("#suggesstionCommune").html(data);
            $("#searchCommune").css("background","#FFF");
            window.onclick = function() {
                    $("#suggesstionCommune").hide();
            }
        }
        });
    });
});

function selectCommune(Commune, pays, province, cercle, caidat, domaine) {
    $("#searchCommune").val(Commune);
    $("#pays").val(pays);
    $("#province").val(province);
    $("#cercle").val(cercle);
    $("#caidat").val(caidat);
    $("#domaine").val(domaine);
    $("#suggesstionCommune").hide();}