$(document).ready(function(){
  
	$('a').tooltip();
	
	$(".semantic_info").click(function() {
	    el = $(this);
	    $.get('/flavors/getAbstract', {resource: el.data('resource')}, function(response) {
	    	var $content = response[0].abst.value;
	    	$content += '<p><a href="#myModal" id="languages" data-name="'+el.data('original-title')+'" data-resource="'+el.data('resource')+'" data-toggle="modal">Outros idiomas</a></p>';
	    	//$content += '<button data-dismiss="clickover" class="btn">Close</button>';
	    	el.unbind('click').clickover({
	    		global_close: true,
	    		content: $content,
		        //title: 'Dynamic response!',
		        html: true,
		        placement: 'bottom',
	        
	        //delay: {show: 500, hide: 100}
	      }).clickover('show');
	    }, 'json');
	  });

	/*/Trigger Popover with semantic content
	$('.semantic_info').bind('click', function(event){
		obj = this;
		$.get('/flavors/getAbstract', {resource: $(obj).data('resource')}, function(data){
    		//console.log(data[0].abst.value);
    		var text = data[0].abst.value;
    		$(obj).unbind('click');

    		$(obj).clickover({ 
    		    html : true,
    		    placement: 'bottom',
    		    global_close: true,
    		    content: function() {
    		    	 $('#semantic_content').empty();
    		  	     $('#semantic_content').append(text);
    		  	     $('#semantic_content').append('<p><a href="#myModal" class="link test1" id="test1" data-toggle="modal">Outros idiomas</a></p>');
    		  	      //clickover.resetPosition();
    		  	      //$('#semantic_content').append('<button data-dismiss="clickover" class="btn">Close</button>');
    		  	     return $('#semantic_content').html();
    		    	}
    		    	
    		    });
    		
  	      
    	});
	});
	/*$('.semantic_info').clickover({ 
	    html : true,
	    placement: 'bottom',
	    global_close: true,
	    content: function() {
	    	 //var clickover = this;
	      //get content throught AJAX
	    	$.get('/flavors/getAbstract', {resource: $(this).data('resource')}, function(data){
	    		//console.log(data[0].abst.value);
	    		var text = data[0].abst.value;
	    		$('#semantic_content').empty();
	  	      $('#semantic_content').append(text);
	  	      $('#semantic_content').append('<p><a href="#myModal" class="link test1" id="test1" data-toggle="modal">Outros idiomas</a></p>');
	  	      //clickover.resetPosition();
	  	      //$('#semantic_content').append('<button data-dismiss="clickover" class="btn">Close</button>');
	  	      
	    	});
	    	return $('#semantic_content').html();
	    }
	    
	 	/*onShown: function(){
	        //save the clickover to call later...
	        var clickover = this;
	        //console.log(clickover.options.resource);
	        $.get('/flavors/getAbstract?resource='+clickover.options.resource, function(data){
	    		
	    		var text = data[0].abst.value;
	    		console.log(text);
	    		$('#semantic_content').empty();
	  	      	$('#semantic_content').html(text);
		  	    $('#semantic_content').append('<p><a href="#myModal" class="link test1" id="test1" data-toggle="modal">Outros idiomas</a></p>');
		  	    clickover.resetPosition();
	        });
	        clickover.resetPosition();
	 	}*
	});*/
	//Put dynamic data onto Modal
	//TODO tentar live pro clickover
	$('#languages').live('click',function(e) {
	    $('.modal-body').empty();
	    $('#modal-label').empty();
	    obj = $(this);
	    $('#modal-label').append(obj.data('name'));
	    $.get('/flavors/getOtherLanguages', {resource: obj.data('resource')}, function(response) {
	 		$.each(response, function(index, language){
	 			//console.log(language);
	 			
	 			$('.modal-body').append(language.iso.value + " - ");
	 			$('.modal-body').append(language.name.value);
	 			$('.modal-body').append(' | <a class="listen" href="#" data-q="'+language.name.value+'" data-tl="'+language.iso.value+'" data-name="'+obj.data('resource')+'">Ouvir</a><br/>');
	 		});
	 		listHandle();	    	
	    }, 'json');
	});

	function listHandle(){
		$('.listen').click(function(event){
			event.preventDefault();
			//console.log('blaaaaa');
			$("#player").empty();
			$url = $(this).attr("href");
			$.get('/flavors/getAudio', {name:$(this).data('name'), q:$(this).data('q'), tl:$(this).data('tl')}, function(data){
				if(data.exists){
					$("#player").append('<object type="application/x-shockwave-flash" data="/flash/dewplayer.swf" width="1" height="0" id="dewplayer" name="dewplayer"> \
					<param name="movie" value="/flash/dewplayer.swf" /> \
					<param name="flashvars" value="mp3='+data.file+'&autostart=1" /> \
					<param name="wmode" value="transparent" /> \
					</object>');
				} else {
					alert('Audio indisponivel!');
				}
				
			}, "json");
	    });	
	}
	
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
    

