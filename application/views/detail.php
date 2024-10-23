   <!-- Page Header-->
   <?php $this->load->view('header'); ?>
   <?php
   if (empty($blogs['cover'])) {
        $cover = base_url().'assets/img/post-bg.jpg';
   }else{
        $cover = base_url().'uploads/'.$blogs['cover'];
   }
        
    ?>
<header class="masthead" style="background-image: url('<?php echo $cover;?>')"></header>
        <!-- Post Content-->
    <div class="overlay">
        <div class="container">
            <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1><?php echo $blogs['title'];?></h1>
                    <span class="meta">Posted on <?php echo $blogs['date'];?></span>
                </div>
            </div>
            </div>
        </div>
    </div><br>
        <article>
            <div class="container">
                <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                <?php echo nl2br($blogs['content']);?>
                <!-- nl2br utk mnerima baris baru textarea -->
                </div>
                </div>
            </div>
        </article>
        <hr>
        <?php $this->load->view('footer'); ?>
