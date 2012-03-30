$( document ).ready( function(){
	$('.blink')
		.focus(function(){
			if ( $(this).attr('value') == $(this).attr('title') ) {
				$(this).attr({ 'value': '' })
			}
		})
		.blur(function(){
			if ( $(this).attr('value') == '' ) {
				$(this).attr({ 'value': $(this).attr('title') })
			}
		})
		
  // Homepage Slider Code
	$("#controller").jFlow({
		slides: "#slider",
		controller: ".jFlowControl", // must be class, use . sign
		slideWrapper : "#slides", // must be id, use # sign
		selectedWrapper: "jFlowSelected",  // just pure text, no sign
		width: "580px",
		height: "350px",
		duration: 400,
		prev: ".jFlowPrev", // must be class, use . sign
		next: ".jFlowNext" // must be class, use . sign
	});
	
		
});