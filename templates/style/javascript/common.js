var timer=$('#claim').data('time');
if(timer){
	var btn_text=$('#claim').html();
	var refreshId = setInterval(function(){
		$('#claim').html('Wait '+timer);
		if(timer<=0){
			$('#claim').removeAttr('disabled');
			$('#claim').html(btn_text);
			clearInterval(refreshId);
		}
		timer--;
	},1000);
}





$(function() { 
  var clicks = 0;
  $('.antibotlinks').click(function() { 
    clicks++; 
    $('#antibotlinks').val($('#antibotlinks').val()+' '+$(this).attr('rel')); 
    if(clicks == $('#antibotlinks').data('click') ) { 
      var rand = Math.floor((Math.random() * clicks) + 1); 
      var button = '<div style="margin-top:5px;margin-bottom:5px"><button type="submit" name="with" id="clmbtn" class="btn btn-lg btn-block btn-success">Claim your prize NOW!!</button></div>'; 
      var z=0; 
      $('.antibotlinks').each(function(){ 
        z++; 
        if (z==rand) { 
          $(this).replaceWith(button); 
		  
		  
		  $('html, body').animate({
       		 	scrollTop: $("#clmbtn").offset().top-100
   		  }, 100);
		  
		  
		  
        } 
      }); 
       
    } 
    $(this).hide(); 
    return false; 
  }); 
}); 
