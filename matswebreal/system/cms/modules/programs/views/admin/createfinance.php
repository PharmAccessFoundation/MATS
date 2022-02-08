<?php if (@$err): ?>
    <div class="error"><?php echo $err; ?></div>
<?php endif; ?>
<?php if (@$er): ?>
    <div class="success"><?php echo $er; ?></div>
<?php endif; ?>
<section class="title">

    <strong>New State Financial Manager</strong>
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
                                <label for="state">Select Zone<span>*</span></label>
                                <select name="zone" id="zone" class="form-control">
							  <option value='1'>North-Central</option>
							  <option value='2'>North-East</option>
							  <option value='3'>North-West</option>
							  <option value='4'>South-East</option>
							  <option value='5'>South-South</option>
							  <option value='6'>South-West</option>
              
							</select>
                            </div>
                            
                            <div class="input form-group">
                                <label for="state">Select State<span>*</span></label>
                                <select name="state" id="state" class="form-control">
                 <option value="" selected="selected" >- Select -</option>
							  <option value='Abia'>Abia</option>
							  <option value='Adamawa'>Adamawa</option>
							  <option value='Akwa Ibom'>Akwa Ibom</option>
							  <option value='Anambra'>Anambra</option>
							  <option value='Bauchi'>Bauchi</option>
							  <option value='Bayelsa'>Bayelsa</option>
							  <option value='Benue'>Benue</option>
							  <option value='Borno'>Borno</option>
							  <option value='Cross River'>Cross River</option>
							  <option value='Delta'>Delta</option>
							  <option value='Ebonyi'>Ebonyi</option>
							  <option value='Edo'>Edo</option>
							  <option value='Ekiti'>Ekiti</option>
							  <option value='Enugu'>Enugu</option>
							  <option value='FCT'>FCT</option>
							  <option value='Gombe'>Gombe</option>
							  <option value='Imo'>Imo</option>
							  <option value='Jigawa'>Jigawa</option>
							  <option value='Kaduna'>Kaduna</option>
							  <option value='Kano'>Kano</option>
							  <option value='Katsina'>Katsina</option>
							  <option value='Kebbi'>Kebbi</option>
							  <option value='Kogi'>Kogi</option>
							  <option value='Kwara'>Kwara</option>
							  <option value='Lagos'>Lagos</option>
							  <option value='Nasarawa'>Nasarawa</option>
							  <option value='Niger'>Niger</option>
							  <option value='Ogun'>Ogun</option>
							  <option value='Ondo'>Ondo</option>
							  <option value='Osun'>Osun</option>
							  <option value='Oyo'>Oyo</option>
							  <option value='Plateau'>Plateau</option>
							  <option value='Rivers'>Rivers</option>
							  <option value='Sokoto'>Sokoto</option>
							  <option value='Taraba'>Taraba</option>
							  <option value='Yobe'>Yobe</option>
							  <option value='Zamfara'>Zamafara</option>
              
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
                                <?php echo form_hidden('gender', 'm', 'id="gender"') ?>
                            </div> 
                            <div class="buttons" style="">
                                <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))) ?>
                            </div>

                            <div class="buttons">
                                <label style="padding-top: 25px"></label><?php echo anchor('/admin/programs/statefinance', lang('buttons:cancel'), 'class=" btn btn-danger"') ?>

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