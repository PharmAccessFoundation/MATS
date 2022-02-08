<?php if (!empty($users)): ?>
<div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
           Screening Results
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="">Company</th>
                            <th>Manager</th>
                            <th class="">Status</th>
                            <th class="">Date Created</th>
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
                        <?php foreach ($users as $member): ?>
                            <tr class="odd gradeX" >
                                <td >
                                    <?php echo $member->name ?>
                                </td><td >
                                    <?php echo $member->company ?>
                                </td>
                                <td class=""><?php echo ($member->display_name) ?></td>
                                <td class=""><?php echo (strtoupper($member->statusp) == 0) ? 'Not Active' : 'Active' ?></td>

                                <td class=""><?php echo (@format_date($member->date_added) != 'December 31, 1969') ? format_date(@$member->date_added) : format_date($member->date_added) ?></td>

                                <td class="">
                                    <?php 
                                    if($member->statusp == 0){
                                    echo anchor('admin/programs/pactivate/' . $member->sid, 'Activate', array('class' => 'btn btn-primary')) ;
                                    }  else{
                                    echo anchor('admin/programs/pdeactivate/' . $member->sid, 'Deactivate', array('class' => 'btn btn-warning')) ;
                                            }?>
                                    <?php
                                        echo anchor('admin/programs/deletep/' . $member->sid, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
                                   // }
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
        <?php if ($this->current_user->group_id == 7): ?>
            <a class="btn blue" href="admin/survey/tocsv/<?php echo ''; ?>" style="float: right"><strong>Export CSV</strong> </a>
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