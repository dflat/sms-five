
<div class="logo-container">
	<img src="{{asset('images/501Logo.png')}}" class="logo-501">
	<img src="{{asset('images/services.png')}}" class="logo-services">
</div>

<div id="header-info-container">
	<h4 id="org-name">{{$organization->name}}</h4>
	<h4>
		<small>
			{{ date('F d, Y', strtotime($sale_date)) }}
		</small>
	</h4>
	<p>
		<small>
			{{$organization->address}}
		</small>
	</p>
	<p>
		<small>
			{{$organization->license}}
		</small>
	</p>
</div>
<hr>
	
