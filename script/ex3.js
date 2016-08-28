function playAudioBtn(){
    document.getElementById("playAudioBtn").disabled = true;
    document.getElementById("myVideo").play();
}

function checkResult(stuID, exID){
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
                createAnsTable(resultFinal, document.getElementsByClassName("ans"), answers);console.log(answers);

                for(i=0; i<answers.length; i++){
                    var showAns = document.getElementById("showAns"+i);
                    showAns.style.display = "block";
                }
            }
        }
    });

}
function showAns(id, answer){
    var answer=atob(answer);
    answer = answer.split("*/*");
	var ans = document.getElementById("showAns"+id);
	var nodeP = document.createElement("p");
	var nodeText = document.createTextNode(answer[id]+"");
	nodeP.appendChild(nodeText);
	ans.appendChild(nodeText);
    document.getElementById("showAnsLink"+id).style = "pointer-events: none; cursor: default;";
}