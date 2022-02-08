<?php 
if (!empty($users)): 
    
    
    ?>
	<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Search Results
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
		<thead>
			<tr>
				<th with="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th><?php echo lang('user:name_label');?></th>
				<th class="">E-mail</th>
				<th><?php echo lang('user:group_label');?></th>
				<th class=""><?php echo lang('user:active') ?></th>
				<th class=""><?php echo lang('user:joined_label');?></th>
				<th class=""><?php echo lang('user:last_visit_label');?></th>
				<?php if($this->current_user->group_id != 9  && $this->current_user->group_id != 16 && $this->current_user->group_id != 12):?>
                                <th width="200">Actions</th>
                                <?php endif; ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="8">
					<div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php $link_profiles = Settings::get('enable_profiles') ?>
			<?php 
                        foreach ($users as $member): 
                            if($this->current_user->group_id == 7 && ($member->group_id == 8 || $member->group_id == 7 || $member->group_id == 1) ){
                                continue;
                            }
                            
                            if(($this->current_user->group_id == 9 || $this->current_user->group_id == 16 && $this->current_user->group_id == 12) && ($member->group_id != 4 && $member->group_id != 2 && $member->group_id != 5) ){
                                continue;
                            }
                            
                            ?>
				<tr>
					<td class="align-center"><?php echo form_checkbox('action_to[]', $member->id) ?></td>
					<td>
					<?php if ($link_profiles) : ?>
						<?php echo anchor('admin/users/preview/' . $member->id, $member->display_name, 'target="_blank" class="modal-large"') ?>
					<?php else: ?>
						<?php echo $member->display_name ?>
					<?php endif ?>
					</td>
					<td class=""><?php echo mailto($member->email) ?></td>
					<td><?php echo $member->group_name ?></td>
					<td class=""><?php echo $member->active ? lang('global:yes') : lang('global:no')  ?></td>
					<td class=""><?php echo format_date($member->created_on) ?></td>
					<td class=""><?php echo ($member->last_login > 0 ? format_date($member->last_login) : lang('user:never_label')) ?></td>
					<?php if($this->current_user->group_id != 9 && $this->current_user->group_id != 16 && $this->current_user->group_id != 12):?>
                                        <td class="actions">
						<?php echo anchor('admin/users/edit/' . $member->id, lang('global:edit'), array('class'=>'btn btn-primary')) ?>
						<?php echo anchor('admin/users/delete/' . $member->id, lang('global:delete'), array('class'=>'btn btn-danger')) ?>
					</td>
                                        <?php endif; ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
            </div>
        </div>
        </div>
<?php else: ?>
<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Search Results
        </div>
    <div class="panel-body" style="font-weight: bold">
        No Available Result
    </div>
</div>
<?php endif ?>