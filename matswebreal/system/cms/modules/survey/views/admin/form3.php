<?php if ($err): ?>
    <div class="error"><?php echo $err; ?></div>
<?php endif; ?>
<?php if ($er): ?>
    <div class="success"><?php echo $er; ?></div>
<?php endif; ?>
<section class="title">

    <strong>Edit Hub Facility</strong>
    <?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"') ?>


</section>

<section class="item">
    <div class="content">

        <div class="panel panel-default" style="margin: 10px;">
            <div class="panel-heading">
                Edit Hub Facility
            </div>
            <div class="panel-body div_top_hypers" style="">
                <!-- Content tab -->
                <div class="form_inputs col-md-6" style="padding-top: 0;" id="user-basic-data-tab">
                    <fieldset>



                        <div class="input form-group">
                            <label for="name">Choose Hub Facility State<span>*</span></label>
                            <select name="state" id="state" class="form-control">
                                <option value="" selected="selected" >- Select -</option>
                                <option value='Abia'>Abia</option>
                                <option value='Adamawa'>Adamawa</option>
                                <option value='AkwaIbom'>Akwa Ibom</option>
                                <option value='Anambra'>Anambra</option>
                                <option value='Bauchi'>Bauchi</option>
                                <option value='Bayelsa'>Bayelsa</option>
                                <option value='Benue'>Benue</option>
                                <option value='Borno'>Borno</option>
                                <option value='Cross River'>Cross River</option>
                                <option value='Delta'>Delta</option>
                                <option value='Ebonyi'>Ebonyi</option>
                                <option value='Edo'>Edo</option>
                                <option value='Ekiti'>Ekiti</option>
                                <option value='Enugu'>Enugu</option>
                                <option value='FCT'>FCT</option>
                                <option value='Gombe'>Gombe</option>
                                <option value='Imo'>Imo</option>
                                <option value='Jigawa'>Jigawa</option>
                                <option value='Kaduna'>Kaduna</option>
                                <option value='Kano'>Kano</option>
                                <option value='Katsina'>Katsina</option>
                                <option value='Kebbi'>Kebbi</option>
                                <option value='Kogi'>Kogi</option>
                                <option value='Kwara'>Kwara</option>
                                <option value='Lagos'>Lagos</option>
                                <option value='Nasarawa'>Nasarawa</option>
                                <option value='Niger'>Niger</option>
                                <option value='Ogun'>Ogun</option>
                                <option value='Ondo'>Ondo</option>
                                <option value='Osun'>Osun</option>
                                <option value='Oyo'>Oyo</option>
                                <option value='Plateau'>Plateau</option>
                                <option value='Rivers'>Rivers</option>
                                <option value='Sokoto'>Sokoto</option>
                                <option value='Taraba'>Taraba</option>
                                <option value='Yobe'>Yobe</option>
                                <option value='Zamfara'>Zamafara</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">LGA</label>
                            <select name="lga" id="lga" class="form-control" required>
                            </select>
                        </div>

                        <div class="input form-group">
                            <label for="name">Hub Facility Name<span>*</span></label>
                            <?php echo form_input('name', $curr->name, 'class=form-control') ?>
                        </div>



                        <div class="input form-group">
                            <label for="add">Hub Facility Address <span>*</span></label>
                            <?php echo form_input('add', $curr->address, 'class=form-control') ?>
                        </div>

                        <div class="input form-group">
                            <label for="phone">Hub Facility Phone <span>*</span></label>
                            <?php echo form_input('phone', $curr->phone, 'class=form-control') ?>
                        </div>

                        <div class="input form-group">
                            <label for="email">Hub Facility Email <span>*</span></label>
                            <?php echo form_input('email', $curr->email, 'class=form-control') ?>
                        </div>




                        <div class="buttons">
                            <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))) ?>
                        </div>
                        <div class="buttons">
                            <?php
                            if ($this->current_user->group_id == 5) {
                               $cancel = '/admin/survey/myfacility';
                            } else {
                                 $cancel = '/admin/survey/facility';
                            }
                            ?>
                            <label style="padding-top: 25px"></label><?php echo anchor($cancel, lang('buttons:cancel'), 'class=" btn btn-danger"') ?>

                        </div>

                    </fieldset>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>

</section>