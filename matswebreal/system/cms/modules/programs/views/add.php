<script type="text/javascript">
    $(document).ready(function() {
        $("#formWizard").formToWizard({submitButton: 'submitForm'})
    });
</script>
<script>

    $(function() {

        $('#uniqueSelect').multiselect();

        $('#multipleSelect').multiselect({
            buttonText: function(options, select) {
                if (options.length == 0) {
                    return 'None selected <b class="caret"></b>';
                }
                else if (options.length > 1) {
                    return options.length + ' selected <b class="caret"></b>';
                }
                else {
                    var selected = '';
                    options.each(function() {
                        selected += $(this).text() + ', ';
                    });
                    return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
                }
            },
        });

        $('#start').datepicker({
            format: 'dd/mm/yyyy'
        });

        $('#end').datepicker({
            format: 'dd/mm/yyyy'
        });

        $('#hexColorPicker').colorpicker();

        $('#rgbColorPicker').colorpicker({
            format: 'rgb'
        });

        $("#fileselectbutton").click(function(e) {
            $("#inputFile").trigger("click");
        });

        $("#inputFile").change(function(e) {
            var val = $(this).val();
            var file = val.split(/[\\/]/);
            $("#filename").val(file[file.length - 1]);
        });

    })
</script>

<ul class="breadcrumb">
    <li><i class="icon-home"></i><a href=""> Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
    <li><i class="icon-dashboard"></i><a href="index.php/users/dashboard"> Dashboard</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
    <li><i class="icon-list"></i><a href="index.php/convergy/view"> View Assets</a> <span class="divider"><i class="icon-angle-right"></i></span></li>


    <li class="active">Asset Booking</li>
    <li class="moveDown pull-right">
        <span class="time"></span>
        <span class="date"></span>
    </li>
</ul>

<!-- ==================== MASTER ACTIONS ROW ==================== -->
<div class="row-fluid" >


    <!-- ==================== TABLE HEADLINE ==================== -->
    <div class="containerHeadline tableHeadline">
        <i class="icon-list"></i><h2>Manage Asset Bookings</h2>
        <!-- ==================== END OF TABLE CONTROLS ==================== -->
    </div>
    <!-- ==================== END OF TABLE HEADLINE ==================== -->
    <div>
        <div class="container-fluid">
            <?php if (validation_errors()): ?>
                <div class="alert alert-error">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif ?>

            <?php echo form_open('convergy/add', array('enctype' => 'multipart/form-data', 'id' => 'formWizard', 'class' => 'form-horizontal', 'data-validate' => 'parsley')) ?>

            <fieldset>
                <legend>Book Period</legend>
                <div class="control-group">
                    <label class="control-label" for="face">Side</label>
                    <div class="controls">
                       <!-- <input id="face" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="face">-->
                        <?php 
                        echo form_dropdown('face',$side,$sel,'id = "face"');
                                ?>

                    </div>
                </div>
                <?php if($no == 'show'): ?>
                <div class="control-group">
                    <label class="control-label" for="campaign">Campaign</label>
                    <div class="controls">
                       <!-- <input id="face" class="span10 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="face">-->
                        <?php 
                        echo form_dropdown('campaign',$campaign, '', 'id = "campaign"') 
                         ?>

                    </div>
                </div>
<?php endif; ?>
                <div class="control-group">
                    <label class="control-label" for="start" id>Start Period *</label>
                    <div class="controls">
                        <input id="start" class="span3 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="start">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="end">End Period *</label>
                    <div class="controls">
                        <input id="end" class="span3 parsley-validated" type="text" data-minlength="1"  data-required="true" data-trigger="change" data-validation-minlength="0" name="end">
                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                        <input type="hidden" name="enid" value="<?php echo $enid ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <?php echo form_submit('submitForm', 'Book Period') ?>
                </div>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- ==================== TABLE FLOATING BOX ==================== -->
    <!-- ==================== BORDERED TABLE HEADLINE ==================== -->
    
    <?php if ($show == 'yes'): ?>
        <div class="containerHeadline">
            <i class="icon-table"></i><h2>CAMPAIGNS</h2>
        </div>
        <!-- ==================== END OF BORDERED TABLE HEADLINE ==================== -->

        <!-- ==================== BORDERED TABLE FLOATING BOX ==================== -->
        <div class="floatingBox table">
            <div class="container-fluid">
                <?php if (@$assets):
                    ?>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Campaign</th>
                                <th>Face</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $alp = array('','A','B','C','D','E');
                            foreach ($assets as $ur):
                                $i++;
                                $face = $ur->face_id;
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td>
                                        <?php echo $ur->titley ?>
                                    </td>
                                    <td>
                                        <?php echo $alp[$ur->face_id] ?>
                                    </td>
                                    <td>
                                        <?php echo $ur->start_date ?>
                                    </td>
                                    <td>
                                        <?php echo $ur->end_date ?>
                                    </td>
                                    <td><?php echo $ur->status ?></td>
                                    <td><a href="index.php/convergy/delete/<?php echo $ur->bid ?>" class="memberGroup">Delete Booking</a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                    <?php
                else:
                    ?>
                    <div class="review">
                        <h5><?php
                            echo 'No Booking For This Asset Yet!';
                            ?></h5>
                    </div>

                <?php
                endif;
                ?>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>
</div>