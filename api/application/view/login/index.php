    <div class="container">
      <form class="form-signin" action="javascript:;">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level" placeholder="Email address" id="username">
        <input type="password" class="input-block-level" placeholder="Password" id="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me" id="remember"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit" id="loginsubmit">Sign in</button>
      </form>
    </div> <!-- /container -->
    <script type="text/javascript">
    $("#loginsubmit").click(function() {
        $.ajax({
          url: "/login/dologin/",
          type: 'POST',
          data: 'username='+$("#username").val()+'&password='+$("#password").val()+"&remember="+$("#remember").is(':checked')
        }).done(function(response) { 
          if (response == "good") window.location = "/home"
        });      
    });
    </script>