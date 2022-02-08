<?php if (@$err): ?>
    <div class="error"><?php echo $err; ?></div>
<?php endif; ?>
<?php if (@$er): ?>
    <div class="success"><?php echo $er; ?></div>
<?php endif; ?>
<section class="title">

    <strong>New Local Government Manager</strong>
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
                                <?php echo form_input('email', @$member->email, 'id="email" class="form-control"') ?>
                            </div>

                            <div class="input form-group">
                                <label for="username"><?php echo lang('user:username') ?> <span>*</span></label>
                                <?php echo form_input('username', @$member->username, 'id="username" class="form-control""') ?>
                            </div>

                            <div class="input form-group">
                                <label for="first_name">First Name<span>*</span></label>
                                <?php echo form_input('first_name', @$member->first_name, 'id="first_name" class="form-control"') ?>
                            </div>
                            <div class="input form-group">
                                <label for="last_name">Last Name<span>*</span></label>
                                <?php echo form_input('last_name', @$member->last_name, 'id="last_name" class="form-control"') ?>
                            </div>
                            <div class="input form-group">
                                <label for="phone">Mobile Number<span>*</span></label>
                                <?php echo form_input('phone', @$member->phone, 'id="phone" class="form-control" maxlength=11') ?>
                            </div>
                            <div class="input form-group">
                                <label for="organization">Organization<span>*</span></label>
                                <?php echo form_input('organization', @$member->organization, 'id="organization" class="form-control"') ?>
                            </div>
                            
                            <div class="input form-group">
                                <label for="state">Select State<span>*</span></label>
                                <select name="state" id="state" class="form-control">
                 <option value="" selected="selected" >- Select -</option>
							  <option value='<?php echo trim(@$statename); ?>'><?php echo trim(@$statename); ?></option>
							 
              
							</select>
                            </div>
                            <div class="input form-group">
                                <label for="state">Select LGA<span>*</span></label>
                                <select name="lga" id="lga" class="form-control">
                                    
                                </select>
                            </div>

                            <div class="input form-group">
                                <label for="password">
                                    <?php echo lang('global:password') ?>
                                    <?php if (true): ?> <span>*</span><?php endif ?>
                                </label>
                                <?php echo form_password('password', '', 'id="password" autocomplete="off" class="form-control"') ?>
                            </div>
                            <div class="input form-group">
                                <label for="password">
                                    <?php echo 'Confirm Password' ?>
                                    <?php if (true): ?> <span>*</span><?php endif ?>
                                </label>
                                <?php echo form_password('password2', '', 'id="password2" autocomplete="off" class="form-control"') ?>
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