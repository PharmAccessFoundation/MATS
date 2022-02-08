<section class="title">
    <strong><?php echo $module_details['name'] ?></strong>
    <?php
    if($this->current_user->group_id != 7 && $this->current_user->group_id != 9):
        ?>
    <span style="float: right"><a href="index.php/admin/groups/add" class="btn">Add New Group</a></span>
    <?php endif; ?>
</section>

<section class="item">
	<div class="content">
		<?php if ($groups): ?>
			<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Available Groups
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
		<thead>
					<tr>
						<th width="40%"><?php echo lang('groups:name');?></th>
						<th><?php echo lang('groups:short_name');?></th>
						<th width="300"></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="3">
							<div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
				<?php foreach ($groups as $group):
                                    if($group->id == 1 || $group->id == 8){
                                        continue;
                                    }
                                    ?>
					<tr>
						<td><?php echo $group->description ?></td>
						<td><?php echo $group->name ?></td>
						<td class="actions">
						<?php echo anchor('admin/groups/edit/'.$group->id, lang('buttons:edit'), 'class="btn btn-success"') ?>
						<?php
                                                if($this->current_user->group_id != 7 && $this->current_user->group_id != 9):
                                                if ( ! in_array($group->name, array('user', 'admin'))): ?>
							<?php echo anchor('admin/groups/delete/'.$group->id, lang('buttons:delete'), 'class="btn btn-danger"') ?>
						<?php endif ?>
						<?php echo anchor('admin/permissions/group/'.$group->id, lang('permissions:edit').' &rarr;', 'class="btn btn-primary"') ?>
                                                    <?php endif ?>
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
            </div></div></div>
		
		<?php else: ?>
			<section class="title">
				<p><?php echo lang('groups:no_groups');?></p>
			</section>
		<?php endif;?>
	</div>
</section>