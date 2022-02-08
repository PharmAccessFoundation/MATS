
<section class="title">
    <strong>MATS Survey Log<input type="hidden" name="countj" value= <?php echo $countj ?> id='countj' /></strong>
    <span style="float: right"><a class="btn-info" href="index.php/admin/survey/advancesearch" class="btn">Advanced Search</a></span>
</section>

<section class="item">
    <div class="content">



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
                                <?php echo form_dropdown('f_group', array(0 => lang('global:select-all'), 1 => 'Self', 2 => 'Dependent Adult', 3 => 'Child (5 - 14 Years)', 4 => 'Child (Below 5 Years)'), array(), 'class=form-control') ?>
                            </li>

                            <li class="form-group input-group" style="float: left;">
                                <span class="input-group-addon">Screening Status</span>
                                <?php echo form_dropdown('status', array('yes' => 'Presumptive', 'no' => 'Non-Presumptive', 'nil' => 'All'), array(0), 'class=form-control') ?>
                            </li>
                            <?php if ($this->current_user->group_id == 5): ?>
                                <li  class="form-group input-group" style="float: left;">
                                    <input type="hidden" name="f_fac" value="<?php echo $this->current_user->facility; ?>" />
                                    <?php //echo form_dropdown('f_fac', array(0 => lang('global:select-all')) + $fac_select ) ?>
                                </li>
								<?php elseif($this->current_user->group_id == 4): ?>

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
                                <label style="padding-bottom: 5px"><?php echo form_reset('reset', 'Cancel', "class='btn btn-danger'"); //anchor(current_url(), lang('buttons:cancel'), 'class=" btn btn-danger"')             ?></label><br/>
                                <label style="padding-bottom: 5px"><?php echo form_submit('submit', 'Search', "class='btn btn-info'") ?></label>
                            </li>
                            <li class="form-group input-group">

                            </li>
                        </ul>
                        <?php echo form_close() ?>
                    </fieldset>
                </div>
                <?php if ($this->current_user->group_id == 44): ?>
                    <div id="" class="col-md-6">
                        <div id="chart-container">
                            <canvas id="mycanvas"></canvas>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php //echo form_open('admin/users/action') ?>

        <div id="filter-stage">
            <?php if (!empty($users)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        Screening Results
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-exampleee" id="dataTables-exampleee">
                                <thead>
                                    <tr>
                                        <th class="">S/N</th>
                                        <th class="">Screened Date</th>
                                        <th>Name</th>
                                        <th class="">Mobile</th>
                                        <th>Hub Facility</th>
                                        <th class="">Respondent</th>
                                         <th><?php if ($this->current_user->group_id != 4 && $this->current_user->group_id != 16 && $this->current_user->group_id != 12 && $this->current_user->group_id != 13): ?>Presented?<?php endif; ?></th> 
                                        <th class="">TB Status</th>
                                        <th style="width:250px">Actions</th>
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
                                    <?php $count = 0;
                                    foreach ($users as $member): ?>
                                        <tr class="odd gradeX" >
                                            <td >
        <?php echo ++$count + (($idd - 1) * 25); ?>
                                            </td>
                                            <td class=""><?php echo (@format_date($member->date_screened) != 'December 31, 1969') ? format_date(@$member->date_screened) : format_date($member->date_uploaded) ?></td>

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
                                                    echo 'Child (5 - 14 Years)';
                                                if ($member->respondent == 4)
                                                    echo 'Child (Below 5 Years)';
                                                ?></td>
                                                <?php if ($this->current_user->group_id == 1004): ?>
                                                <td class="">
                                                    <?php
                                                    if ($this->current_user->group_id != 4) {
                                                        $drpx1 = form_dropdown('xpert' . $member->sid, array(0 => 'Select Option', 1 => 'Positive', 2 => 'Negative'), array($member->xpert), 'class=form-control');
                                                        // $drpx2 = "<input type='date' name = 'xpertc".$member->sid."' value='$member->xpertdate' />";
                                                        $drpx4 = form_hidden('xpertsid', $member->sid);
                                                        $drpx3 = form_submit('submit', 'Sumbit', 'class="btn btn-warning"');

                                                        $drpx = '<table><tr><td>' . $drpx1 . ' </td><td> ' . $drpx4 . $drpx3 . ' </td></tr></table>';

                                                        echo form_open('/admin/survey/xpert');
                                                        echo $drpx;
                                                        echo form_close();
                                                        //echo strtoupper($member->status); $drpx;
                                                    }
                                                    ?>
                                                </td>
                                            <?php endif; ?>
                                                <td>
                                                    <?php if ($this->current_user->group_id != 4&& $this->current_user->group_id != 16 && $this->current_user->group_id != 12 && $this->current_user->group_id != 13): ?> 
                                                
            <?php if ($member->treated == 0): ?>
                                                        <input type="checkbox" unchecked class="checkbox" onclick="checkme(<?php echo $member->sid ?>)" name="<?php echo 'checkk' . $member->sid ?>" id="<?php echo 'check' . $member->sid ?>" />


                                        <?php else: ?>
                                            <input type="checkbox" checked class="checkbox" onclick="return false;" name="<?php echo 'checkk' . $member->sid ?>" id="<?php echo 'check' . $member->sid ?>" />
                                        <?php endif; ?>
                                        <?php endif; ?>
                                                </td>
                                    <td>
                                        <?php
                                        $status = 'Negative';
                                        if ($member->afb || $member->gene_xpert || $member->tb_lamp || $member->chest_xray) {
                                            if (strtolower(trim($member->afb)) != 'negative' && strtolower(trim($member->afb)) != '') {
                                                $status = 'Positive';
                                            }

                                            if (strtolower(trim($member->tb_lamp)) != 'negative' && strtolower(trim($member->tb_lamp)) != '') {
                                                $status = 'Positive';
                                            }

                                            if (strtolower(trim($member->chest_xray)) != 'negative' && strtolower(trim($member->chest_xray)) != '') {
                                                $status = 'Positive';
                                            }

                                            if (strtolower(trim($member->gene_xpert)) != 'mtb not detected' && strtolower(trim($member->gene_xpert)) != '') {
                                                $status = 'Positive';
                                            }
                                        } else {
                                            if ($member->status == 'yes') {
                                                $status = "Pending";
                                            } else {
                                                $status = 'Not Available';
                                            }
                                        }
                                        echo $status;
                                        ?>
                                    </td>

                                    <td class="">
                                        <?php echo anchor('admin/survey/viewm/' . $member->sid, 'View More', array('class' => 'btn btn-success')) ?> 
                                         <?php echo anchor('admin/survey/viewuser/' . $member->sid, 'View Location', array('class' => 'btn btn-info')) ?> 
                                        <?php
                                        if ($this->current_user->group_id == 1 || $this->current_user->group_id == 44 || $this->current_user->group_id == 3) {
                                            echo anchor('admin/survey/deleten/pat/' . $member->sid, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
                                        }
                                        ?>

                                        <?php
                                        if ($this->current_user->group_id != 4) {
                                            if ($member->treated != 0) {
                                                if ($this->current_user->group_id == 5) {
                                                    echo anchor('admin/survey/testresult/' . $member->sid, 'Input Test Result', array('class' => 'btn btn-primary'));
                                                }
                                            } else {
                                                echo '<div style="display:none"  id="div' . $member->sid . '" >';
                                                if ($this->current_user->group_id == 5) {
                                                    echo anchor('admin/survey/testresult/' . $member->sid, 'Input Test Result', array('class' => 'btn btn-primary'));
                                                }
                                                echo "</div>";
                                            }
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
                    <div class=""><strong><!--Total Count: <?php //echo $cusers;          ?>--></strong>
                        <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') ))    ?>
    <?php if (false): ?>
                            <a class="btn blue" href="<?php echo 'index.php/admin/survey/tocsv/' . $excf; ?>" style="float: right"><strong>Export CSV</strong> </a>
                                <!--    <a class="btn blue"  style="float: right"><strong>Export CSV</strong> </a>-->
    <?php endif; ?>
                    </div>
                </div>
            <?php endif
            ?>


            <script>

                function checkme(id) {
                    var checkid = 'check' + id;
                    var divid = 'div' + id;
                    var temp = document.getElementById(checkid);
                    if (temp.checked) {
                        document.getElementById(divid).style.display = 'block';
                        var urll = 'http://197.159.69.199:8000/index.php/admin/survey' + '/updatetreated/' + id;
                        //alert(urll);
                        getJSONP(urll, function (data) {
                            alert(data);
                        });
                    } else {
                        document.getElementById(divid).style.display = 'none';
                    }
                }

                function getJSONP(url, success) {
                    var ud = '_' + +new Date,
                            script = document.createElement('script'),
                            head = document.getElementsByTagName('head')[0]
                            || document.documentElement;

                    window[ud] = function (data) {
                        head.removeChild(script);
                        success && success(data);
                    };

                    script.src = url.replace('callback=?', 'callback=' + ud);
                    head.appendChild(script);

                }

            </script>
        </div>



<?php // echo form_close()    ?>
    </div>
</section>
