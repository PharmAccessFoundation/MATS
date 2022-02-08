
<section class="title">
    <strong>LGA Administration</strong>
</section>




<section class="item">
    <div class="content">
        <div id="filter-stage">
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <strong>LGA Administrators</strong>
                        
          <span style="float: right"><a href="index.php/admin/survey/createlga" class="btn-primary">New LGA Manager</a></span>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover example" id="example" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>State</th>
                                        <th>LGA</th>
                                        <th>Organization</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                   
                                </tfoot>
                                <tbody>
                                    <?php $i=1; foreach ($users as $zo): ?>
                                        <tr> <td><?php echo $i; ?></td>
                                            <td><?php echo ($zo->first_name.' '.$zo->last_name)?></td>
                                            <td><?php echo ($zo->username)?></td>
                                            <td><?php echo ($zo->user_id) ? $zo->mobile : 'Not Assigned' ; ?></td>
                                            <td><?php echo  $zo->state; ?></td>
                                            <td><?php echo  $zo->lname; ?></td>
                                            <td><?php echo ($zo->user_id) ? $zo->organization : 'Not Available' ; ?></td>
                                            <td><?php //echo anchor('admin/survey/assignlga/' . $zo->idd, 'Assign LGA Manager', array('class' => 'btn btn-success')); ?></td>
                                            
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