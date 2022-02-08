<section class="title">
    <?php if ($this->method === 'create'): ?>
    <strong><?php echo lang('user:add_title') ?></strong>
        <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>

    <?php else: ?>
        <strong><?php echo lang('user:add_title') ?></strong>
        <?php echo form_open_multipart(uri_string(), 'class="crud"') ?>
        <?php //echo form_hidden('row_edit_id', isset($member->row_edit_id) ? $member->row_edit_id : $member->profile_id); ?>
    <?php endif ?>
</section>
<?php //var_dump($groups_select); exit; ?>
<section class="item">
    <div class="content">
        <div class="panel panel-default" style="margin: 10px;">
            <div class="panel-heading">
                Sub Recipient Personalized User's Form
            </div>
            <div class="panel-body div_top_hypers" style="">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab"><?php echo lang('profile_user_basic_data_label') ?></a>
                    </li>
                    <li class=""><a href="#profile" data-toggle="tab"><?php echo lang('user:profile_fields_label') ?></a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active in" id="home">

                        <div class="form_inputs" id="user-basic-data-tab">
                            <fieldset class="col-md-6">
                                <div class="input form-group">
                                    <label for="email"><?php echo lang('global:email') ?> <span>*</span></label>
                                    <?php echo form_input('email', '', 'id="email" class="form-control"') ?>
                                </div>

                                <div class="input form-group">
                                    <label for="username"><?php echo lang('user:username') ?> <span>*</span></label>
                                    <?php echo form_input('username', '', 'id="username" class="form-control"') ?>
                                </div>

                                <div class="input form-group">
                                    <label for="group_id"><?php echo lang('user:group_label') ?></label>
                                    <?php //echo form_dropdown('group_id', array(0 => lang('global:select-pick')) + $groups_select, @$sr->name, 'id="group_id" class="form-control"') ?>
                                    <?php 
                                    if($this->current_user->group_id == 16 || $this->current_user->group_id == 12){
                                        $groups_select = array(5 => 'Facility Administrator');
                                    }else{
                                    $groups_select = array(5 => 'Facility Administrator',4 => 'Linkage Coordinator');
                                    }
                                    echo form_dropdown('group_id', array(0 => lang('global:select-pick')) + $groups_select, '', 'id="group_id" class="form-control"') ?>
                                </div>

                                <!--  <div class="input form-group">
                                      <label for="active"><?php //echo lang('user:activate_label') ?></label>
                                <?php //$options = array(0 => lang('user:do_not_activate'), 1 => lang('user:active'), 2 => lang('user:send_activation_email')) ?>
<?php //echo form_dropdown('active', $options, @$member->active, 'id="active" class="form-control"')  ?>
                                      </div>-->

                                <div class="input form-group">
                                    <label for="password">
                                        <?php echo lang('global:password') ?>
                                    <?php if ($this->method == 'create'): ?> <span>*</span><?php endif ?>
                                    </label>
<?php echo form_password('password', '', 'id="password" autocomplete="off" class="form-control"') ?>
                                </div>

                            </fieldset>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="profile">
                        <div class="form_inputs" id="user-profile-fields-tab">

                            <fieldset class="col-md-6">
                                <div class="input form-group">

                                    <label for="firstname">First Name <span>*</span></label>
                                    <?php echo form_input('firstname', '', 'id="firstname" class="form-control"') ?>
                                    
<?php echo form_hidden('display_name', '', 'id="display_name" class="form-control"') ?>
                                </div>

                                <div class="input form-group">
                                    <label for="lastname">Last Name <span>*</span></label>
<?php echo form_input('lastname', '', 'id="lastname" class="form-control"') ?>
                                </div>

                                <div class="input form-group">
                                    <label for="facility">Facility<span>*</span></label>
                                    <?php //echo form_dropdown('group_id', array(0 => lang('global:select-pick')) + $groups_select, @$sr->name, 'id="group_id" class="form-control"') ?>
<?php echo form_dropdown('facility', array(0 => lang('global:select-pick')) + $facs, '', 'id="facility" class="form-control" onchange="myname(this.value)"') ?>
                                </div>
                                <div class="input form-group">
                                    <label for="mobile">Mobile <span>*</span></label>
<?php echo form_input('mobile', '', 'id="mobile" class="form-control"') ?>
                                </div>
                                
                                 <div class="input form-group">
                                      <label for="gender">Gender <span>*</span></label>
                                <?php $options = array('' => 'Select Gender', 'm' => 'Male' , 'f' => 'Female') ?>
<?php echo form_dropdown('gender', $options, '', 'id="gender" class="form-control"')  ?>
                                      </div>  

<?php if(FALSE): ?>
                                 <div class="input form-group">
                                    <label for="manager">Programme<span>*</span></label>
                                    <?php //echo form_dropdown('group_id', array(0 => lang('global:select-pick')) + $groups_select, @$sr->name, 'id="group_id" class="form-control"') ?>
<?php echo form_dropdown('manager', array(lang('global:select-pick')) + $postmanagerr, '', 'id="manager" class="form-control"') ?>
                                </div>
                                <?php endif; ?>
                                
                                
                                <?php if($postsubtype == 0): ?>
                                
                                 <div class="input form-group">
                                    <label for="sub_recipient">Sub-Recipient<span>*</span></label>
                                    <?php //echo form_dropdown('group_id', array(0 => lang('global:select-pick')) + $groups_select, @$sr->name, 'id="group_id" class="form-control"') ?>
<?php echo form_dropdown('sub_recipient', array(lang('global:select-pick')) + $postsubtypee, '', 'id="sub_recipient" class="form-control"') ?>
                                </div>
                                <?php endif; ?>

                            </fieldset>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="buttons" style="margin-bottom: 20px; margin-left: 20px">
<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))) ?>
        </div>

<?php echo form_close() ?>

    </div>
</section>


<script>
    function myname() {
        var skillsSelect = document.getElementById("facility");
        var selectedText = skillsSelect.options[skillsSelect.selectedIndex].text;
       // alert(selectedText);
        document.getElementById("display_name").value = selectedText;
    }
</script>