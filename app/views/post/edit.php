<?php require_once APPROOT."/views/inc/header.php";?>
            <a href="<?php echo URLROOT;?>/posts" class="btn btn-light"><i class="fa fa-backward"></i>Back</a>
                 <div class="card card-body bg-light mt-5">
                 <?php flash('resgister_success');?>
                     <h2>Edit a Post </h2>
                     <p>Edit A Post With the Form </p>
                     <form action="<?php echo URLROOT;?>/post/edit/<?php echo $data['id'];?>" method="post">
                      
                        <div class="form-group">
                            <label for="title">Title:<sup>*</sup></label>
                            <input type="title" name="title" value="<?php echo  $data['title'];?>" class="form-control form-control-lg
                            <?php echo( !empty($data['title_err'])) ? 'is-invalid':'' ;?>">
                            <span class="invalid-feedback"><?php echo $data['title_err'];?></span>
                        </div>
                        <div class="form-group">
                            <label for="body">Body:<sup>*</sup></label>
                            <textarea name="body" value="<?php echo  $data['body'];?>" class="form-control form-control-lg
                            <?php echo( !empty($data['body_err'])) ? 'is-invalid':'' ;?>"></textarea>
                            <span class="invalid-feedback"><?php echo $data['body_err'];?></span>
                        </div>
                        
                        <input type="submit" value="Submit" class="btn btn-primary">
                     </form>
                 </div>

<?php require_once APPROOT."/views/inc/footer.php";?>