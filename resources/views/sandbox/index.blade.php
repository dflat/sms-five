<html>
	<head>
		<title>Simple app</title>

		<link href="/css/sandbox.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/fonts/icons/paper.ico"/>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 <link href="/css/simple-sidebar.css" rel="stylesheet">
	</head>

	<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                	<div class='centerList'>
                	<a>
                	<span style:'display:block;' class="glyphicon glyphicon-glass"></span>

                	
                   	</a>
                   </div>
                </li>
                <li>
                    <div class='centerList'>
                	<a>
                	<span style:'display:block;' class="glyphicon glyphicon-pencil"></span>

                   	</a>
                   </div>
                </li>
                <li>
                    <div class='centerList'>
                	<a>
                		<span style:'display:block;' class="glyphicon glyphicon-tr"></span>
                	
                   	</a>
                   </div>
                </li>
                <li>
                   <div class='centerList'>
                	<a>
                	<span style:'display:block;' class="glyphicon glyphicon-piggy-bank"></span>

           
                   	</a>
                   </div>
                </li>
                <li>
                    <div class='centerList'>
                	<a>
                	<span style:'display:block;' class="glyphicon glyphicon-user"></span>

                   	</a>
                   </div>
                </li>
                <li>
                   <div class='centerList'>
                	<a>
                	<span style:'display:block;' class="glyphicon glyphicon-folder-open"></span>

                   	</a>
                   </div>
                </li>
                <li>
                    <div class='centerList'>
                	<a>
                	<span style:'display:block;' class="glyphicon glyphicon-apple"></span>

                   	</a>
                   </div>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <span class="glyphicon glyphicon-tasks menu-toggle"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $(".menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");

    });
    $(".tier2-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper2").toggleClass("toggled");
    });
    </script>

</body>
</div> <!-- end page content wrapper -->
</div> <!-- end master wrapper -->
</html>