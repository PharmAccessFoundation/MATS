<?php if (!empty($users)): ?>
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
				<th>Name</th>
				<th class="">Mobile</th>
				<th>Hub Facility</th>
				<th class="">Email</th>
				<th class="">Registered Date</th>
				<th width="300">Actions</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="8">
					<div class="inner"><?php //$this->load->view('admin/partials/pagination') ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php $link_profiles = Settings::get('enable_profiles') ?>
			<?php foreach ($users as $member): ?>
				<tr>
					<td class="align-center"><?php echo form_checkbox('action_to[]', $member->sid) ?></td>
					<td>
						<?php str_replace('.', "", $member->fullname); ?>
					</td>
					<td class=""><?php echo ($member->phone) ?></td>
                                        <td class=""><?php echo ($member->name) ?></td>
					
                                        <td class=""><?php echo $member->lemail ?></td>
                                        <td class=""><?php echo $member->reg_date ?></td>
					<td class="actions">
                                            
                                                <?php 
                                                if($this->current_user->group_id != 16 && $this->current_user->group_id != 12 && $this->current_user->group_id != 13 && $this->current_user->group_id != 18){
                                                echo ($member->facility_id == 8) ? "<a href='admin/survey/assign/$member->sid' class = 'btn btn-info' >Assign Facility</a>" :"";
						 echo anchor('admin/survey/mydata/' . $member->sid, 'View Screened Data', array('class'=>'btn btn-success'));
                                                echo anchor('admin/survey/deleten/users/' . $member->sid, lang('global:delete'), array('class'=>'btn btn-danger confirm button delete')); 
                                                
                                                }
                                                 ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
            </div></div></div>
<?php endif ?>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable({
            "iDisplayLength": 10;
        });
    });
</script>