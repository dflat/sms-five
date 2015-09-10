<html>
	<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>501 SMS</title>

  
  <!-- Fonts -->
 
  <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans|Questrial|Quicksand|Oswald|Armata|Roboto:400,900' rel='stylesheet' type='text/css'> -->
  
   <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
  <script src="/js/angular.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/fonts/icons/favicon.ico"/>
   <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
 <!--  // <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
   <!-- <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script> -->
   <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->
  

  <link href="/css/navi.css" rel="stylesheet">

  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="/css/sandbox.css" rel="stylesheet" media="print,screen">
  <script type="text/javascript" src="/js/navi.js"></script>


  @yield('imports')
    
	</head>

<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><strong>501</strong></a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/') }}">Home</a></li>
          

            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tickets<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('tickets/create') }}">Add New</a></li>
                <li><a href="{{ url('tickets') }}">View All</a></li>
              </ul>
            </li> -->

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Organizations<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('organizations/create') }}">Add New</a></li>
                <li><a href="{{ url('organizations') }}">View All</a></li>
              </ul>
            </li>

        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">Login</a></li>
            <li><a href="{{ url('/auth/register') }}">Register</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

<div id="pgcontainer">
  
    <!-- <div id="navbar"> -->

    <a href="#" class="menubtn glyphicon glyphicon-menu-hamburger hidden-print"></a>
    <!-- use captain icon for toggle menu -->
    <div id="hamburgerbun">
      <div id="hamburgermenu">
        <ul class="list-group">
          <li id="dashboard-button" class="list-group-item">
            <a href="#"><!-- class="glyphicon glyphicon-dashboard"> -->
              <img src="{{asset('images/icons/user-info-large.png')}}" class="icon-test">
              <span class="nav-text">DASHBOARD</span>
            </a>
          </li>
          <li id="paper-button" class="list-group-item">
            <a href="#"> <!-- class="glyphicon glyphicon-th"> -->
              <img src="{{asset('images/icons/paper-large.png')}}" class="icon-test">
               <span class="nav-text">PAPER</span>
            </a>
          </li>
          <li id="pulltab-button" class="list-group-item">
            <a href="#"> <!-- class="glyphicon glyphicon-erase"> -->
              <img src="{{asset('images/icons/pulltabs-large.png')}}" class="icon-test">
              <span class="nav-text">PULLTABS</span>
            </a>
          </li>
          <li id="machines-button" class="list-group-item">
            <a href="#"> <!-- class="glyphicon glyphicon-hdd"> -->
              <img src="{{asset('images/icons/machines-large.png')}}" class="icon-test">
              <span class="nav-text">MACHINES</span>
            </a>
          </li>
          <li id="reports-button" class="list-group-item">
            <a href="#"><!--  class="glyphicon glyphicon-duplicate"> -->
              <img src="{{asset('images/icons/acct-info-large.png')}}" class="icon-test">
              <span class="nav-text">REPORTS</span>
            </a>
          </li>
          <li id="logout-button" class="list-group-item">
            <a href="{{ url('/auth/logout') }}" class="glyphicon glyphicon-off">
              <span class="nav-text">LOGOUT</span>
            </a>
          </li>
        </ul>
      </div>

      <div id="pulltab-button-menu" class="second-tier-menu hidden-list">
        <ul class="list-group">
          <li class="list-group-item">
            <a href="{{route('invoice.tickets.index')}}" 
               class="glyphicon glyphicon-tags">
              <span class="nav-text">INVOICES</span>
            </a>
          </li>
          <li class="list-group-item">
            <a href="{{ url('inventory') }}" class="glyphicon glyphicon-download-alt">
              <span class="nav-text">MANAGE INVENTORY</span>
            </a>
          </li>
          <li class="list-group-item">
            <a href="{{ url('invoice/tickets/inspect') }}" class="glyphicon glyphicon-search">
              <span class="nav-text">INSPECT SALES</span>
            </a>
          </li>
          <li class="list-group-item">
            <a href="{{ url('invoice/tickets/metrics') }}" class="glyphicon glyphicon-scale">
              <span class="nav-text">METRICS</span>
            </a>
          </li>
        </ul>
      </div>

      <div id="paper-button-menu" class="second-tier-menu hidden-list">
        <ul class="list-group">
          <li class="list-group-item">
             <a href="{{route('invoice.paper.index')}}" 
               class="glyphicon glyphicon-tags">
              <span class="nav-text">INVOICES</span>
            </a>
          </li>
          <li class="list-group-item">
            <a href="{{ url('PaperInventory') }}" class="glyphicon glyphicon-download-alt">
              <span class="nav-text">MANAGE INVENTORY</span>
            </a>
          </li>
          <li class="list-group-item">
           <a href="{{ url('invoice/paper/inspect') }}" class="glyphicon glyphicon-search">
              <span class="nav-text">INSPECT SALES</span>
            </a>
          </li>
        </ul>
      </div>

      <div id="machines-button-menu" class="second-tier-menu hidden-list">
        <ul class="list-group">

          <li class="list-group-item">
             <a href="{{route('invoice.machines.index')}}" 
               class="glyphicon glyphicon-tags">
              <span class="nav-text">INVOICES</span>
            </a>
          </li>
          
        </ul>
      </div>

      <div id="reports-button-menu" class="second-tier-menu hidden-list">
        <ul class="list-group">
          <li class="list-group-item">
             <a href="{{url('reports/tickets/state')}}" 
               class="glyphicon glyphicon-erase">
              <span class="nav-text">State Report: Instant Bingo</span>
            </a>
          </li>
          <li class="list-group-item">
            <a href="{{ url('PaperInventory') }}" class="glyphicon glyphicon-th">
              <span class="nav-text">State Report: Paper</span>
            </a>
          </li>
          <li class="list-group-item">
           <a href="{{ url('invoice/paper/inspect') }}" class="glyphicon glyphicon-hdd">
              <span class="nav-text">State Report: Electronics</span>
            </a>
          </li>
        </ul>
      </div>

    </div>
    <!-- </div> -->
    <div class="overlay"></div>
  
  <div id="content">
  @yield('content')
  </div>
</div><!-- @end #pgcontainer -->

</body>

</html>