<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Incosure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/public/docs/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="/public/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://cdn.alternativeto.net/i/5df41994-40a1-e111-9456-0025902c7e73_17823.png">
     <!--<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/public/docs/assets/ico/apple-touch-icon-144-precomposed.png">-->
     <!--<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/public/docs/assets/ico/apple-touch-icon-114-precomposed.png">-->
    <!--<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/public/docs/assets/ico/apple-touch-icon-72-precomposed.png">-->
    <!--<link rel="apple-touch-icon-precomposed" href="/public/docs/assets/ico/apple-touch-icon-57-precomposed.png">-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">inclosure.info</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="/">Home</a></li>
              <li><a href="javascript:;" id="about">About</a></li>
              <li><a href="javascript:;" id="contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
       
        </div>
      </div>
    </div>

    <div class="container">
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/docs/assets/js/jquery.js"></script>
    <script src="/public/docs/assets/js/bootstrap-transition.js"></script>
    <script src="/public/docs/assets/js/bootstrap-alert.js"></script>
    <script src="/public/docs/assets/js/bootstrap-modal.js"></script>
    <script src="/public/docs/assets/js/bootstrap-dropdown.js"></script>
    <script src="/public/docs/assets/js/bootstrap-scrollspy.js"></script>
    <script src="/public/docs/assets/js/bootstrap-tab.js"></script>
    <script src="/public/docs/assets/js/bootstrap-tooltip.js"></script>
    <script src="/public/docs/assets/js/bootstrap-popover.js"></script>
    <script src="/public/docs/assets/js/bootstrap-button.js"></script>
    <script src="/public/docs/assets/js/bootstrap-collapse.js"></script>
    <script src="/public/docs/assets/js/bootstrap-carousel.js"></script>
    <script src="/public/docs/assets/js/bootstrap-typeahead.js"></script>

    <script type="text/javascript">
      $('#about').popover({
        title: 'About',
        content: '...about inclosure.info',
        placement: 'bottom',
        trigger: 'hover',
        animation: true
      });
      $('#contact').popover({
        title: 'Contact',
        content: '...contact inclosure.info',
        placement: 'bottom',
        trigger: 'hover',
        animation: true
      });
    </script>


  </body>
</html>
