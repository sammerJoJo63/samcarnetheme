/**

Authors - Austin Rix & Sam Carne

Dynamic layout for dynamic blocks / Masonry Layout


*/
var colCount = 7; // blocks in column 
var colWidth; 
var margin = 30; // spacing between blocks
var windowWidth;
var block;
var padding = 15;
//var blocksOnLoad = 15;
var maxHeight; // maxHeight gets the html height for footer position
var blocks = [];
var paddingTop = 50;
var timers = [];
var intCnt = 1;
var boxInt;
var scrollspace;

//$(window).load(function() { 
	// on load
	
		//if (navigator.platform.toUpperCase().indexOf('WIN')!==-1) {
		//	$(".container").css("margin-left", 15);
		//} else {
		//	$(".container").css("margin-left", 8);
		//}
		//setupBlocks();
	
//}); 

$(document).ready(function () { //doc ready
     //if(checkMobile()){
     //   paddingTop = 15;
     //   $(".container").css("margin-left", 15);
     //}
     
     
	if (navigator.platform.toUpperCase().indexOf('WIN')!==-1) {
		$(".skillssub").css("margin-left", -15);
	} else {
		$(".skillssub").css("margin-left", -8);
	}
         
     setupBlocks(0);
     setupBlocks(1);
     setupBlocks(2);
     setupBlocks(3);
    //$(".footerBtn").click(function(){
    //    blocksOnLoad += 15;
    //    setupBlocks();   
    //});
	
});

$(function(){ // resized window adjust
	$(window).resize(function(){
		var intString = "int" + intCnt;
        intCnt++;
        timers.push(intString);
        setTimeout(function(){
            timers.pop();
            if(timers.length == 0){
		        setupBlocks(0);
				setupBlocks(1);
				setupBlocks(2);
				setupBlocks(3);
		    }  
        },100);
   	});
});

function setupBlocks(boxInt) { // get Demensions 
	windowWidth = $(".sub" + boxInt).width();
	colWidth = $(".sub" + boxInt + " .block").outerWidth();
	blocks = [];
	colCount = Math.floor(windowWidth/(colWidth+margin*2));
	for(var i=0;i<colCount;i++){
		blocks.push(margin);
	}
	positionBlocks(boxInt);
}

function positionBlocks(boxInt) { // set the blocks in place
     maxHeight = 1;
     block = $(".sub" + boxInt + " .block").outerWidth();
     padding = ($(".sub" + boxInt).width() - (colCount*(block + margin)))/2; // padding for center
     var cnt = 1;
		 $(".sub" + boxInt + " .block").each(function(){
	        //if(cnt >= blocksOnLoad){
	        //    $(this).css("display", "none");
	        //} else {
	            $(this).css("display", "block");
	            var min = Array.min(blocks) ;
	            var index = $.inArray(min, blocks);
	            var leftPos = margin+(index*(colWidth+margin));
	            
	            if (navigator.platform.toUpperCase().indexOf('WIN')!==-1) {
					scrollspace = 15;
				} else {
					scrollspace = 8;
				}
	            
	            var down = 20 + min;
	            $(this).css({
	                'left':leftPos+padding-margin+scrollspace+'px',
	                'top':min + paddingTop + 'px'
	            });
	            blocks[index] = min+$(this).outerHeight()+margin;
	
	            var temp =  min+$(this).outerHeight()+margin; 
	            if(temp > maxHeight) 
	                maxHeight= temp;                
	        //}
	        
			//set height of container holding the elements
	        $(".sub" + boxInt).height(maxHeight + 100);
	        cnt++;
	        
	});
   
   //footer code if height of container isn't applied for some reason 
}

function checkMobile(){
    if($(window).width() < 840){        
        return true;
    }
    return false;
}

// Function to get the Min value in Array
Array.min = function(array) {
    return Math.min.apply(Math, array);
};

