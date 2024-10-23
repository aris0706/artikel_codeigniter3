<?php $this->load->view('header'); ?>

<header class="masthead" 
        style="background-image: url('<?php echo base_url();?>assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Login</h1>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <h2>Login</h2>
        <?php echo $this->session->flashdata('message');?>
        <?php echo form_open();?>
                <div class="form-group">
                    <label>Username</label>
                        <?php echo form_input('username', set_value('username'), 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <?php echo form_password('password', set_value('password'), 'class="form-control"'); ?>
                </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
        </div>
    </div>    
</div>
  
    <?php $this->load->view('footer'); ?>