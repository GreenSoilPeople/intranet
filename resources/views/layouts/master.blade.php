
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="icon" href="../../favicon.ico"> --}}
    <link rel="icon" href="../../favicon-32x32.png">

    <title>Intranet</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/docs.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    @yield('head')

  </head>


  <body>
    @include('layouts/nav')

    <div class="container-fluid">
      <div class="row">

      @yield('body')
      
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <!-- Latest compiled and minified JavaScript -->
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
    <script src="/js/extrajq.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>

    <script>

    

      function SetCaretAtEnd(elem) {
          var elemLen = elem.value.length;
          // For IE Only
          if (document.selection) {
              // Set focus
              elem.focus();
              // Use IE Ranges
              var oSel = document.selection.createRange();
              // Reset position to 0 & then set at end
              oSel.moveStart('character', -elemLen);
              oSel.moveStart('character', elemLen);
              oSel.moveEnd('character', 0);
              oSel.select();
          }
          else if (elem.selectionStart || elem.selectionStart == '0') {
              // Firefox/Chrome
              elem.selectionStart = elemLen;
              elem.selectionEnd = elemLen;
              elem.focus();
          } // if
      } // SetCaretAtEnd()

        $('[autofocus]').moveToEnd();

    
    </script>
   

    @yield('script')

  </body>
</html>
