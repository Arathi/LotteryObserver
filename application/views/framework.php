<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KanmuCutIn | {page_name}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
{cssLibraries}
    <!-- {cssName} -->
    <link rel="stylesheet" href="{cssPath}">
{/cssLibraries}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- REQUIRED JS SCRIPTS -->
{jsLibraries}
    <!-- {jsName} {jsVersion} -->
    <script src="{jsPath}"></script>
{/jsLibraries}
    <div class="wrapper">

      <!-- Main Header -->
      {header}
      <!-- Left side column. contains the logo and sidebar -->
      {sidebar}
      <!-- Content Wrapper. Contains page content -->
      {content}
      <!-- Main Footer -->
      {footer}

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
  </body>
</html>
