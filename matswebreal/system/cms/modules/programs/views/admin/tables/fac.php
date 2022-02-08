<?php if (!empty($facs)): ?>
	<table border="0" class="table-list" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th with="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th>Name</th>
				<th class="collapse">Code</th>
				<th class="collapse">Date</th>
				<th width="200">Actions</th>
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
			<?php foreach ($facs as $member): ?>
				<tr>
					<td class="align-center"><?php echo form_checkbox('action_to[]', $member->id) ?></td>
					<td class="collapse"><?php echo ($member->name) ?></td>
                                        <td class="collapse"><?php echo ($member->code) ?></td>
					<td class="collapse"><?php echo format_date($member->date_added)?></td>
					<td class="actions">
						<?php echo anchor('admin/survey/delete/facility' . $member->id, lang('global:delete'), array('class'=>'btn btn-danger confirm button delete')) ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
<?php endif ?>