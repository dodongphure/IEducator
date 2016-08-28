function checkResult (stuID, exID){
    var Ans = document.getElementsByClassName("ans");
    var ansArr = new Array();
    for(i=0; i<Ans.length; i++){
        ansArr.push(Ans[i].value);
    }
    $.ajax({
        url: "checkResult.php",
        type: "POST",
        data: {"stuID":stuID,
                "exID":exID,
                "answer":ansArr},
        success: function(strData){
            truefalse = strData.split("/*DoDongPhure*/")[0].split("\n")[1];
            extimesremain = strData.split("/*DoDongPhure*/")[0].split("\n")[2];
            swal(truefalse, extimesremain);
            if(strData.split("/*DoDongPhure*/")[1] > 0)
                document.getElementById("exList"+exID).innerHTML = "<a href=\"#action\" onclick=\"loadEx('"+exID+"')\">"+convertExName(exID.split("-")[1])+" ("+strData.split("/*DoDongPhure*/")[1]+")<a>";
            else{
                document.getElementById("exList"+exID).innerHTML = "<a>"+convertExName(exID.split("-")[1])+" - Done!<a>";
                document.getElementById("submitButton").disabled = true;

                answer = strData.split("/*DoDongPhure*/")[0].split("\n")[0];
                answers = answer.split("*/*");
                var resultFinal = document.getElementById("result");
                createAnsTable(resultFinal, document.getElementsByClassName("ans"), answers);
            }
        }
    });
}