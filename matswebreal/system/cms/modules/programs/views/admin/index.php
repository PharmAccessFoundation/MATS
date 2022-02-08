
<section class="title">
    <strong>Programme Details</strong>
</section>

<section class="item">
	<div class="content">
	
		
	
		<?php echo form_open('admin/users/action') ?>
		
			<div id="filter-stage">
				<?php if (!empty($users)): ?>
<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
          
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover " id="">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="">Organization</th>
                            <th>Programme Manager</th>
                            <th class="">Status</th>
                            <th class="">Date Created</th>
                                    <?php 
                                    if($this->current_user->group_id != 9):
                                        ?>
                            <th width="300">Actions</th>
                                 
                                   <?php  endif;   ?>
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
                                    <?php echo $member->name ?>
                                </td><td >
                                    <?php echo $member->company ?>
                                </td>
                                <td class=""><?php echo ($member->display_name) ?></td>
                                <td class=""><?php echo (strtoupper($member->statusp) == 0) ? "<span class='btn btn-danger'>Not Active</span>" : "<span class='btn btn-info'>Active</span>" ?></td>

                                <td class=""><?php echo (@format_date($member->date_added) != 'December 31, 1969') ? format_date(@$member->date_added) : format_date($member->date_added) ?></td>

                                <td class="">
                                    <?php 
                                    if($this->current_user->group_id != 9){
                                    if($member->statusp == 0){
                                    echo anchor('admin/programs/pactivate/' . $member->sid, 'Activate', array('class' => 'btn btn-primary')) ;
                                    }  else{
                                    echo anchor('admin/programs/pdeactivate/' . $member->sid, 'Deactivate', array('class' => 'btn btn-warning')) ;
                                            }?>
                                    <?php
                                    echo anchor('admin/programs/editprog/' . $member->sid, 'Edit', array('class' => 'btn btn-info')) ;
                                    echo ' ';
                                     if($this->current_user->group_id != 7){
                                        echo anchor('admin/programs/deleten/prog/' . $member->sid, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
                                    }
                                    
                                     }
                                    ?>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    <div class="table_action_buttons">
        <div class="btn blue"><strong>Total Count: <?php echo $cusers; ?></strong> </div>
        <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') ))  ?>
        <?php if ($this->current_user->group_id != 6): ?>
           
        <?php endif; ?>
    </div>
    <?php endif
?>

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
