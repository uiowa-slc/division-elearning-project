/*
$('#elearning-course-nav').affix({
	offset: {
		top:  80,
		bottom: 288
	
		bottom: function() {
			console.log($('.footer').outerHeight(true));
			return (this.bottom = $('.footer').outerHeight(true));
		}	
	}
});


console.log("I'm compiled :)");

jQuery('.ecourse-stats').children().each(function() {
	var percent = $(this).data("percent");
	var isCorrect = $(this).data("iscorrect");
	console.log(this);
	if (isCorrect == "correct") {
		barColor = "rgba(223,240,216,1)";
	} else {
		barColor = "rgba(242,222,222,1)";
	}
	//values come from template 
	$(this).css('background', "-moz-linear-gradient(left," + barColor + " 0%, 	" + barColor + " " + percent + "% , rgba(255,255,255,1)" + percent + "%)" );
	$(this).css('background', "-webkit-gradient(linear, left top, right top, color-stop(0%,	" + barColor + "), color-stop(" + percent + "% ," + barColor + "), color-stop(" + percent + "% ,rgba(255,255,255,1)))" );
	$(this).css('background', "-webkit-linear-gradient(left, " + barColor + " 0%,	" + barColor + " " + percent + "% ,rgba(255,255,255,1)" + percent + "%)" );
	$(this).css('background', "-o-linear-gradient(left, " + barColor + " 0%, " + barColor + " " + percent +"% ,rgba(255,255,255,1)" + percent + "%)" );
	$(this).css('background', "-ms-linear-gradient(left, " + barColor + " 0%, " + barColor + " " + percent + "%,rgba(255,255,255,1)" + percent + "%)" );
	$(this).css('background', "linear-gradient(to right, " + barColor + " 0%, " + barColor + " " + percent + "%, rgba(255,255,255,1)" + percent +"%)" );
	$(this).css({
		   'font-size' : '10px',
		   width : '30px',
		   height : '10px',
		   height : '20px'
		});

});

*/