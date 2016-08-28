function checkResult(stuID, exID){
	var Ans = document.getElementsByClassName("ans");
    var ansArr = new Array();
    for(i=0; i<Ans.length; i++){
        ansArr.push(Ans[i].value);
    }
    var questions = document.getElementsByClassName("keywords");
    var questionsArr = new Array();
    for(i=0; i<questions.length; i++){
        questionsArr.push(questions[i].value);
    }
    $.ajax({
        url: "saveStudentData.php",
        type: "POST",
        data: {"stuID":stuID,
                "exID":exID,
                "content":questionsArr,
                "answer":ansArr},
        success: function(strData){
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