<section class="title">
	<?php echo $module_details['name'] ?>
</section>
<section class="item">
	<div class="content">
		<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Permission List
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
		<thead>
				<tr>
					<th><?php echo lang('permissions:group') ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($groups as $group): ?>
				<tr>
					<td><?php echo $group->description ?></td>
					<td class="buttons actions">
						<?php if ($admin_group != $group->name):?>
						<?php echo anchor('admin/permissions/group/' . $group->id, lang('permissions:edit'), array('class'=>'btn btn-success')) ?>
						<?php else: ?>
						<?php echo lang('permissions:admin_has_all_permissions') ?>
						<?php endif ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
            </div>
        </div>
                </div>
	</div>
</section>