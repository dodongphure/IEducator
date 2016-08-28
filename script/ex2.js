countLis = 1;
function playVid(questions, stuID, exID) { 
    var questions = atob(questions);
    myVideo = document.getElementById("myVideo");
    myVideo.defaultPlaybackRate = 1;
    myVideo.load();
    if (countLis==1) {
        alert("You have to listen for the first time!");
        myVideo.play();
        countLis = 2;
    }
    else if (countLis==2) {
        alert("Now! You have to listen for the second time. Please take note this time!");
        myVideo.play();
        countLis = 3;
    }
    else if (countLis==3) {
        alert("Answer and click continue button to continue");
        showQuestion(questions.split("*/*"));
        countLis = 4;
    }
    else if (countLis==4) {
        alert("You have to listen for the third time!");
        myVideo.play();
        countLis=5;
    }
    else if (countLis==5) {
        alert("Check your answers then click submit button");
        showSubmitBtn(stuID, "'"+exID+"'");
        countLis=6;
        document.getElementById("startBtn").disabled = true;
    }
} 

if(myVideo){
    myVideo.onended = function() {
        playVid();
    };
}

function showQuestion(questions) {
    var answer = document.getElementById("question");
    var formUpload = document.createElement("form");
    formUpload.setAttribute("id", "formUpload");
    for (i = 0; i < questions.length; i++) {
        var nodeLabel = document.createElement("label");
        var nodeTextLabel = document.createTextNode(questions[i]);
        var inputQuestion = document.createElement("input");
        inputQuestion.setAttribute("type", "hidden");
        inputQuestion.setAttribute("class", "questions");
        inputQuestion.setAttribute("value", questions[i]);
        formUpload.appendChild(inputQuestion);
        var nodeInput = document.createElement("input");
        nodeInput.setAttribute("class","text-form-editor ans");
        nodeInput.required = true;
        nodeLabel.appendChild(nodeTextLabel);
        formUpload.appendChild(nodeLabel);
        formUpload.appendChild(nodeInput);
        var brEle = document.createElement("br");
        formUpload.appendChild(brEle);
    }
    answer.appendChild(formUpload);
    /*var checkResultBtn = document.createElement("button");
    checkResultBtn.setAttribute("onclick","playVid()");
    checkResultBtn.setAttribute("id","continueBtn");
    checkResultBtn.setAttribute("class","mc-btn btn-style-1");
    var nodeText = document.createTextNode("Continue");
    checkResultBtn.appendChild(nodeText);
    answer.appendChild(checkResultBtn);*/
    document.getElementById("startBtn").innerHTML = "Continue";
}

function showSubmitBtn(stuID, exID) {
    var answer = document.getElementById("question");
    //answer.removeChild(document.getElementById("continueBtn"));
    var checkResultBtn = document.createElement("button");
    checkResultBtn.setAttribute("onclick","confirmCheckResult("+stuID+", "+exID+")");
    checkResultBtn.setAttribute("class","mc-btn btn-style-1");
    checkResultBtn.setAttribute("id","submitButton");
    var nodeText = document.createTextNode("Save & Submit");
    checkResultBtn.appendChild(nodeText);
    answer.appendChild(checkResultBtn);
}

function checkResult(stuID, exID){

    var Ans = document.getElementsByClassName("ans");
    var ansArr = new Array();
    for(i=0; i<Ans.length; i++){
        ansArr.push(Ans[i].value);
    }
    var questions = document.getElementsByClassName("questions");
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

function pauseVid() { 
    myVideo.pause(); 
} 
