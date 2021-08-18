<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Option Indexes
	</a>
	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		<a class='dropdown-item' href="/index/3" >Ford Transit - Ambulance  </a>
		<a class='dropdown-item' href="/index/16" >Ram ProMaster - Ambulance  </a>
		<a class='dropdown-item' href="/index/4" >Ford TC - Mobility  </a>
		<a class='dropdown-item' href="/index/10" >Test Platform  </a>
		<a class='dropdown-item' href="/index/11" >Ford Transit - Mobility  </a>
		<a class='dropdown-item' href="/index/12" >Ram ProMaster - Mobility  </a>
		<a class='dropdown-item' href="/index/14" >Grand Caravan - Mobility  </a>
		
		<div class="dropdown-divider"></div>
		
		<a class='dropdown-item' href="/basevan" >Platform Indexes  </a>
		@if (Auth::user()->show_question_tree)
			<a class='dropdown-item' href="/questions" >Question Tree  </a>
		@endif
		<div class="dropdown-divider"></div>
		<a class='dropdown-item' href="/preferences" >Preferences  </a>
	
	</div>
</li>