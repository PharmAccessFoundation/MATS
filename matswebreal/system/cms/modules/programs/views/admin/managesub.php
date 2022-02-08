
<section class="title">
    <strong>Sub-Recipients</strong>
</section>

<section class="item">
    <div class="content">

        <?php echo form_open('admin/users/action') ?>

        <div id="filter-stage">
            <?php if (!empty($users)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <?php if (false): ?>
                            <a class="btn blue" href="admin/survey/tocsv/<?php echo $excf; ?>" ><strong>Export CSV</strong> </a>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover exampleo" id="exampleo">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Programme Name</th>
                                        <th class="">Sub Recipient</th>
                                        <th>SR Code</th>
                                        <th class="">State</th>
                                        <th class="">Phone</th>
                                        <th class="">Email</th>
                                        <th class="">Manager</th>
                                        <th class="">Status</th>
                                        <th width="250">Actions</th>
                                    </tr>
                                </thead>






                                <tfoot>
                                    <tr>
                                        <td colspan="9">
                                            <div class="inner"><?php $this->load->view('admin/partials/pagination')  ?></div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $link_profiles = Settings::get('enable_profiles') ?>
                                    <?php $c=0; foreach ($users as $member):
                                        ?>
                                        <tr class="odd gradeX" >
                                           <td class=""><?php echo (++$c); ?></td>
                                             <td class=""><?php echo ($member->pgname) ?></td>
                                            <td class=""><?php echo ($member->srname) ?></td>
                                            <td class=""><?php echo ($member->code) ?></td>
                                            <td class=""><?php echo ($member->pstate) ?></td>
                                            <td class=""><?php echo ($member->srphone) ?></td>
                                            <td class=""><?php echo ($member->sremail) ?></td>
                                            <td class=""><?php echo anchor('admin/programs/previewme/'.$member->user_id, ($member->display_name))  ?></td>
                                            <td class=""><?php echo ($member->active == 1) ? '<span style="background-color: #31b0d5; padding: 7px; color:white">Active</span>': '<span style="background-color: red; padding: 7px; color:white">Not Active</span>' ?></td>

                                            <td class="">
                                                <?php echo anchor('admin/programs/subassign/' . $member->user_id, 'Re-Assign', array('class' => 'btn btn-success')) ?>
                                                <?php 
                                                echo ' ';
                                                if($member->active == 1){
                                                    echo anchor('admin/programs/subdisable/' . $member->user_id, 'Disable SR Manager', array('class' => 'btn btn-danger'));
                                                } else{
                                                    
                                                echo anchor('admin/programs/subenable/' . $member->user_id, 'Enable SR Manager', array('class' => 'btn btn-success'));
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
                    <div class="btn blue"> </div>
                    <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') ))  ?>
<?php if (FALSE): ?>
                     <!--   <a class="btn blue" href="# <?php // echo 'index.php/admin/survey/tocsv/'.$excf; ?>" style="float: right"><strong>Export CSV</strong> </a>-->
                        
                    <?php endif; ?>
                </div>
            
            <?php endif
            ?>

            <script>
                $(document).ready(function () {
        $('#exampleo').dataTable( {
  

} );
    });

            </script>
        </div>



        <?php echo form_close() ?>
    </div>
</section>
