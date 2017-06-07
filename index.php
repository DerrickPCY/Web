<html>
<?php require_once('./includes/global.php');?>
<head>
<body>
<div class="container" style="text-align: center;background-color: #6CADFF;height:198px;width:100%">
	<div class="row">
		<br><br><br>
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4" style="left:50">
			<div style="float:left;">
				<img src="./images/Group.png" style="width: 47px;height: 55px">
			</div>
			<div style="float:left;padding-left:20px">
				<h2 style="color: white;font-family: 'Open Sans';font-weight:bold;">TASK TIMER</h2>
			</div>
		</div>
		<div class="col-sm-4">
		</div>
	</div>
</div>

<div class="container" style="text-align:center;padding-top:70">
	<div class="row">
		<input type="text" id="input" placeholder="Enter Task Name" style="width:680px;height:50px;border-top:none;border-right:none;border-left:none;border-color: #D8D8D8;padding-left:20px;font-size: x-large;margin-right:20;font-family: 'Open Sans'">
		<button id="add" style="background: url('./images/Group 3.png');width:56px;height:60px;background-size:cover;border:none;position:absolute;padding-left:10px"></button>
	</div>
</div>

<div class="container" align='center' id='taskList'>
</div>

<div class="container" align='center' id='finishedList'>
</div>

<div class="container" style="height:49%">
</div>
<footer style="text-align: center;">
	<p style="color:#D9D9D9;">This is a simple tool to track tasks that last for how long, be efficient!</p>
</footer>
</body>

<script>
var working=[];
var numWorking = 0;

$("#add").click(function(){
	if ($('input:text').val()!=''){
		var input = $('input:text').val();
		addTask(input);
		$('input:text').val('');
	}
	else alert("Task name cannot be empty.");
});

function addTask(input){
	working.push([input, 0, numWorking, 0]);//inputText, timeCount, id, isPause
	//box
	var element = document.createElement("div");
	element.style.width = "70%";
	element.style.height = "150px";
	element.style.borderStyle = "groove";
	element.style.margin = "20";
	element.id = "box" + numWorking;
	//left element
	var left = document.createElement("div");
	left.innerHTML = input;
	left.style.float = "left";
	left.style.width = "60%";
	left.style.height = "100%";
	left.style.paddingTop = "53";
	left.style.textAlign = "left";
	left.style.paddingLeft = "20px";
	left.style.fontSize = "24px";
	left.style.fontFamily = "Open Sans";
	left.style.color = "#888888";
	//middle element
	var mid = document.createElement("div");
	mid.style.width = "20%";
	mid.style.height = "100%";
	mid.style.float = "left";
	mid.style.paddingTop = "53";
	mid.innerHTML = "0 sec";
	mid.id = "timerNum" + numWorking;
	mid.style.fontSize = "24px";
	mid.style.fontFamily = "Open Sans";
	mid.style.color = "#D9D9D9";
	//right element
	var right = document.createElement("div");
	right.style.float = "right";
	right.style.width = "20%";
	right.style.height = "100%";
	right.style.paddingTop = "40";
	//pauseButton
	var pauseButton = document.createElement("button");
	pauseButton.style.height = "60px";
	pauseButton.style.width = "56px";
	pauseButton.style.background = "url('./images/Group 5.png')";
	pauseButton.style.backgroundSize = "cover";
	pauseButton.style.border = "none";
	pauseButton.id = "pauseBtn" + numWorking;
	pauseButton.onclick = function(){
		var cur = this.id[this.id.length-1];
		if (working[cur][3]==0){
			working[cur][3] = 1;
		}
		else {
			working[cur][3] = 0;
		}
	}
	//finishButton
	var finishButton = document.createElement("button");
	finishButton.style.height = "60px";
	finishButton.style.width = "56px";
	finishButton.style.background = "url('./images/Group 4.png')";
	finishButton.style.backgroundSize = "cover";
	finishButton.style.border = "none";
	finishButton.style.marginLeft = "10px";
	finishButton.id = "finishBtn" + numWorking;
	finishButton.onclick = function(){
		var cur = this.id[this.id.length-1];
		$("#box"+cur).hide();
		addFinished(cur);
	}

	var taskList = document.getElementById("taskList");
	taskList.appendChild(element);
	element.appendChild(left);
	element.appendChild(mid);
	element.appendChild(right);
	right.appendChild(pauseButton);
	right.appendChild(finishButton);
	numWorking++;
}

function addFinished(index){
	//box
	var element = document.createElement("div");
	element.style.width = "70%";
	element.style.height = "150px";
	element.style.borderStyle = "groove";
	element.style.background = "#F8F8F8";
	element.style.margin = "20";
	element.id = "box" + index;
	//left element
	var left = document.createElement("div");
	left.style.float = "left";
	left.style.width = "60%";
	left.style.height = "100%";
	left.style.paddingTop = "53";
	left.style.textAlign = "left";
	left.style.paddingLeft = "20px";
	left.style.fontSize = "24px";
	left.style.fontFamily = "Open Sans";
	left.style.color = "#888888";
	//middle element
	var mid = document.createElement("div");
	mid.style.width = "20%";
	mid.style.height = "100%";
	mid.style.float = "left";

	//right element


	var right = document.createElement("div");
	right.style.float = "right";
	right.style.width = "20%";
	right.style.height = "100%";
	right.style.paddingTop = "53";
	right.style.fontSize = "24px";
	right.style.fontFamily = "Open Sans";
	right.style.color = "#D9D9D9";
	var min = Math.floor(working[index][1] / 60);
	var sec = working[index][1]%60;
	if (min<=0){
		right.innerHTML = sec + " sec";
	}
	else{
		right.innerHTML = min + " min " + sec + " sec";
	}

	var tick = document.createElement('span');
	tick.setAttribute('class', 'glyphicon glyphicon-ok');
	tick.setAttribute('style', 'margin-right:10;color:#8EF377;font-size:24px');

	var t = document.createTextNode(working[index][0]);

	var taskList = document.getElementById("finishedList");
	taskList.appendChild(element);
	element.appendChild(left);
	element.appendChild(mid);
	element.appendChild(right);
	left.appendChild(tick);
	left.appendChild(t);
	right.appendChild(pauseButton);
	right.appendChild(finishButton);
}


var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
function timer()
{
  for (var i=0;i<numWorking;i++){
  	if (working[i][3]==0){
	  	working[i][1]++;
	  	// if (working[i][1]<=0){
	  	// 	clearInterval(counter);
	  	// 	$("#timerNum"+i).html(working[i][0] + "END");
	  	// 	$("#timerNum"+i).css('background', 'red');
	  	// }
	  	var min = Math.floor(working[i][1] / 60);
	  	var sec = working[i][1]%60;
	  	if (min<=0){
	  		$("#timerNum"+i).html(sec + " sec");
	  	}
	  	else{
			$("#timerNum"+i).html(min + " min " + sec + " sec");
	  	}
	  }
  }
}

</script>



