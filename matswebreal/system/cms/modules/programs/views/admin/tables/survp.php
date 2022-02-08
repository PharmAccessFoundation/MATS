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
                            <th class="">Mobile</th>
                            <th>Hub Facility</th>
                            <th class="">Respondent</th>
                            <!--<th class="">Status</th>-->
                            <th class="">Date</th>
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
                                    <?php echo $member->firstname ?>
                                </td>
                                <td class=""><?php echo ($member->mobile) ?></td>
                                <td class=""><?php echo ($member->name) ?></td>
                                <td><?php
                                    if ($member->respondent == 1)
                                        echo 'Self';
                                    if ($member->respondent == 2)
                                        echo 'Dependent Adult';
                                    if ($member->respondent == 3)
                                        echo 'Child (Below 6 Years)';
                                    if ($member->respondent == 4)
                                        echo 'Child (6 - 15 Years)';
                                    ?></td>
                               <!-- <td class=""><?php //echo (strtoupper($member->status) == 'YES') ? 'Positive' : 'Negative'  ?></td>-->

                                <td class=""><?php echo (@format_date($member->date_screened) != 'December 31, 1969') ? format_date(@$member->date_screened) : format_date($member->date_uploaded) ?></td>

                                <td class="">
                                    <?php echo anchor('admin/programs/viewm/' . $member->sid, 'View More', array('class' => 'btn btn-success')) ?>
                                    <?php
                                    if ($this->current_user->group_id == 1 || $this->current_user->group_id == 44 || $this->current_user->group_id == 3) {
                                        echo anchor('admin/survey/deleten/pat/' . $member->sid, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
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
        <?php if ($this->current_user->group_id == 7): ?>
            <a class="btn blue" href="admin/survey/tocsv/<?php echo $excf; ?>" style="float: right"><strong>Export CSV</strong> </a>
        <?php endif; ?>
    </div>
<?php endif
?>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable({
            "paging": false;
            "iDisplayLength": 10;
        });
         $('#example').dataTable({
            "iDisplayLength": 10;
        });
    });

</script>