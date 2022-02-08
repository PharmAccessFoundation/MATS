
<section class="title">
    <strong>Presumptives</strong>
    <span style="float: right"><a href="index.php/admin/programs/advancesearch" class="btn-info">Advanced Search</a></span>
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
                    </li>

                    <li class="form-group input-group" style="float: left;">
                        <span class="input-group-addon">Respondent</span>
                        <?php //echo form_dropdown('f_group', array(0 => lang('global:select-all'), 1 => 'Self', 2 => 'Dependent Adult', 3 => 'Child (Below 6 Years)', 4 => 'Child (6 - 15 Years)'), array(), 'class=form-control') ?>
                    </li>
                    
                    <li class="form-group input-group" style="float: left;">
                    <span class="input-group-addon">Screening Status</span>
                    <?php //echo form_dropdown('status', array('yes' => 'Presumptive', 'no' => 'Non-Presumptive', 'nil' => 'All'), array(0), 'class=form-control') ?>
                </li>-->
                    <?php if ($this->current_user->group_id == 5): ?>
                        <li  class="form-group input-group" style="float: left;">
                            <input type="hidden" name="f_fac" value="<?php echo $this->current_user->facility; ?>" />
                            <?php //echo form_dropdown('f_fac', array(0 => lang('global:select-all')) + $fac_select ) ?>
                        </li>

                    <?php else: ?>

                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Available Hub Facilities</span>
                            <?php echo form_dropdown('f_fac', array(0 => lang('global:select-all')) + $faccs, array(), 'class=form-control') ?>
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
                            <span>
                                <input class="btn btn-info" type="submit" name="submit" value="Search"/>
                            </span>
                        </li>
                        <li class="form-group input-group">
                            <span><?php echo anchor(current_url(), lang('buttons:cancel'), 'class=" btn btn-danger"') ?></span>
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
        <?php echo form_open('admin/users/action') ?>

        <div id="filter-stage">
            <?php if (!empty($users)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <?php if ($this->current_user->group_id == 77): ?>
                            <a class="btn blue" href="index.php/admin/programs/tocsv/<?php echo $excf; ?>" <strong>Export CSV</strong> </a>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th class="">Mobile</th>
                                        <th>Hub Facility</th>
                                        <th class="">Spoke Facility</th>
                                        <th>TB Status</th>
                                        <th class="">Date</th>
                                        <th width="250">Actions</th>
                                        <th></th>
                                        <th>HIV</th>
                                        <th>Growth</th>
                                        <th>Cough</th>
                                        <th>Weight Loss</th>
                                        <th>Night Sweat</th>
                                        <th>Fever</th>
                                        <th>AntiTB</th>
                                        <th>Presented</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>State</th>
                                        <th>LGA</th>
                                    </tr>
                                </thead>






                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="inner"><?php  //$this->load->view('admin/partials/pagination') ?></div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $link_profiles = Settings::get('enable_profiles') ?>
                                    <?php $i = 0;
                                    foreach ($users as $member): ?>
                                        <tr class="odd gradeX" >
                                            
                                            <td >
        <?php echo ++$i; ?>
                                            </td>
                                            <td >
        <?php 
        echo $member->firstname ?>
                                            </td>
                                            <td class=""><?php echo ($member->mobile) ?></td>
                                            <td class=""><?php echo ($member->name) ?></td>
                                            <td><?php
                                                /*if ($member->respondent == 1)
                                                    echo 'Self';
                                                if ($member->respondent == 2)
                                                    echo 'Dependent Adult';
                                                if ($member->respondent == 3)
                                                    echo 'Child (Below 6 Years)';
                                                if ($member->respondent == 4)
                                                    echo 'Child (6 - 15 Years)';*/
                                            echo $member->fullname;
                                                ?></td>
                                            <td class="">
                                   <?php 
                                   /*
                                  $drpx1 = form_dropdown('xpert'.$member->sid, array(0 => 'Select Option', 1 => 'Positive', 2 => 'Negative'), array($member->xpert), 'class=form-control' );
                                  // $drpx2 = "<input type='date' name = 'xpertc".$member->sid."' value='$member->xpertdate' />";
                                   $drpx4 = form_hidden('xpertsid', $member->sid);
                                   $drpx3 = form_submit('submit', 'Sumbit', 'class="btn btn-primary"');
                                   
                                   $drpx = '<table><tr><td>'.$drpx1.' </td><td> '.$drpx4.$drpx3.' </td></tr></table>';
                                   
                                   echo form_open('/admin/programs/xpert');
                                         if(!$member->xpert){
                                             echo 'Unknown';
                                         }else{
                                             echo ((int)$member->xpert == 1) ? 'Positive' : 'Negative';
                                         }
                                       echo form_close();
                                         //echo strtoupper($member->status); $drpx;
                                    * 
                                    */
                                                $status = 'Negative';
                                                if ($member->afb || $member->gene_xpert || $member->tb_lamp || $member->chest_xray) {
                                                    if(strtolower(trim($member->afb)) != 'negative' && strtolower(trim($member->afb)) != ''){
                                                        $status = 'Positive';
                                                    }
                                                    
                                                    if(strtolower(trim($member->tb_lamp)) != 'negative' && strtolower(trim($member->tb_lamp)) != ''){
                                                        $status = 'Positive';
                                                    }
                                                    
                                                    if(strtolower(trim($member->chest_xray)) != 'negative' && strtolower(trim($member->chest_xray)) != ''){
                                                        $status = 'Positive';
                                                    }
                                                    
                                                    if(strtolower(trim($member->gene_xpert)) != 'mtb not detected' && strtolower(trim($member->gene_xpert)) != ''){
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
                                            <!--<td class=""><?php //echo (strtoupper($member->status) == 'YES') ? 'Positive' : 'Negative'  ?></td>-->

                                            <td class=""><?php echo (@format_date($member->date_screened) != 'December 31, 1969') ? format_date(@$member->date_screened) : format_date($member->date_uploaded) ?></td>

                                            <td class="">
                                                <?php echo anchor('admin/programs/viewm/' . $member->sid, 'View More', array('class' => 'btn btn-success')) ?>
                                         <?php echo anchor('admin/programs/viewuser/' . $member->sid, 'View Location', array('class' => 'btn btn-info')) ?> 
                                                <?php
                                                if ($this->current_user->group_id == 1 || $this->current_user->group_id == 44 || $this->current_user->group_id == 3) {
                                                    echo anchor('admin/survey/deleten/pat/' . $member->sid, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
                                                }
                                                ?>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
        <?php echo $member->hiv ?>
                                            </td>
                                            <td>
        <?php echo $member->growth ?>
                                            </td>
                                            <td>
        <?php echo $member->cough ?>
                                            </td>
                                            <td>
        <?php echo $member->weightloss ?>
                                            </td>
                                            <td>
        <?php echo $member->nightsweat ?>
                                            </td>
                                            <td>
        <?php echo $member->fever ?>
                                            </td>
                                            <td>
        <?php echo $member->antitb ?>
                                            </td>
                                            <td>
        <?php echo $member->treated ?>
                                            </td>
                                            <td>
        <?php echo $member->age ?>
                                            </td>
                                            <td>
        <?php echo $member->gender ?>
                                            </td>
                                            <td>
        <?php echo $member->state ?>
                                            </td>
                                            <td>
        <?php echo $member->lga ?>
                                            </td>
                                        </tr>
    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
            
                <div class="table_action_buttons">
                    <div class="btn blue"><strong><!--Total Count: <?php //echo $cusers; ?>--></strong> </div>
                    <?php if (FALSE): ?>
                     <!--   <a class="btn blue" href="# <?php // echo 'index.php/admin/survey/tocsv/'.$excf; ?>" style="float: right"><strong>Export CSV</strong> </a>-->
                        <a class="btn blue"  style="float: right"><strong>Export CSV</strong> </a>
                    <?php endif; ?>
                <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') ))   ?>

                </div>
            <?php else: ?>
             <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        No Screening Result Available
                    </div> 
                    <div class="panel-body">
                    </div>
             </div>
<?php endif
?>

            <script>
                $(document).ready(function () {
                    $('#dataTables-exampleeeee').dataTable({
                        "paging": false
                    });
                });
            </script>
        </div>



<?php echo form_close() ?>
    </div>
</section>
