$(document).ready(function() {
    
    $("#send_how_trigger").click(function() {
        $("#send_how").toggle(250);
    });
 
	function hideAll() {
		$(".interface").hide();
	};
	
        $("#blacklist_add_button").tooltip();
	
	//menu handlings
	$("#menu_1").click(function() {
		hideAll();
		$("#send").fadeIn({duration: 250, queue: true});
	});
	$("#menu_2").click(function() {
		hideAll();
		$("#receive").fadeIn({duration: 250, queue: true});
	});
	$("#menu_3").click(function() {
		hideAll();
		$("#bottles").fadeIn({duration: 250, queue: true});
	});
	$("#menu_4").click(function() {
		hideAll();
		$("#settings").fadeIn({duration: 250, queue: true});
	});
	
	
    
});

function activate_response() {
	$("#responses").fadeIn(500);
};

function share() {
    FB.ui(
  {
    method: 'feed',
    name: 'Bluebabble',
    link: 'http://development.bobdesaunois.com/bluebabble/',
//    picture: 'http://fbrell.com/f8.jpg',
    caption: 'Connect with strangers like yourself!',
    description: 'Bluebabble ALPHA is a lightweight tool of communication that is very easy and free to use. Much like you could send a message in a bottle across the sea to some stranger in a faraway land with Bluebabble ALPHA you’ll be able to send a virtual bottle across the sea of technology. Try out Bluebabble ALPHA and connect with strangers today!'
  },
  function(response) {
    if (response && response.post_id) {
      alert('Post was published.');
    } else {
      alert('Post was not published.');
    }
  }
);
}