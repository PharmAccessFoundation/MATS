
<div class="panel panel-default" style="margin: 10px;">

    <div class="panel-body div_top_hypers" style="">
        <fieldset id="filters">

            <?php echo form_open('') ?>
            <?php echo form_hidden('f_module', $module_details['slug']) ?>
            <ul style="list-style: none; display:  inline; " class="col-md-3 ul_top_hypers">
                <?php if($this->current_user->group_id == 7): ?>
                <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">State</span>
                    <select name="state" id="" class="form-control">
                        <option value="" selected="selected" >- Select -</option>
                        <option value='Abia'>Abia</option>
                        <option value='Adamawa'>Adamawa</option>
                        <option value='AkwaIbom'>AkwaIbom</option>
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
                </li>
                <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">Sub Recipient Type</span> 
                        <?php echo $srlist ?>
                </li>
                <?php endif; ?>
                <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">Hub Facility</span>
                    <?php echo form_dropdown('f_fac', array(0 => lang('global:select-all')) + $faccs, array(0), 'class=form-control') ?>
                </li>

                <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">Name</span><?php echo form_input('f_name', '', 'class=form-control') ?></li>
                <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">Programme</span>
                    <?php echo form_dropdown('prog', $pro, array(), 'class=form-control'); // var_dump($pro); exit; ?>

                </li>
                <li class="form-group input-group"><?php echo anchor(current_url(), lang('buttons:cancel'), 'class="btn btn-danger"') ?></li>

            </ul>
            <?php echo form_close() ?>
        </fieldset>