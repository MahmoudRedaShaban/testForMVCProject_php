<?php require_once APPROOT."/views/inc/header.php";?>
<?php flash('post_message'); ?>
<div class="row">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-rigth"><i class="fa fa-pencil"></i>
            Add Post
        </a>
    </div>
</div>
<?php foreach($data['posts'] as $post): ?>

<div class="card card-body mb-3">
    <div class="card-title"><?php echo $post->title;?></div>
    <div class="bg-ligth p-2 mb-3">
        Written by <?php echo $post->name?> on <?php echo $post->postCreated; ?>
    </div>
    <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId;?>" class="btn btn-dark">More</a>

</div>

<?php require_once APPROOT."/views/inc/footer.php";?>