
<section class="title">
    <strong>Manage Sub Recepient(s)</strong>
</section>

<section class="item">
	<div class="content">
	
		
	
		<?php echo form_open('admin/users/action') ?>
		
			<div id="filter-stage">
                            <div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
            <?php if ($this->current_user->group_id == 7): ?>
     <a class="btn blue" href="index.php/admin/survey/tocsv2" strong>Export CSV</strong> </a>
     <?php endif; ?>
          <span style="float: right"><a href="index.php/admin/programs/createsubrep" class="btn-primary">New Sub Recepient</a></span>
        </div>
				<?php if (!empty($users)): ?>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="">Email</th>
                            <th>Mobile Number</th>
                            <th class="">Status</th>
                            <th class="">Date Registered</th>
                            <th width="">Actions</th>
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
                        <?php foreach ($users as $member): ?>
                            <tr class="odd gradeX" >
                                <td >
                                    <?php echo $member->name.' '.$member->last_name ?>
                                </td><td >
                                    <?php echo $member->email ?>
                                </td>
                                <td class=""><?php echo ($member->mobile) ?></td>
                                <td class="" style="text-align: center"><?php echo (strtoupper($member->status) == 0) ? "<span style='padding:5px' class='btn-danger'>Not Active</span>" : "<span style='padding:5px' class='btn-info'>Active</span>" ?></td>

                                <td class=""><?php echo (@format_date($member->created) != 'December 31, 1969') ? format_date(@$member->created) : format_date($member->create) ?></td>

                                <td class="">
                                    <?php 
                                    if($member->status == 0){
                                    echo anchor('admin/programs/sapprove/' . $member->id, 'Activate', array('class' => 'btn btn-primary')) ;
                                    }  else{
                                    echo anchor('admin/programs/sdapprove/' . $member->id, 'Deactivate', array('class' => 'btn btn-warning')) ;
                                            }?>
                                    <?php
                                    echo anchor('admin/programs/editsubrep/' . $member->id, 'Edit', array('class' => 'btn btn-info')) ;
                                    echo ' ';
                                     echo anchor('admin/programs/managesubrep/' . $member->id, 'Manage Account', array('class' => 'btn btn-success')) ;
                                    echo ' ';
                                     if($this->current_user->group_id == 7){
                                        echo anchor('admin/programs/deletesr/' . $member->id, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
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
        <div class="btn blue"><strong>Total Count: <?php echo $cusers; ?></strong> </div>
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
