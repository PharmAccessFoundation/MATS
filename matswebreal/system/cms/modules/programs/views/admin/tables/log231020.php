<?php if (!empty($users)): ?>
<div class="panel panel-default" style="margin: 10px;">
        
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-examplee" id="dataTables-example">
		<thead>
			<tr>
				
                                        <th>Select</th>
				<th>Spoke</th>
				<th class="">Mobile</th>
				<th>Hub Facility</th>
				<th class="">Email</th>
				<th class="">Date Registered</th>
				<th width="400">Actions</th>
			</tr>
		</thead>
		<tfoot>
			
		</tfoot>
		<tbody>
			<?php $link_profiles = Settings::get('enable_profiles') ?>
			<?php foreach ($users as $member): ?>
				<tr>
                                            <td class=""><?php echo form_checkbox('one', 1); echo form_hidden('avail', '1')?></td>
					
					<td>
						<?php echo str_replace(".","",$member->fullname) ?>
					</td>
					<td class=""><?php echo ($member->phonee) ?></td>
                                        <td class=""><?php echo ($member->namee) ?></td>
					
                                        <td class=""><?php echo $member->lemail ?></td>
                                        <td class=""><?php echo $member->reg_date ?></td>
					<td class="actions">
                                                <?php 
                                                if($this->current_user->group_id != 10){
                                                    echo ($member->statusi == 0) ? anchor('admin/programs/uapprove/'.$member->sid, 'Activate', array('class'=>'btn btn-primary', 'onClick' => "return confirm('Are you sure about this action?')") ) : anchor('admin/programs/udapprove/'.$member->sid, 'Deactivate', array('class'=>'btn btn-warning', 'onClick' => "return confirm('Are you sure about this action?')") );
                                                }  
                                                ?>
						<?php echo anchor('admin/programs/mydata/' . $member->sid, 'View Screened Data', array('class'=>'btn btn-success', 'onClick' => "return confirm('Are you sure about this action?')")) ?>
						
                                            <?php echo anchor('admin/programs/reassign/'.$member->sid, 'Re-Assign', array('class'=>'btn btn-info', 'onClick' => "return confirm('Are you sure about this action?')") ); ?>
					<?php //echo anchor('admin/programs/deleten/logusers/' . $member->sid, lang('global:delete'), array('class'=>'btn btn-danger')) ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
            </div></div></div>

<?php else: ?>

<div class="panel panel-default" style="margin: 10px;">
        
    <div class="panel-body">
        <strong>No Assigned Users For This Account</strong>
    </div>
    </div>

<?php endif ?>


<script>
      
    $(document).ready(function () {
        $('.dataTables-examplee').dataTable({
            paging: true,
            dom: 'Bfrtip',
            buttons: [
               'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 1, "asc" ]],
        });
    });
</script>