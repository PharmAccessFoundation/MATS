

<div class="panel panel-default" style="margin: 10px;">
    <div class="panel-heading">
        Search Filters
    </div>
    <div class="panel-body div_top_hypers" style="">
        <fieldset id="filters">



            <?php echo form_open('admin/programs/advances') ?>
            <?php echo form_hidden('f_module', $module_details['slug']) ?>

            <ul style="list-style: none; display:  inline; " class="col-md-4 ul_top_hypers">
                <li class="form-group input-group">
                    <span class="input-group-addon">Reference ID</span>
                    <input type="text" name="refid" class="form-control" />
                </li>
                
               <!-- <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">Screening Status</span>
                    <?php //echo form_dropdown('status', array('yes' => 'Presumptive', 'no' => 'Non-Presumptive', 'nil' => 'All'), array(0), 'class=form-control') ?>
                </li> -->

                <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">Respondent</span>
                    <?php echo form_dropdown('respondent', array(0 => lang('global:select-all'), 1 => 'Self', 2 => 'Dependent Adult', 3 => 'Child (Below 6 Years)', 4 => 'Child (6 - 15 Years)'), array(), 'class=form-control') ?>
                </li>
                <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">HIV Status</span>
                            <select name="hiv" id="hiv" class="form-control">
                                <option selected="selected" value=''>Select Option</option>
                                <option value="1">Yes</option>
                                <option value="2" >No</option>
                                <option value="3">Unknown</option>
                            </select>
                        </li>
                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Screening Result</span>
                            <select name="screenresult" id="screenresult" class="form-control">
                                <option selected="selected" value=''>Select Option</option>
                                <option value="yes">Presumptive</option>
                                <option value="no" >Non-Presumptive</option>
                            </select>
                        </li>
                
                <li class="form-group input-group">
                    <label style="padding-bottom: 5px"></label><input type="submit" name="Search" value="Search" class="btn btn-info" />
                </li>
                <li class="form-group input-group">
                    <label style="padding-bottom: 5px"></label><?php echo anchor(current_url(), lang('buttons:cancel'), 'class=" btn btn-danger"') ?>
                </li>
                
            </ul>
            <ul style="list-style: none; display:  inline; " class="col-md-4 ul_top_hypers">
                
                 
                <?php if ($this->current_user->group_id == 5): ?>
                    <li  class="form-group input-group" style="float: left;">
                        <input type="hidden" name="facility" value="<?php echo $this->current_user->facility; ?>" />
                        <?php //echo form_dropdown('f_fac', array(0 => lang('global:select-all')) + $fac_select ) ?>
                    </li>

                <?php else: ?>

                    <li class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Available Hub Facilities</span>
                        <?php echo form_dropdown('facility', array(0 => lang('global:select-all')) + $fac_select, array(), 'class=form-control') ?>
                    </li>

                    

                <?php endif; ?>
                <li class="form-group input-group">
                    <span class="input-group-addon">From Date</span>
                    <input type="date" name="fromdate" class="form-control" />
                </li>
                <li class="form-group input-group">
                    <span class="input-group-addon">To Date</span>
                    <input type="date" name="todate" class="form-control" />
                </li>
                <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Patient Type</span>
                            <select name="pretype" id="pretype" class="form-control">
                                <option selected="selected" value=''>Select Option</option>
                                <option value="yes">Presumptive DR</option>
                                <option value="no" >Presumptive DS</option>
                            </select>
                        </li>
                        
                        
                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Weight Loss?</span>
                            <select name="weight" id="weight" class="form-control">
                                <option selected="selected" value=''>Select Option</option>
                                <option value=1>Yes</option>
                                <option value=2 >No</option>
                            </select>
                        </li>
                
            </ul>
            <ul style="list-style: none; display:  inline; " class="col-md-4 ul_top_hypers">
                 
                <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Hub Facility State</span>
                            <select name="state" id="state" class="form-control">
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
                            <span class="input-group-addon">LGA</span>
                            <select name="lga" id="lga" class="form-control">
                            </select>
                        </li>
                        
                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Coughing?</span>
                            <select name="cough" id="cough" class="form-control">
                                <option selected="selected" value=''>Select Option</option>
                                <option value=1>Yes</option>
                                <option value=2 >No</option>
                            </select>
                        </li>
                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Fever?</span>
                            <select name="fever" id="fever" class="form-control">
                                <option selected="selected" value=''>Select Option</option>
                                <option value=1>Yes</option>
                                <option value=2 >No</option>
                            </select>
                        </li>
                     
                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Night Sweat?</span>
                            <select name="nightsweat" id="nightsweat" class="form-control">
                                <option selected="selected" value=''>Select Option</option>
                                <option value=1>Yes</option>
                                <option value=2 >No</option>
                            </select>
                        </li>    
            </ul>
            
            <?php echo form_close() ?>
        </fieldset>
    </div>
</div>