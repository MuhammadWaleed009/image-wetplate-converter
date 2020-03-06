<!DOCTYPE html> 
<html> 
<head> 
  <title> 
    Async file upload with jQuery 
  </title> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> 
  </script> 
  <style type="text/css">
    .ajax-loader {
  visibility: hidden;
  background-color: rgba(255,255,255,0.7);
  position: absolute;
  z-index: +100 !important;
  width: 100%;
  height:100%;
}

.ajax-loader img {
  position: relative;
  top:50%;
  left:50%;
}

  </style>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : 'your-app-id',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v6.0'
    });
  };
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
    
  <script>

    function sharefbimage() {
    FB.init({ appId: `your appid`, status: true, cookie: true });
    FB.ui(
    {
        method: `share`,
        name: 'Facebook Dialogs',
        href: $(location).attr('href'),
        link: 'https://developers.facebook.com/docs/dialogs/',
        picture:"uploads/"+$('#file')[0].files[0].name,
        caption: 'Ishelf Book',
        description: 'your description'
    },
    function (response) {
        if (response && response.post_id) {
            alert('success');
        } else {
            alert('error');
        }
    }
);
</script>
</head> 

<body background=""> 
 <div id="fb-root"></div>
  <div align="center">
    <br>
  <h2>Welcome!</h2> 
    <form method="post" action="" enctype="multipart/form-data"
        id="myform"> 
    
    <br>
      <div > 
        <input class="btn btn-info" type="file"  id="file" name="file" /> 
        <input class="btn btn-info" type="button" class="button" value="Upload"
            id="but_upload">
        <a class="btn btn-success" href="" id="download" download>Download Image</a>
       <div id="mImageBox">
        <img id='my_image' src='' alt='' width="auto" height="auto" onclick="sharefbimage()"/>
        </div>
      </div> 
      
      <br>
    </form>
     <div id='loader' style='display: none;'>
      <img src='load.gif' width='200px' height='200px'>
    </div>
    <img onclick="sharefbimage()"  class=" container" id="image" src="">
    <br>
    <br>

    
  </div>   
  
  <script type="text/javascript"> 
    $(document).ready(function() {

            $('#image').hide();
            $('#download').hide();
      $("#but_upload").click(function() { 
        var fd = new FormData();
        
        var files = $('#file')[0].files[0]; 
        fd.append('file', files); 

  
        $.ajax({ 
          url: 'upload.php', 
          type: 'post', 
          data: fd, 
          beforeSend: function(){
            // Show image container
            $('#image').hide();
            $('#download').hide();
    
            $("#loader").show();
            },
          contentType: false, 
          processData: false, 
          success: function(response){ 
            if(response != 0){ 
             document.getElementById("image").src="uploads/"+$('#file')[0].files[0].name;
             document.getElementById("download").href="uploads/"+$('#file')[0].files[0].name;
             //$("#share").attr("data-href","uploads/screenshot1.jpeg");
             $('#share').data('href','uploads/screenshot1.jpeg');
             //$("#share").attr("data-href", "uploads/screenshot1.jpeg");
             $('#image').show();
             $('#download').show();
            } 
            else{ 
              alert('file not uploaded'); 
            } 
          }, 
          complete:function(data){
          // Hide image container
          $("#loader").hide();
         }
        }); 
      }); 
    }); 
  </script> 
</body> 

</html> 

