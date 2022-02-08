<?php if (@$err): ?>
    <div class="error"><?php echo $err; ?></div>
<?php endif; ?>
<?php if (@$er): ?>
    <div class="success"><?php echo $er; ?></div>
<?php endif; ?>
<section class="title">

    <strong>Edit Sub Recepient</strong>
    <?php echo form_open_multipart(current_url(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

        <div class="panel panel-default" style="margin: 10px;">

            <div class="panel-body div_top_hypers" style="">
                <!-- Content tab -->
                <div class="tab-pane fade active in" id="home">

                    <div class="form_inputs" id="user-basic-data-tab">
                        <fieldset class="col-md-6">
                            <div class="input form-group">
                                <label for="email"><?php echo lang('global:email') ?> <span>*</span></label>
                                <?php echo form_input('email', $member->email, 'id="email" class="form-control"') ?>
                            </div>

                                <?php echo form_hidden('username', $member->username, 'id="username" class="form-control"') ?>
                            

                            <div class="input form-group">
                                <label for="first_name">First Name<span>*</span></label>
                                <?php echo form_input('first_name', $member->first_name, 'id="first_name" class="form-control"') ?>
                            </div>
                            <div class="input form-group">
                                <label for="last_name">Last Name<span>*</span></label>
                                <?php echo form_input('last_name', $member->last_name, 'id="last_name" class="form-control"') ?>
                            </div>
                            <div class="input form-group">
                                <label for="phone">Mobile Number<span>*</span></label>
                                <?php echo form_input('phonee', $member->mobile, 'id="phonee" class="form-control"') ?>
                            </div>
                            
                            
                            <div class="buttons" style="">
                        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))) ?>
                    </div>
                            
                 <div class="buttons">
                    <label style="padding-top: 25px"></label><?php echo anchor('/admin/programs/fieldadmin', lang('buttons:cancel'), 'class=" btn btn-danger"') ?>
               
                      </div>
                        </fieldset>
                        
                    </div>
                   

                </div>
            </div>
        </div>
    </div>
</div></div>

<?php echo form_close(); ?>

</div>	
</section>