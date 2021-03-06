<?php
    /* If access tokens are not available redirect to connect page. */
//    if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {      
//        header('Location: ./clearsessions.php');
//    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Rochenry</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

	<!-- Custom CSS -->
	<style type="text/css">
	@import url(http://fonts.googleapis.com/css?family=Ruda:400,700);
	@import url(http://fonts.googleapis.com/css?family=Lemon);
	@import url(http://fonts.googleapis.com/css?family=Lily+Script+One);
	/* Sticky footer styles
	-------------------------------------------------- */
	html {
	  position: relative;
	  min-height: 100%;
	}
	body {
	  /* Margin bottom by footer height */
	  margin-bottom: 60px;
	}
	#footer {
	  position: absolute;
	  bottom: 0;
	  width: 100%;
	  /* Set the fixed height of the footer here */
	  height: 60px;
	  background-color: #f5f5f5;
	}


	/* Custom page CSS
	-------------------------------------------------- */
	/* Not required for template or sticky footer method. */

	body > .container {
	  padding: 60px 15px 0;
	}
	.container .text-muted {
	  margin: 20px 0;
	}
        
    #share-smile {
        width: 50%;
        height: 60%;
        margin: auto;
/*        margin-top: 100px;*/
    }

	#footer > .container {
      padding-right: 15px;
      padding-left: 15px;
	}

	code {
	  font-size: 80%;
	}
	#say-cheese-container{
		margin-top: 23%;
	}		
	</style>

    <!-- JAVASCRIPT -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js" type="text/javascript"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="resources/libs/say-cheese/say-cheese.js" type="text/javascript"></script>

    <script type="text/javascript">
    $(function() {
        var sayCheese = new SayCheese('#say-cheese-container', { snapshots: true });
        sayCheese.on('start', function() {
            $('#action-button').text(' Say cheese . .')
            $('#action-button').fadeIn('fast');
        });                

        $('#action-button').on('click', function(evt) {
            var command = $('#action-button').text();                        
            if(command==" Smile . .")
                sayCheese.start();
            else if(command==" Say cheese . .") {
                sayCheese.takeSnapshot();
            }
        });
        
        sayCheese.on('snapshot', function(snapshot) {            
            var img = document.createElement('img');            
            $(img).on('load', function() {
                $('#say-cheese-snapshot').prepend(img);
            });
            img.src = snapshot.toDataURL('image/png');
                                    
            $.ajax({
                type: 'POST',
                url: 'convertb64.php',
                data: JSON.stringify({ "imageData": img.src }),
                contentType: 'application/json; charset=utf-8',
                success: function () {
                    sayCheese.stop();
                    window.location.href = "index.php";                    
                }
            });                        
        });

        sayCheese.on('error', function(error) {
          var $alert = $('<div>');
          $alert.addClass('alert alert-error').css('margin-top', '20px');

          if (error === 'NOT_SUPPORTED') {
            $alert.html("<strong>:(</strong> your browser doesn't support video yet!");
          } else if (error === 'AUDIO_NOT_SUPPORTED') {
            $alert.html("<strong>:(</strong> your browser doesn't support audio yet!");
          } else {
            $alert.html("<strong>:(</strong> you have to click 'allow' to try me out!");
          }

          $('.say-cheese').prepend($alert);
        });            
      });
    </script>
</head>
<body>

<div class="container">	   
    <div id="share-smile" class="well text-center">        
            <button class="btn btn-success" id="action-button"><i class="fa fa-camera-retro fa-lg"></i> Smile . .</button>
            <div class="img-thumbnail" id="say-cheese-container">
            </div>
            <div id="say-cheese-snapshot"></div>
    </div>
</div>	

<div id="footer">
  <div class="container">
    <p class="text-muted">Place sticky footer content here.</p>
  </div>
</div>

<!-- /Main Content -->

</body>
</html>


