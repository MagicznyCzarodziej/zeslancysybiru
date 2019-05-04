<?php include $_SERVER['DOCUMENT_ROOT'].'/top.php'; ?>

<div class="subheader-box">
	<h2>Galeria</h2>
</div>
<div id="content">
	<div id="controls">
		<div id="left" onClick="img(0)"><</div>
		<div id="gallery-title"></div>
		<div id="right" onClick="img(1)">></div>
	</div>
	<div id="preview"><img id="image" /></div>

</div>

<script type="text/javascript">
function getVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}

function img(direction){
	var photoNumber = parseInt(getVariable("photo"));
	var person = getVariable("id");
	var file = "/images/" + person + "/" + (photoNumber+1) + ".jpg";

	if(direction == 0){
		if(photoNumber > 1) window.location.search = jQuery.query.set("photo", photoNumber-1);
	}else if(direction == 1){
		$.ajax({
		    url:file,
		    type:'HEAD',
		    error: function()
		    {
		        //file not exists
		    },
		    success: function()
		    {
		        window.location.search = jQuery.query.set("photo", parseInt(getVariable("photo"))+1);
		    }
		});
	}
}
function setTitle(){
	var person = getVariable("id");
	var title;
	switch(person){
		case '1': title = "Maria Sawka"; break;
		case '2': title = "Zygmunt Załęski"; break;
		case '3': title = "Krystyna Kraczkowska"; break;
		case '4': title = "Maria Jakimiuk"; break;
		case '5': title = "Wanda Isańska"; break;
	}
	document.getElementById("gallery-title").innerHTML=title;
}

function setImg(){
	var image = "/images/" +  getVariable("id") + "/" + getVariable("photo") + ".jpg";
	document.getElementById("image").src=image;
}

function start(){
	var id = getVariable("id");
	var photo = getVariable("photo");
	if(!photo) window.location.search = jQuery.query.set("photo", 1);
	setImg();
	setTitle();
}

window.onload = start;
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>