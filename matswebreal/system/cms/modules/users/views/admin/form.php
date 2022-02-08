<section class="title">
    <?php if ($this->method === 'create'): ?>
    <strong><?php echo lang('user:add_title') ?></strong>
        <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>

    <?php else: ?>
        <strong><?php echo sprintf(lang('user:edit_title'), $member->username) ?></strong>
        <?php echo form_open_multipart(uri_string(), 'class="crud"') ?>
        <?php echo form_hidden('row_edit_id', isset($member->row_edit_id) ? $member->row_edit_id : $member->profile_id); ?>
    <?php endif ?>
</section>

<section class="item">
    <div class="content">
<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
            Personalized User's Form
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
                                    <?php echo form_input('email', $member->email, 'id="email" class="form-control"') ?>
                                </div>

                             <div class="input form-group">
                                <label for="username"><?php echo lang('user:username') ?> <span>*</span></label>
                                    <?php echo form_input('username', $member->username, 'id="username" class="form-control"') ?>
                                </div>

                             <div class="input form-group">
                                <label for="group_id"><?php echo lang('user:group_label') ?></label>
                                    <?php echo form_dropdown('group_id', array(0 => lang('global:select-pick')) + $groups_select, $member->group_id, 'id="group_id" class="form-control"') ?>
                                </div>

                            <div class="input form-group">
                                <label for="active"><?php echo lang('user:activate_label') ?></label>
                                    <?php $options = array(0 => lang('user:do_not_activate'), 1 => lang('user:active'), 2 => lang('user:send_activation_email')) ?>
                                    <?php echo form_dropdown('active', $options, $member->active, 'id="active" class="form-control"') ?>
                                </div>
                           
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
                                <label for="display_name"><?php echo lang('profile_display_name') ?> <span>*</span></label>
                                    <?php echo form_input('display_name', $display_name, 'id="display_name" class="form-control"') ?>
                                </div>

                            <?php foreach ($profile_fields as $field): ?>
                                <div class="input form-group">
                                    <label for="<?php echo $field['field_slug'] ?>">
                                        <?php echo (lang($field['field_name'])) ? lang($field['field_name']) : $field['field_name']; ?>
                                        <?php if ($field['required']) { ?> <span>*</span><?php } ?>
                                    </label>
                                        <?php echo $field['input'] ?>
                                    </div>
                            <?php endforeach; ?>
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


