

<div class="panel panel-default" style="margin: 10px;">
    <div class="panel-heading">
        Search Filters
    </div>
    <div class="panel-body div_top_hypers " style="">
        <div class="col-md-6">
            <fieldset id="filters">



                <?php echo form_open('') ?>
                <?php echo form_hidden('f_module', $module_details['slug']) ?>

                <ul style="list-style: none; display:  inline; " class="col-md-6 ul_top_hypers">
                    <!--<li class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Status</span>
                    <?php //echo form_dropdown('f_active', array('yes' => 'Positive', 'no' => 'Negative', 'nil' => 'All'), array(0), 'class=form-control') ?>
                    </li>-->

                    <li class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Respondent</span>
                        <?php echo form_dropdown('f_group', array(0 => lang('global:select-all'), 1 => 'Self', 2 => 'Dependent Adult', 3 => 'Child (Below 6 Years)', 4 => 'Child (6 - 15 Years)'), array(), 'class=form-control') ?>
                    </li>
                    <?php if ($this->current_user->group_id == 5): ?>
                        <li  class="form-group input-group" style="float: left;">
                            <input type="hidden" name="f_fac" value="<?php echo $this->current_user->facility; ?>" />
                            <?php //echo form_dropdown('f_fac', array(0 => lang('global:select-all')) + $fac_select ) ?>
                        </li>

                    <?php else: ?>

                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Available Facilities</span>
                            <?php echo form_dropdown('f_fac', array(0 => lang('global:select-all')) + $fac_select, array(), 'class=form-control') ?>
                        </li>



                    <?php endif; ?>
                    <li class="form-group input-group">
                        <span class="input-group-addon">From Date</span>
                        <input type="date" name="f_name" class="form-control" />
                    </li>
                    <li class="form-group input-group">
                        <span class="input-group-addon">To Date</span>
                        <input type="date" name="t_name" class="form-control" />
                    </li>
                    <li class="form-group input-group">
                        <label style="padding-bottom: 5px"></label><?php echo anchor(current_url(), lang('buttons:cancel'), 'class=" btn btn-danger"') ?>
                    </li>
                </ul>
                <?php echo form_close() ?>
            </fieldset>
        </div>
        <div id="" class="col-md-6">
            <div id="chart-container">
                <canvas id="mycanvas"></canvas>
            </div>
        </div>
    </div>
</div>