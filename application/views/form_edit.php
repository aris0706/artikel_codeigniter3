<?php $this->load->view('header'); ?>

<header class="masthead" 
        style="background-image: url('<?php echo base_url();?>assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h3>Edit Artikel Baru</h3>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
<h1>Edit Artikel</h1>
    <div class="alert alert-warning">
        <?php echo validation_errors();  ?>
    </div>
<?php echo form_open_multipart();?>
    <div class="form-group">
        <label>Judul</label>
        <?php echo form_input('title', set_value('title',$blog['title']), 'class="form-control"'); ?>
    </div>
       <div class="form-group">
        <label>Url</label>
        <?php echo form_input('url', set_value('url',$blog['url']), 'class="form-control"'); ?>
    </div>
    <div class="form-group">
        <label>Konten</label>
    <textarea name="content" id="" cols="30" rows="10" class="form-control">
        <?php echo $blog['content'];?>
    </textarea>
    </div>
    <div class="form-group">
        <label>Cover</label>
         <?php echo form_upload('cover', set_value('cover',$blog['cover']), 'class="form-control"'); ?>
    </div>

    <button class="btn btn-primary" type="submit">Edit Artikel</button>
</form>
        </div>
    </div>    
</div>
  
    <?php $this->load->view('footer'); ?>
