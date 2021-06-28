$('.coffee-lists .coffees').mouseover(function(){
	var image = $(this).find('img').attr('src');
	zoomImage(this,image,"coffee");
});
$('.mats img').mouseover(function(){
	var image = $(this).attr('src');
	var name = $(this).attr('data-title');
	zoomImage(this,image,"mat",name);
});

$('.supplies img').mouseover(function(){
	var image = $(this).attr('src');
	var name = $(this).attr('data-title');
	zoomImage(this,image,"supply",name);
});

function zoomImage(el, image, type, text) {
	
	var zoomDiv = document.createElement("div");
	$('.fmb-zoom-div').remove(); //remove it if already there.
	$("body").append(zoomDiv);
	$(zoomDiv).addClass("fmb-zoom-div");
	
	var position = $(el).offset();
	var top = position.top - 380 + 2;
	var left = position.left;
	var htmlText = "";
	
	var leftOffset = 0;
	if (window.scrollY > top) {
		top = top + 180 + $(el).height() - 2;
		left = left + $(el).width() +10;
		leftOffset = 310
	}
	
	if ($(window.document).width() < (left + 380 + 2)) {
		left = left - $(el).width() - 10 - leftOffset;
	}
	
	
	if (type === "coffee") {
		htmlText = "<img src='" + image + "' style=''/>";
	} else if (type === "mat") {
		htmlText = "<span style='display:block;width:280px;height:280px;background-image: url(\"" + image + "\")'  ></span>";
		htmlText += "<span class='caption mat-caption' >" + text + "</span>";
	}else{
		htmlText = "<img src='" + image + "' style='width:350px'/>";
	}
	
	$(zoomDiv).html(htmlText);
	$(zoomDiv).css("position", "absolute");
	$(zoomDiv).css("left", left + "px");
	$(zoomDiv).css("top", top + "px");
	$(zoomDiv).css("z-index", "10000");
	$(zoomDiv).css("margin", "10px");
	
	
	
	$(el).mouseout(function() {
		$(zoomDiv).remove();
	});
	
}

