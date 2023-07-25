<html lang="en">
  <head>
<!-- Required meta tags -->
<!-- ... -->

<!-- Bootstrap CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
  crossorigin="anonymous"
/>
<link rel="stylesheet" href="./style.css"/>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Pusher -->
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>s

<!-- Your custom script -->
<script>
  // Your script code here
</script>

<!-- ... -->


    <title>Pchat</title>
  </head>
  <body>
<div class="chat">
    <div class="top">
            <p>HARI</p>
            <small>online</small>
    </div>

    <div class="messages">
        @include('receive', ['message' => "Hey Whats app"])
    </div>
    <div class="button">
        <form action="">
            <input type="text" id="message" name="message" placeHolder="Enter a message...." autocomplete="off">
            <button type="submit btn btn-primary">send</button>
        </form>
    </div>
</div>
  </body>
  <script>

      const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster:'ap2'});
      const channel = pusher.subscribe('public');

      channel.bind('chat',function(data){
            $.post("receive",{
                _token:'{{csrf_token()}}',
                message:data.message
            }).done(function(res){
                $('.messages > .message').last().after(res);
                $(document).scrolltop($(document).height());
            })
      });

      $('form').submit(function(event){
          event.preventDefault();
          $.ajax({
            url:'/broadcast',
            method: 'POST',
            headers:{
                'X-Socket-Id' :pusher.connection.socket_id
            },
            data:{
                _token:'{{csrf_token()}}',
                message:$('form #message').val(),
            }
          }).done(function(res){
              $('.messages > .message').last().after(res);
              $("form #message").val('');
              $(document).scrollTop($(document).height());
          });
      });
</script>
</html>