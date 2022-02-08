
<section class="title">
    <strong>Manage State Sub Recipient(s)</strong>
</section>

<section class="item">
	<div class="content">
	
		
	
		<?php echo form_open('admin/users/action') ?>
		
			<div id="filter-stage">
                            <div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading" style="min-height: 40px;">
            <?php if ($this->current_user->group_id == 7): ?>
     <a class="btn blue" href="index.php/admin/survey/tocsv2" strong>Export CSV</strong> </a>
     <?php endif; ?>
          <span style="float: right"><a href="index.php/admin/programs/createstatesrfield" class="btn-primary">New State Sub Recipient</a></span>
        </div>
				<?php if (!empty($users)): ?>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Name</th>
                            <th class="">Email</th>
                            <th>Mobile Number</th>
                            <th class="">State</th>
                            <th class="">Status</th>
                            <th class="">Date Registered</th>
                            <th width="">Actions</th>
                        </tr>
                    </thead>




                   

                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <div class="inner"><?phpc// $this->load->view('admin/partials/pagination') ?></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $link_profiles = Settings::get('enable_profiles') ?>
                        <?php foreach ($users as $member): ?>
                            <tr class="odd gradeX" >
                                            <td class=""><?php echo form_checkbox('one', 1); echo form_hidden('avail', '1')?></td>
                                <td >
                                    <?php echo $member->first_name.' '.$member->last_name ?>
                                </td><td >
                                    <?php echo $member->email ?>
                                </td>
                                <td class=""><?php echo ($member->mobile) ?></td>
                                <td class=""><?php echo ($member->state) ?></td>
                                <td class="" style="text-align: center"><?php echo (strtoupper($member->active) == 0) ? "<span style='padding:5px' class='btn-danger'>Not Active</span>" : "<span style='padding:5px' class='btn-info'>Active</span>" ?></td>

                                <td class=""><?php echo (@format_date($member->created) != 'December 31, 1969') ? format_date(@$member->created) : format_date($member->create) ?></td>

                                <td class="">
                                    <?php 
                                    if($member->active == 0){
                                    echo anchor('admin/programs/fsapprove/' . $member->id, 'Activate', array('class' => 'btn btn-primary')) ;
                                    }  else{
                                    echo anchor('admin/programs/fsdapprove/' . $member->id, 'Deactivate', array('class' => 'btn btn-warning')) ;
                                            }?>
                                    <?php
                                    if($this->current_user->group_id != 9){
                                   // echo anchor('admin/programs/editfield/' . $member->id, 'Edit', array('class' => 'btn btn-info')) ;
                                    }
                                    echo ' ';
                                    // echo anchor('admin/programs/managefield/' . $member->id, 'Manage Account', array('class' => 'btn btn-success')) ;
                                   // echo ' ';
                                     if($this->current_user->group_id == 9){
                                        echo anchor('admin/programs/sdeleteadd/' . $member->id, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div> 
    
    <?php endif
?>
</div>
    <div class="table_action_buttons">
        <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') ))  ?>
        <?php if ($this->current_user->group_id != 6): ?>
           
        <?php endif; ?>
    </div>
<script>
    $(document).ready(function () {
        $('#dataTables-examplee').dataTable( {
  
  "paging": false
} );
    });
</script>
			</div>
		
			
	
		<?php echo form_close() ?>
	</div>
</section>
