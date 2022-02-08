<section class="title">
	<strong><?php echo $group->description ?></strong>
</section>
<section class="item">
	<div class="content">
		<?php echo form_open(uri_string(), array('class'=> 'crud', 'id'=>'edit-permissions')) ?>
			<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Permission Administrator Edit
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
		<thead>
				<tr>
					<th><?php echo form_checkbox(array('id'=>'check-all', 'name' => 'action_to_all', 'class' => 'check-all', 'title' => lang('permissions:checkbox_tooltip_action_to_all'))) ?></th>
					<th width='200'><?php echo lang('permissions:module') ?></th>
					<th><?php echo lang('permissions:roles') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($permission_modules as $module): ?>
				<tr>
					<td style="width: 30px">
						<?php echo form_checkbox(array(
							'id'=> $module['slug'],
							'class' => 'select-row',
							'value' => true,
							'name'=>'modules['.$module['slug'].']',
							'checked'=> array_key_exists($module['slug'], $edit_permissions),
							'title' => sprintf(lang('permissions:checkbox_tooltip_give_access_to_module'), $module['name']),
						)) ?>
					</td>
					<td>
                                            <div><label class="" style="display: inline-block; font-weight: normal" for="<?php echo $module['slug'] ?>"></label><?php echo $module['name'] ?></div>
					</td>
					<td>
					<?php if ( ! empty($module['roles'])): ?>
						<?php foreach ($module['roles'] as $role): ?>
                                            <div style=" font-weight: normal; display: inline-block; padding-right: 10px; ">
							<?php echo form_checkbox(array(
								'class' => 'select-rule',
								'name' => 'module_roles['.$module['slug'].']['.$role.']',
								'value' => true,
								'checked' => isset($edit_permissions[$module['slug']]) AND array_key_exists($role, (array) $edit_permissions[$module['slug']])
							)) ?>
                                                <span style=" display: inline-block; font-weight:bold; padding-right: 0px;"><?php echo lang($module['slug'].':role_'.$role) ?></span>
						</div>
						<?php endforeach ?>
					<?php endif ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
            </div></div></div>
            <div class="buttons float-right padding-top " style="padding-bottom: 20px; padding-left: 20px; ">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))) ?>
		</div>
		<?php echo form_close() ?>
	</div>
</section>