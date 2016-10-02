    <nav class="navbar navbar-default" role="navigation">
  	  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a href="index.php"><div class="navbar-brand navbar-brand-centered">City Marks</div></a>
		    </div>

		    
		    <div class="collapse navbar-collapse" id="navbar-brand-centered">
  		      <ul class="nav navbar-nav">
  		        <li><a href="#">Mens</a></li>
  		        <li><a href="#">Womens</a></li>
  		        <li><a href="#">Accessories</a></li>
  		      </ul>
		      <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<span class="caret"></span></a>
              <?php if(isset($_SESSION['role'])): ?>
              <ul id="login-dp" class="dropdown-menu">
                <li>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="text-center">
                          <div class="btn-group">
                            <a href="#" class="btn btn-primary btn-account">Manage Account</a>
                          </div>
                        </div>
                      </div>
                      <div class="bottom text-center">
                        <a href="includes/logout.php"><b>Log Out</b></a>
                      </div>
                    </div>
                </li>
              </ul>
              <?php else: ?>
              <ul id="login-dp" class="dropdown-menu">
                <li>
                   <div class="row">
                      <div class="col-md-12">
                        Login via
                        <div class="social-buttons">
                          <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                          <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                        </div>
                                        or
                         <form class="form" role="form" method="post" action="includes/login.php" accept-charset="UTF-8" id="login-nav">
                            <div class="form-group">
                               <label class="sr-only" for="Email">Email address</label>
                               <input type="email" class="form-control" name="email" id="Email" placeholder="Email address" required>
                            </div>
                            <div class="form-group">
                               <label class="sr-only" for="Password">Password</label>
                               <input type="password" class="form-control" name="password" id="Password" placeholder="Password" required>
                                                     <div class="help-block text-right"><a href="">Forgot your password?</a></div>
                            </div>
                            <div class="form-group">
                               <button type="submit" class="btn btn-primary btn-block" name="login">Sign in</button>
                            </div>
                            <div class="checkbox">
                               <label>
                               <input type="checkbox"> keep me logged-in
                               </label>
                            </div>
                         </form>
                      </div>
                      <div class="bottom text-center">
                        New here ? <a href="registration.php"><b>Join Us</b></a>
                      </div>
                   </div>
                </li>
              </ul>
              <?php endif; ?>
            </li>
		        
            <!--Shopping Cart-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> 0 - Items<span class="caret"></span></a>
              <ul class="dropdown-menu dropdown-cart" role="menu">
                  <li>
                      <span class="item">
                        <span class="item-left">
                            <img src="http://lorempixel.com/50/50/" alt="" />
                            <span class="item-info">
                                <span>Item name</span>
                                <span>$00</span>
                            </span>
                        </span>
                        <span class="item-right">
                            <button class="btn btn-xs btn-danger pull-right">x</button>
                        </span>
                    </span>
                  </li>
                  <li>
                      <span class="item">
                        <span class="item-left">
                            <img src="http://lorempixel.com/50/50/" alt="" />
                            <span class="item-info">
                                <span>Item name</span>
                                <span>$00</span>
                            </span>
                        </span>
                        <span class="item-right">
                            <button class="btn btn-xs btn-danger pull-right">x</button>
                        </span>
                    </span>
                  </li>
                  <li>
                      <span class="item">
                        <span class="item-left">
                            <img src="http://lorempixel.com/50/50/" alt="" />
                            <span class="item-info">
                                <span>Item name</span>
                                <span>$00</span>
                            </span>
                        </span>
                        <span class="item-right">
                            <button class="btn btn-xs btn-danger pull-right">x</button>
                        </span>
                    </span>
                  </li>
                  <li>
                      <span class="item">
                        <span class="item-left">
                            <img src="http://lorempixel.com/50/50/" alt="" />
                            <span class="item-info">
                                <span>Item name</span>
                                <span>$00</span>
                            </span>
                        </span>
                        <span class="item-right">
                            <button class="btn btn-xs btn-danger pull-right">x</button>
                        </span>
                    </span>
                  </li>
                  <li class="divider"></li>
                  <li><a class="text-center" href="">View Cart</a></li>
              </ul>
            </li>

		      </ul>
          
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>