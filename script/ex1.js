var j = 1;
var result = [];
var result_ex1 = [];

function showScript(text, stuID, exID, audioSrc) {
    //create audio
    var audio = document.createElement("AUDIO");
    audio.setAttribute("id","audiotag");
    audio.setAttribute("src",audioSrc);
    audio.setAttribute("controls", "controls");
    document.getElementById("myVideo").appendChild(audio);
    audiotag = document.getElementById('audiotag');
    audiotag.addEventListener("playing", function () {
          setTimeout(function(){pauseVid(audiotag)}, 7000);
        }, false);

    var $sidebar   = $("#myVideo"), 
        $window    = $(window),
        pos = 125

    $window.scroll(function() {
        if ($window.scrollTop() > pos) {
            $sidebar.css({
                position: 'fixed',
                top: 0
            });
        } else {
            $sidebar.css({
                position: 'absolute',
                top: pos
            });
        }
    });

    document.getElementById("startBtn").disabled = true;
    var scr = atob(text).split(" "); 
    var scrOrigin = atob(text).split(" ");
    var scrLength = scr.length;
    result[0] = "";
    var q = 0;
    for (i = 0; i < parseInt(scrLength*3/4); i++) {
    	var x = Math.floor((Math.random() * (scrLength-1)) + 1);
    	if (checkUppercase(scr[x]))
    		;
    	else
    		scr[x] = "xxx";
	}

    for (i = 0; i < scrLength; i++) {
     	if (scr[i]=="xxx") {
     		result[j] = scrOrigin[i].replace(/[^A-Za-z0-9]/g, '');
    		scr[i] = "<strong>("+j.toString()+")</strong> <input class=\"text-form-editor ans\" size=\""+result[j].length+"\">";
    		j++;
    	}
	}
	var scrResult = scr.join(" ");
	document.getElementById("scriptResult").innerHTML = scrResult;

    var answer = document.getElementById("answer");
    /*for (i = 0; i < j-1; i++) {
    	var nodeLabel = document.createElement("label");
        if(i+1<10) prefix="0";
        else prefix="";
    	var nodeTextLabel = document.createTextNode(prefix+(i+1)+"-");
    	var nodeInput = document.createElement("input");
    	nodeInput.setAttribute("class","text-form-editor ans");
    	nodeLabel.appendChild(nodeTextLabel);
    	answer.appendChild(nodeLabel);
    	answer.appendChild(nodeInput);
        if((i+1)%5 == 0)
            answer.appendChild(document.createElement("br"));
	}*/
    var brEle = document.createElement("br");
    answer.appendChild(brEle);
	var checkResultBtn = document.createElement("button");
	checkResultBtn.setAttribute("onclick","confirmCheckResult("+stuID+", '"+exID+"')");
	var nodeText = document.createTextNode("Submit");
    checkResultBtn.setAttribute("class","mc-btn btn-style-1");
    checkResultBtn.setAttribute("id","submitButton");
	checkResultBtn.appendChild(nodeText);
    var divCenter = document.createElement("div");
    divCenter.setAttribute("class","create-course-content form-action");
    divCenter.appendChild(checkResultBtn);
	answer.appendChild(divCenter);
}

function checkResult(stuID, exID) {
	for (i = 1; i < j; i++) {
		var tempAns = document.getElementsByClassName("ans")[i-1].value;
     	if (tempAns==result[i]) {
     		result_ex1[i]="true";
    	}
    	else {
			result_ex1[i]="false";
    	}
	}
	sai=0;
	for (i = 1; i < j; i++) {
		if (result_ex1[i]=="false") {
			sai++;
		}
	}
    tong = parseInt(j)-1;
    if(tong==sai) kq=0;
    else kq=tong-sai;
    addScore_ex1(stuID, exID, kq, sai, j, result);	
}


function pauseVid(myVideo) {
    myVideo.pause();
    var curTime = myVideo.currentTime;
    myVideo.currentTime = curTime - 1;
}

function checkUppercase (strings) {
	check = false;
    character = strings.charAt(0);
	if (!isNaN(character * 1)) {
	    ;
	} else {
		if (character == character.toUpperCase())
			return true;
	}
	return check;
}

function playVid() {
    myVideo.play();
}


