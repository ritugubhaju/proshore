
		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">

						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">

					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<img src="{{asset('assets/images/kclogo.png')}}" >
								<span class="profile-info">
									Test

								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li>
									<a href="{{url('/logout')}}">
										<i class="md md-settings-power text-danger"></i>
										Logout
                           			 </a>
                        		</li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-profile -->

				</div><!--end #header-navbar-collapse -->
			</div>
		</header>
		<!-- END HEADER-->

