<!DOCTYPE html>
<html>
    <title>Signup-Signin</title>
    <meta name="viewport" content="width=device-width" initial-scale="1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
.fa {
  padding: 8px;
  font-size: 20px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
}



.fa-facebook {
  background: #3B5998;
  color: white;
}



.fa-google {
  background: #dd4b39;
  color: white;
}

.fa-linkedin {
  background: #007bb5;
  color: white;
}
</style>
    <body>
       
        
            <div class="w3-container  w3-col m6" style="height:60%;">

                <center><div class="w3-card-4 w3-margin" style="width:70%;height:310px;">
                    <header class="w3-container" style="background-color:#007bb5">
                        <h5 class="w3-left-align w3-text-white">Sign Up &nbsp<span style="color:white;font-size:15px;">(for New user)</span></h5>
                    </header>

                    <div class="w3-container" style="background-color:white;">

                        <?php echo form_open('Signup') ?>

                        
						<span class="w3-text-green"><small><?php echo $this->session->flashdata('registration_success'); ?></small></span>
							<span class="w3-text-red"><small><?php echo $this->session->flashdata('registration_failed'); ?></small></span>
                       

                        <div class="w3-margin">
                            <p>
                               
                                <input class="form-control" id="txt_email" name="txt_email" placeholder="Email*" value="<?php echo set_value('txt_email'); ?>" type="email"/>  
                                <?php echo form_error('txt_email','<span class="w3-text-red"><small>','</small></span>'); ?>
                            </p>
                        </div>
                        
                        <div class="w3-margin">
                            
                                <p>
                                   
                                    <input class="form-control" id="txt_password" name="txt_password" placeholder="Password*" type="password" value="<?php echo set_value('txt_password'); ?>"/>  
                                     <?php echo form_error('txt_password','<span class="w3-text-red"><small>','</small></span>'); ?>

                                </p>
                          
                        </div>    

                <div>
                
								  <p><input id="btn_signup" name="btn_signup" style="background-color:#007bb5; color:white;" type="submit" class="w3-bar-item w3-ripple" value="Sign Up" />
                  <span style="margin:15px;">Or</span>
							   <a href="Welcome/Fb_Login" class="fa fa-facebook" style="width:35px; height:35px;"></a></p>
						
						
						</div>								
                        <?php echo form_close(); ?>
                    </div>
                </div></center><!-- card ending-->

            </div><!-- display container ending-->

       <!-- half end-->

        <div class="w3-container w3-col m6" style="height:75%;">



            <center><div class="w3-card-4 w3-margin" style="width:70%;height:325px;">

                <header class="w3-container" style="background-color:#007bb5">
                    <h5 class="w3-left-align w3-text-white">Sign In &nbsp<span style="color:white;font-size:15px;">(for Existing user)</span></h5>
                </header>
                <div class="w3-container" style="background-color:white;">
						
					
                    <?php echo form_open('Signin'); ?>
					<span class="w3-text-green"><small><?php echo $this->session->flashdata('login_success'); ?></small></span>
						<span class="w3-text-red"><small><?php echo $this->session->flashdata('login_failed'); ?></small></span>
						
					 <div class="w3-margin">
					 
                    <p>
                       
                        <input type="text" id="txt_username" class="form-control" name="username" placeholder="Email*" value="<?php echo set_value('username'); ?>"/>  
                        
                    </p>
					<?php echo form_error('username','<span class="w3-text-red"><small>','</small></span>'); ?>
					</div>
					<div class="w3-margin">
                    <p>
                       
                        <input type="password" id="txt_password" class="form-control" name="password" placeholder="Password*"/>   
                       
                    </p>
					<?php echo form_error('password','<span class="w3-text-red"><small>','</small></span>');?>
					</div>
          <div>
					 <p>
  					 <input type="submit" id="btn_login" name="btn_login" style="background-color:#007bb5;color:white;" value="Sign In" class="w3-bar-item w3-ripple"/>
  				  <span style="margin:15px;">Or</span>
  					<a href="Welcome/Fb_Login" class="fa fa-facebook" style="width:35px; height:35px;""></a>
          </p>
					
                    <?php echo form_close(); ?>
					
        
			
				
				
                </div>
            </div></center><!--card closing-->


        </div><!-- half end-->

<div class="w3-container" style="width:100%; margin-bottom:7%;"></div>    
</body>
</html>            







