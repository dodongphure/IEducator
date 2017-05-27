function loadAction(action, form){
	var exScript = document.getElementById("completeScript");
	if(exScript!=null)
		exScript.parentNode.removeChild(exScript);
	if(action=='addGroup.php'){
		var oHead = document.getElementsByTagName('HEAD').item(0);
		var oScript= document.createElement("script");
		oScript.type = "text/javascript";
		oScript.src="script/autoComplete.js";
		oScript.id="completeScript";
		oHead.appendChild( oScript);
	}

	var ckeditor = document.getElementById("ckeditorScript");
	if(ckeditor!=null)
		ckeditor.parentNode.removeChild(ckeditor);
	if(action=='addPost.php'){
		var oHead = document.getElementsByTagName('HEAD').item(0);
		var oScript= document.createElement("script");
		oScript.type = "text/javascript";
		oScript.src="script/ckeditor/ckeditor.js";
		oScript.id="ckeditorScript";
		oHead.appendChild( oScript);
	}


	var submittingButton = document.getElementById("submittingButton");
	if(submittingButton!=null){
		submittingButton.textContent = "Processing...";
		submittingButton.disabled = true;
	}


	var formdata = new FormData($("form#"+form)[0]);
	$.ajax({
		url: action,
		type: "POST",
		data: formdata,
		dataType: "html",
		cache: false,
    	contentType: false,
    	processData: false,
		success: function(strData){
			document.getElementById("contentPage").innerHTML = strData;
			if(action=='addPost.php'){
				$.getScript("script/ckeditor/ckeditor.js", function(){
					CKEDITOR.replace('postArea');
				});
			}
		}
	});
}

function loadActionEx5(action, form){
	var formdata = new FormData($("form#"+form)[0]);
	$.ajax({
		url: action,
		type: "POST",
		data: formdata,
		dataType: "html",
		cache: false,
    	contentType: false,
    	processData: false,
		success: function(strData){
			//for writing and movie
			if((action == 'loadEx.php?Ex5=action')||(action == 'loadEx.php?Ex8=action')){
				dataSerialize = $("form#"+form).serializeArray();
				$.each(dataSerialize, function(i, field){
					if(field.name == 'ex'){
						exID = field.value;
						document.getElementById("exList"+exID).innerHTML = "<a>"+convertExName(exID.split("-")[1])+" - Done!<a>";
					}
		        });
		        if(action == 'loadEx.php?Ex5=action')
            		document.getElementById("contentPage").innerHTML = "You will receive notification when teacher has checked your writing.";
            	else
            		document.getElementById("saveButton").disabled = true;
			}
		}
	});
}

function loadSignup(action, form){
	var formdata = new FormData($("form#"+form)[0]);
	$.ajax({
		url: action,
		type: "POST",
		data: formdata,
		dataType: "html",
		cache: false,
    	contentType: false,
    	processData: false,
		success: function(strData){
			alert(strData);
            window.location.href = 'index.php';
		}
	});
}

function loadEx(exID){
	var exScript = document.getElementById("exScript");
	if(exScript!=null)
		exScript.parentNode.removeChild(exScript);
	var ex=exID.split("-ex")[1];
	ex=ex.split(".")[0];
	var oHead = document.getElementsByTagName('HEAD').item(0);
	var oScript= document.createElement("script");
	oScript.type = "text/javascript";
	switch(ex){
		case '1':
			oScript.src="script/ex1.js";
			break;
		case '2':
			oScript.src="script/ex2.js";
			break;
		case '3':
			oScript.src="script/ex3.js";
			break;
		case '4':
			oScript.src="script/ex4.js";
			break;
		case '6':
			oScript.src="script/ex6.js";
			break;
		case '7':
			oScript.src="script/ex7.js";
			break;
		case '9':
			oScript.src="script/ex3.js";// re-use ex3.js
			break;
		case '10':
			oScript.src="script/ex3.js";// re-use ex3.js
			break;
	}
	oScript.id="exScript";
	oHead.appendChild( oScript);

	$.ajax({
		url: "loadEx.php",
		type: "POST",
		data: {"exID":exID},
		dataType: "html",
		success: function(strData){
			document.getElementById("contentPage").innerHTML = strData;
		}
	});

	reportExProblems = document.getElementById("reportExProblems");
	if(reportExProblems){
		reportExProblems.innerHTML = '<form id="reportExForm"><input type="hidden" name="exID" value="'+exID+'">'+
		'<a href="#action" onclick="loadAction(\'reportEx.php?type=edit\', \'reportExForm\')" style="color:orange">Report this exercise</a></form>';
	}
}

function convertExName(exID){
    var exID = exID.split(".");
    var exType = exID[0];
    var ex = exID[1];
    var res="";
    switch (exType) {
        case 'ex1':
            res="Exercise 1 (VOA)";
            break;
        case 'ex2':
            res="Exercise 2 (BBC)";
            break;
        case 'ex3':
            res="Exercise 3 (Listening)";
            break;
        case 'ex4':
            res="Exercise 4 (Reading)";
            break;
        case 'ex5':
            res="Exercise 6 (Writing)";
            break;
        case 'ex6':
            res="Exercise 5 (Reading Keywords)";
            break;
        case 'ex7':
            res="Exercise 7 (Grammar)";
            break;
        case 'ex8':
            res="Exercise 8 (Movies)";
            break;
        case 'ex9':
            res="Exercise 9 (Toeic Listening)";
            break;
        case 'ex10':
            res="Exercise 10 (Toeic Reading)";
            break;
        default:
            break;
    }
    return res+=" - Task "+ex;
}

function compareAnswer(stuAns, answer){
	var answer = answer.split("/");
	var stuAns = stuAns.split("/");
	for(var i=0; i<answer.length; i++){
		for(j=0; j<stuAns.length; j++){
			if (answer[i].toLowerCase() == stuAns[j].toLowerCase())
				return true;
		}
	}
	return false;
}

function createAnsTable(resultFinal, stuAns, answers){
	count = answers.length;
	var table = document.createElement("TABLE");
	table.setAttribute("id","tableAns");
	resultFinal.appendChild(table);
	numCol = 10;
	numRow = Math.ceil(count/numCol);
	table = document.getElementById('tableAns');
	table.className = "table table-striped";
	for(i=0; i<numRow; i++){
    	row1 = table.insertRow(2*i);
    	row2 = table.insertRow(2*i+1);
    	numCell = ((i+1)*numCol<=count)?numCol:count%numCol;
    	for(ii=0; ii<numCell; ii++){
    		index = i*numCol+ii;
    		cell1 = row1.insertCell(ii);
    		cell1.innerHTML = index+1;
    		cell2 = row2.insertCell(ii);
    		if (!compareAnswer(stuAns[index].value, answers[index]))
    			cell2.innerHTML = '<span style="color: red;">'+answers[index]+'</span>';
    		else
    			cell2.innerHTML = '<span style="color: blue;">'+answers[index]+'</span>';
    	}
    }
}

function addScore_ex1(stuID, exID, kq, sai, j, answerKey){
	$.ajax({
		url: "addScore.php",
		type: "POST",
		data: {"stuID":stuID,
				"exID":exID,
				"score":kq+"/"+(kq+sai)},
		dataType: "html",
		success: function(strData){
			truefalse = "TRUE: "+kq+" | FALSE: "+sai;
			extimesremain = strData.split("/*DoDongPhure*/")[0];
			swal(truefalse, extimesremain);
			if(strData.split("/*DoDongPhure*/")[1] > 0)
				document.getElementById("exList"+exID).innerHTML = "<a href=\"#action\" onclick=\"loadEx('"+exID+"')\">"+convertExName(exID.split("-")[1])+" ("+strData.split("/*DoDongPhure*/")[1]+")<a>";
			else{
            	document.getElementById("exList"+exID).innerHTML = "<a>"+convertExName(exID.split("-")[1])+" - Done!<a>";
            	document.getElementById("submitButton").disabled = true;
            	var resultFinal = document.getElementById("result");
            	var table = document.createElement("TABLE");
            	table.setAttribute("id","tableAns");
            	resultFinal.appendChild(table);
            	numCol = 10;
            	numRow = Math.ceil((j-1)/numCol);
            	table = document.getElementById('tableAns');
            	table.className = "table table-striped";
			    for(i=0; i<numRow; i++){
			    	row1 = table.insertRow(2*i);
			    	row2 = table.insertRow(2*i+1);
			    	numCell = ((i+1)*numCol<=j-1)?numCol:(j-1)%numCol;
			    	for(ii=0; ii<numCell; ii++){
			    		index = i*numCol+ii+1;
			    		cell1 = row1.insertCell(ii);
			    		cell1.innerHTML = index;
			    		cell2 = row2.insertCell(ii);
			    		if (result_ex1[index]=="false")
			    			cell2.innerHTML = '<span style="color: red;">'+answerKey[index]+'</span>';
			    		else
			    			cell2.innerHTML = '<span style="color: blue;">'+answerKey[index]+'</span>';
			    	}
			    }
			}
		}
	});
}

function addMoreStu(){
	$("#inputStu").append('<input type="text" class="form-control" placeholder="Username of student" name="stu[]" autocomplete="off">');
	$("#inputStu").find('input[type=text]:last').autocomplete({
       	source: function(request, response) {
	  		$.ajax({
	  			url : "http://localhost/autoComplete.php",
	  			dataType: "json",
				data: {
				   name_startsWith: request.term,
				   type: "usernameAutoComplete"
				},
				success: function( data ) {
					response( $.map( data, function( item ) {
						return {
							label: item,
							value: item
						}
					}));
				}
	  		});
	  	},
  	minLength: 1
    });	
}

function addMoreEx(index){
	$("#inputEx").append('<div class="form-question mc-select"><select class="select" id="selectEx" name="exType[]">'+
	'<option value="ex1">Exercise 1 (VOA)</option><option value="ex2">Exercise 2 (BBC)</option><option value="ex3">Exercise 3 (Listening)</option>'+
	'<option value="ex4">Exercise 4 (Reading)</option><option value="ex6">Exercise 5 (Reading Keywords)</option><option value="ex5">Exercise 6 (Writing)</option>'+
	'<option value="ex7">Exercise 7 (Grammar)</option><option value="ex8">Exercise 8 (Movies)</option><option value="ex9">Exercise 9 (Toeic Listening)</option>'+
	'<option value="ex10">Exercise 10 (Toeic Reading)</option></select></div><div class="description-editor text-form-editor">'+
	'<input type="text" class="" placeholder="ID of exercise" name="ex[]" autocomplete="off" required></div>');
	// $("#inputEx").find('input[type=text]:last').autocomplete({
	// 	source: function(request, response) {
	//   		$.ajax({
	//   			url : "autoComplete.php",
	//   			dataType: "json",
	// 			data: {
	// 			   name_startsWith: request.term,
	// 			   type: "exAutoComplete",
	// 			   ex: document.getElementsByTagName("select")[index].value
	// 			},
	// 			success: function( data ) {
	// 				response( $.map( data, function( item ) {
	// 					return {
	// 						label: item,
	// 						value: item
	// 					}
	// 				}));console.log(data);
	// 			}
	//   		});
	//   	}, 	
	//   	minLength: 0
	// });
}

function addMoreQuestion(){
	$("#inputQuestion").append('<br><input type="text" class="form-control" placeholder="Content of question" name="question[]">');
}

function addMoreKeyword(){
	$("#inputKeyword").append('<br><input type="text" class="form-control" placeholder="Content of keyword" name="keyword[]">');
}

function addMoreAns(){
	$("#answer").append('<br><input type="text" class="form-control" placeholder="Content of answer" name="ans[]">');
}

function addMoreDailyEx(){
	$("#inputEx").append('<input type="text" class="form-control" placeholder="ID" name="dailyEx[]" autocomplete="off">');
}

function selectExOption(){
	var inputEx = document.getElementsByTagName("input");
	var lastInput = inputEx[inputEx.length-1];
	var selectEx = document.getElementsByTagName("select");
	var lastselectEx = selectEx[selectEx.length-1];
	if(lastselectEx.value == "ex5")
		lastInput.placeholder="Topic name";
	else
		lastInput.placeholder="ID of exercise";
}

function editAction(type, grID){
	var ckeditor = document.getElementById("ckeditorScript");
	if(ckeditor!=null)
		ckeditor.parentNode.removeChild(ckeditor);
	if(type=='editPost'){
		var oHead = document.getElementsByTagName('HEAD').item(0);
		var oScript= document.createElement("script");
		oScript.type = "text/javascript";
		oScript.src="script/ckeditor/ckeditor.js";
		oScript.id="ckeditorScript";
		oHead.appendChild( oScript);
	}

	$.ajax({
		url: type+".php?type=edit",
		type: "POST",
		data: {"grID":grID},
		dataType: "html",
		success: function(strData){
			document.getElementById("contentPage").innerHTML = strData;
			if(type=='editPost'){
				$.getScript("script/ckeditor/ckeditor.js", function(){
					CKEDITOR.replace('postArea');
				});
			}
		}
	});
}

function removeEleById(id){
	var stuName = document.getElementById(id);
	if(stuName!=null)
		stuName.parentNode.removeChild(stuName);
}

function confirmLoadAction(arg1, arg2){
	var f = document.getElementsByClassName('inputChecking');
	var allValid = true;
	if(f){
		for(i=0; i<f.length; i++){
			if(!f[i].checkValidity()){
				swal({
				title: "Input empty!",
				text: "You must fill all inputs!",
				type: "error"
				});
				allValid = false;
				break;
			}
		}
	}
	if(allValid){
		swal({
			title: "Are you sure?",
			text: "Your action will be executed!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, confirm it!",
			closeOnConfirm: false },
			function(){
				swal("Success!", "Your action has be executed.", "success");
				loadAction(arg1, arg2);
		});
	}

	/*if (confirm("Are you sure?")){
       loadAction(arg1, arg2);
        return true;
    } else
        return false;*/
}

function confirmCheckResult(arg1, arg2){
	var f = document.getElementsByClassName('ans');
	var allValid = true;
	for(i=0; i<f.length; i++){
		if(!f[i].checkValidity()){		
			allValid = false;
			break;
		}
	}
	if(allValid){
		swal({
			title: "Are you sure?",
			text: "Your data will be uploaded!",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, confirm it!",
			closeOnConfirm: true
		},
			function(){
				checkResult(arg1, arg2);
		});
	} else {
		swal({
			title: "Answer empty!",
			text: "You must fill all answers!",
			type: "error"
		});
	}

	/*if (confirm("Are you sure?")){
        checkResult(arg1, arg2);
        return true;
    } else
        return false;*/
}

function confirmLoadActionEx5(arg1, arg2){
	var f = document.getElementsByClassName('ans');
	var allValid = true;
	for(i=0; i<f.length; i++){
		if(!f[i].checkValidity()){
			swal({
			title: "Answer empty!",
			text: "You must fill all answers!",
			type: "error"
			});
			allValid = false;
			break;
		}
	}
	if(allValid){
		swal({
			title: "Are you sure?",
			text: "Your data will be uploaded!",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, confirm it!",
			closeOnConfirm: false },
			function(){
				swal("Done!", "Your data has been uploaded.", "success");
				loadActionEx5(arg1, arg2);
		});
	}
	
	/*if (confirm("Are you sure?")){
        loadActionEx5(arg1, arg2);
        return true;
    } else
        return false;*/
}

function updateLoginUser(name){
	document.getElementById("login_user").innerHTML = name;
}

function getEmailRegister(){
	emailRegister = document.getElementById("emailRegister");
	if(!emailRegister.checkValidity()){
		swal({
		title: "Email không hợp lệ!",
		text: "Vui lòng nhập lại",
		type: "error"
		});
	}else{
		$.ajax({
	        url: "addEmailRegister.php",
	        type: "POST",
	        data: {"emailContent":emailRegister.value},
	        success: function(strData){
	        	swal("Chúc mừng!", "Bạn đã đăng ký thành công!", "success");
	        }
	    });
	}
}

function change4to6(ex4){
	first = ex4.split("-ex");
	second = first[1];
	ID = second.split(".")[1]
	return first[0]+"-ex6."+ID;
}

function reOrderMyEx(ex6Arr){
	ex6Arr = atob(ex6Arr).split("phure");
	var ex4Arr = document.querySelectorAll('li[id^="exList"][id*="ex4"]');
	for(i=0; i<ex4Arr.length; i++){
		id = ex4Arr[i].getAttribute("id");
		for(j=0; j<ex6Arr.length; j++){
			ex6Ele = ex6Arr[j].split("*/*");
			if(change4to6(id) == ex6Ele[0]){
				document.getElementById(id).insertAdjacentHTML('afterEnd', ex6Ele[1]);
			}
		}
		//check to remove #ex4 anchor
		var nextSibling = ex4Arr[i].nextSibling;
		var previousSibling = ex4Arr[i].previousSibling;
		if((!nextSibling) && (!previousSibling)) {
			ex4Arr[i].parentElement.style.display = "none";
			ex4Arr[i].parentElement.previousSibling.style.display = "none";
		}
	}

}

function CKupdate(){
    for (instance in CKEDITOR.instances)
        CKEDITOR.instances[instance].updateElement();
}

function pagerList(path, cat, cur, total){
	pager = document.getElementById("pager");
	var result = '';
	if(cur>1){
		result += '<li><a href="/'+path+'/'+cat+'/page/1">&#171;</a></li>';
	}
	for(i=2; i>=-2; i--){
		curPage = cur-i;
		if((curPage>0)&&(curPage<=total)){
			if(i==0)
				result += '<li class="pager-current">'+curPage+'</li>';
			else
				result += '<li><a href="/'+path+'/'+cat+'/page/'+curPage+'">'+curPage+'</a></li>';
		}
	}
	if(cur<total){
		result += '<li><a href="/'+path+'/'+cat+'/page/'+total+'">&#187;</a></li>';
	}
	pager.innerHTML = result;
}

$( document ).ready(function() {
	$("form#signinForm").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            $('button[type=button] .default').click();
            $("#submitAction").click();
            return false;
        } else {
            return true;
        }
    });

    $("form#emailRegisterForm").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            getEmailRegister();
            return false;
        } else {
            return true;
        }
    });
});

/*$.scoped();*/

(function() {
var cx = '009212654245659794771:ug3fbb4vpw0';
var gcse = document.createElement('script');
gcse.type = 'text/javascript';
gcse.async = true;
gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
    '//cse.google.com/cse.js?cx=' + cx;
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(gcse, s);
})();