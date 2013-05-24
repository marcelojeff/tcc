$(document).ready(function(){
  
	//Trigger Popover with semantic content
	$('.semantic_info').clickover({ 
	    html : true,
	    global_close: true,
	    content: function() {
	      //get content throught AJAX
	      $('#semantic_content').empty();
	      $('#semantic_content').append('<a href="#myModal" class="link test1" id="test1" data-toggle="modal">Mozarela</a>');
	      $('#semantic_content').append('<button data-dismiss="clickover" class="btn">Close</button>');
	      return $('#semantic_content').html();
	    }
	});
	//Put dynamic data onto Modal
	$('.test1').live('click',function(e) {
	    $('.modal-body').empty();
	    $('.modal-body').append("dynamic AJAX information");
	});
	
});	
  
  
  /*$('.semantic_info').click(function(e){
	    e.preventDefault();
	    $('#semantic_content').empty();
	    $('#semantic_content').append("content append");
	    /*$(this).clickover({
	    html : true,
	    /*onShown: function(){
	      $('#semantic_content').empty();
	      $('#semantic_content').append("content append");
	    },*
	    content:function() {
		    return $('#semantic_content').html();
		  }
	  });*
	    $(this).popover({ 
		html : true,
		//trigger: "manual",
		content: function() {
		  return $('#semantic_content').html();
		}
	    });
	});*/
	
	
	
	
	
	
	
	
	
	
	
	/*
	$('html').click(function() {
	    $('.semantic_info').popover('hide');
	});*
	
	var $poped = $('.poped');
	$poped.popover();

	// Trigger for the popover
	$poped.each(function() {
	    var $this = $(this);
	    $this.on('click',function() {
		    var popover = $this.data('popover');
		    var shown = popover && popover.tip().is(':visible');
		    if(shown) return;        // Avoids flashing
		    $this.popover('show');
	    });
	});

	// Trigger for the hiding
	$('html').on('click.popover.data-api',function(e) {
	    if($(e.target).has('.poped').length == 1){
		$poped.popover('hide');
	    } else {
		return false;
	    }
	});*/
    

