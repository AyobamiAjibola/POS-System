 <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                </div>
                <div class="collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav navbar-left">
					<?php if($userType == 1){?>
					 <li>
                            <a href="setting">
                                <i class="fa fa-cog"></i>
								<p class="hidden-lg hidden-md">Settings</p>
                            </a>
                     </li>
					<?php }?>
						<li>
							<a href="profile">
                                <i class="fa fa-user"></i>
								<p style="display:inline-block"><?php echo $display_name; ?></p>
                            </a>
						</li>
					</ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li>
                           <a href="account">
                               <p>Profile</p>
                            </a>
                        </li>-->
						
                       <li>
                           <a href="logout">
                               <p>Logout</p>
                            </a>
                        </li>
                       
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>
