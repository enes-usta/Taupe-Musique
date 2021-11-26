update();

$().ready(addEvents());

function addEvents() {
	$('[data-toggle="tooltip"]').tooltip(); 

	var fullHearts = document.getElementsByClassName("fullHeart");
	for(var i=0;i<fullHearts.length;i++){
		fullHearts[i].style.animation = "heart-explode 0s steps(28) forwards";
	}

	var hearts = document.getElementsByClassName("heart");
	for(var i=0;i<hearts.length;i++){
		hearts[i].addEventListener('click', setAnimationState, false);
	}
}

function setAnimationState () {
	var style, actionFav;
	if (stringStartsWith(this.style.animation, "heart-explode")) { // already fav
		style = "";
		actionFav = "unfav";
	}  else {
		style = "heart-explode 1s steps(28) forwards";
		actionFav = "fav";
	}

	this.style.webkitAnimation=style;
	this.style.mozAnimation   =style;
	this.style.msAnimation    =style;
	this.style.oAnimation     =style;
	this.style.animation      =style;

/*	$.ajax({
		method: "POST",
		url: "EnregFav.php",
		data: {id_produit: this.getAttribute("data-recipe")}
	})*/

}

function stringStartsWith (string, prefix) {
	return string.slice(0, prefix.length) == prefix;
}