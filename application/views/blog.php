<?php $this->load->view('header');  ?>
        <!-- Page Header-->
        <header class="masthead" 
        style="background-image: url('<?php echo base_url();?>assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h3>Artikel Blog</h3>
                            <span class="subheading">Aris Yunanto</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php echo $this->session->flashdata('message'); ?>
                    <form>
                        <input type="text" name="find">
                        <button type="submit">Cari</button>
                    </form><br>
                    <?php foreach ($blogs as $key => $blog):?>
                    <div class="post-preview">
                        <a href="<?php echo site_url('blog/detail/'.$blog['url']);?>">
                            <span class="post-title">
                                <?php echo $blog['title'];?>
                            </span>
                        </a>
                        <p class="post-meta">Posted On<?php echo $blog['date'];?>
                    <!-- validasi -->
                    <?php if(isset($_SESSION['username']))
                    {
                    ?>
                        <a href="<?php echo site_url('blog/edit/'.$blog['id']);?>"> Edit</a>
                        <a href="<?php echo site_url('blog/delete/'.$blog['id']);?>"
                        onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')">
                        Delete</a>
                    <?php
                    }
                    ?> 
                        </p>
                        <p><?php echo nl2br($blog['content'])?></p>
                    </div>
                    <hr class="my-4" />
                    <?php endforeach;?>
                    
                <nav aria-label="Page navigation">
                    <?php echo $this->pagination->create_links(); ?>
               </nav>
                    <!-- Pager-->
                </div>
            </div>
        </div>
        <?php $this->load->view('footer');  ?>   