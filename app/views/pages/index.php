<?php require_once APPROOT."/views/inc/header.php";?>
<h1>Welcom In Index Page The Params IS  <?php  echo $data['title']; ?> </h1>

<?php if(!is_null($data['posts'])): ?>

<?php foreach($data['posts'] as $post): ?>
    <p> <?php echo $post->title; ?></p>
<? endforeach; endif;?>

<?php require_once APPROOT."/views/inc/footer.php"; ?>