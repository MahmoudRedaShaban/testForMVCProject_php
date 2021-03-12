<?php require_once APPROOT."/views/inc/header.php";?>

         <div class="row">
             <col-md-6 class="col-md-6 mx-auto">
                 <div class="card card-body bg-light mt-5">
                 <?php flash('resgister_success');?>
                     <h2>Login </h2>
                     <p>Please fill in Your Credentials to log in </p>
                     <form action="<?php echo URLROOT;?>/users/login" method="post">
                      
                        <div class="form-group">
                            <label for="email">Email:<sup>*</sup></label>
                            <input type="email" name="email" value="<?php echo  $data['email'];?>" class="form-control form-control-lg
                            <?php echo( !empty($data['email_err'])) ? 'is-invalid':'' ;?>">
                            <span class="invalid-feedback"><?php echo $data['email_err'];?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:<sup>*</sup></label>
                            <input type="password" name="password" value="<?php echo  $data['password'];?>" class="form-control form-control-lg
                            <?php echo( !empty($data['password_err'])) ? 'is-invalid':'' ;?>">
                            <span class="invalid-feedback"><?php echo $data['password_err'];?></span>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Login" class="btn btn-success  btn-block">
                            </div>
                            <div class="col">
                                <a href="<?php echo URLROOT;?>/users/register" class="btn btn-light btn-block">No acount?  Register</a>
                            </div>
                        </div>
                     </form>
                 </div>
             </col-md-6>
         </div>


<?php require_once APPROOT."/views/inc/footer.php";?>