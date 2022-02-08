
<section class="title">
    <strong>Location Based Administrators</strong>
</section>

<!--<section class="item">
    <div class="content">

        <?php //echo form_open(current_url()) ?>

        <div id="filter-stage">
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <strong>Zonal Administrators</strong>
                        
          <span style="float: right"><a href="index.php/admin/programs/createzonal" class="btn-primary">New Zonal Manager</a></span>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover example" id="example" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Assigned Manager</th>
                                        <th>Organization</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                </tfoot>
                                <tbody>
                                    <?php //$link_profiles = Settings::get('enable_profiles') ?>
                                    <?php //$i=1; foreach ($zones as $zo): ?>
                                        <tr>
                                            <td><?php// echo $i; ?></td>
                                            <td><?php //echo ($zo->name)?></td>
                                            <td><?php //echo ($zo->user_id) ? $zo->display_name : 'Not Assigned' ; ?></td>
                                            <td><?php //echo ($zo->user_id) ? $zo->organization : 'Not Available' ; ?></td>
                                            <td><?php //echo anchor('admin/programs/assignzone/' . $zo->idd, 'Assign Zonal Manager', array('class' => 'btn btn-primary')); ?></td>
                                            
                                        </tr>
                                    <?php //$i++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
        </div>


        <?php// echo form_close() ?>
    </div>
</section>
-->

<section class="item">
    <div class="content">
        <div id="filter-stage">
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <strong>National Administrator</strong>
                        
        <span style="float: right"><a href="index.php/admin/programs/createnational" class="btn-primary">New National Administrator</a></span>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover examplwe" id="examplwe" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Country</th>
                                        <th>Username</th>
                                        <th>Assigned Manager</th>
                                        <th>Organization</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                   
                                </tfoot>
                                <tbody>
                                    <?php $i=1; foreach ($nan as $zo): ?>
                                        <tr> <td><?php echo $i; ?></td>
                                            <td><?php echo 'Nigeria' ?></td>
                                            <td><?php echo ($zo->user_id) ? $zo->username : 'Not Available' ; ?></td>
                                            <td><?php echo ($zo->user_id) ? $zo->display_name : 'Not Available' ; ?></td>
                                            <td><?php echo ($zo->user_id) ? $zo->organization : 'Not Available' ; ?></td>
                                            <td><?php echo anchor('admin/programs/assignnational/', 'Assign National Manager', array('class' => 'btn btn-success')); ?></td>
                                            
                                        </tr>
                                        <?php $i++;    endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div> 
        </div>


        <?php echo form_close() ?>

    </div>
</section>


<section class="item">
    <div class="content">
        <div id="filter-stage">
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <strong>State Administrators</strong>
                        
        <span style="float: right"><a href="index.php/admin/programs/createstate" class="btn-primary">New State Administrator</a></span>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover example" id="example" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Assigned Manager</th>
                                        <th>Organization</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                   
                                </tfoot>
                                <tbody>
                                    <?php $i=1; foreach ($states as $zo): ?>
                                        <tr> <td><?php echo $i; ?></td>
                                            <td><?php echo ($zo->name)?></td>
                                            <td><?php echo ($zo->user_id) ? $zo->display_name : 'Not Assigned' ; ?></td>
                                            <td><?php echo ($zo->user_id) ? $zo->organization : 'Not Available' ; ?></td>
                                            <td><?php echo anchor('admin/programs/assignstate/' . $zo->idd, 'Assign State Manager', array('class' => 'btn btn-success')); ?></td>
                                            
                                        </tr>
                                        <?php $i++;    endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div> 
        </div>


        <?php echo form_close() ?>

    </div>
</section>


<script>
    $(document).ready(function () {
        $('#example').dataTable({
            "iDisplayLength": 10;
        });
    });
</script>