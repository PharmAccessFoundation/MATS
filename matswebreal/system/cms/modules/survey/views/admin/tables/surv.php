<?php if (!empty($users)): ?>
    <div class="panel panel-default" style="margin: 10px;">
        <div class="panel-heading">
            Screening Results
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                    <thead>
                        <tr>
                            <th class="">S/N</th>
                            <th class="">Screened Date</th>
                             <?php if ($this->current_user->id != 622): ?><th>Name</th>  <?php else: ?> <th></th><?php endif; ?>
                            <th class="">Mobile</th>
                            <th>Hub Facility</th>
                            <th class="">Respondent</th>
                            <?php if ($this->current_user->group_id != 44): ?> <th >TB Status</th> <?php endif; ?>
                            <th class="">Actions</th>
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
                                <div class="inner"><?php //$this->load->view('admin/partials/pagination')  ?></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $link_profiles = Settings::get('enable_profiles') ?>
                        <?php $c = 0;
                        foreach ($users as $member): ?>
                            <tr class="odd gradeX" >
                                <td >
        <?php echo ++$c; ?>
                                </td>
                                <td class=""><?php echo (@format_date($member->date_screened) != 'December 31, 1969') ? format_date(@$member->date_screened) : format_date($member->date_uploaded) ?></td>
<?php if ($this->current_user->id != 622): ?>
                                <td >
        <?php echo $member->firstname ?>
                                </td>
                                  <?php else: ?> <td></td><?php endif; ?>
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
                                    <?php if ($this->current_user->group_id != 44): ?>
                                    <td class="">
                                        <?php
                                        // $drpx1 = form_dropdown('xpert'.$member->sid, array(0 => 'Select Option', 1 => 'Positive', 2 => 'Negative'), array($member->xpert), 'class=form-control' );
                                        // $drpx2 = "<input type='date' name = 'xpertc".$member->sid."' value='$member->xpertdate' />";
                                        $drpx4 = form_hidden('xpertsid', $member->sid);
                                        $drpx3 = form_submit('submitt', 'sumbit', 'class="btn btn-primary"');
                                        if ($this->current_user->group_id == 5) {
                                            $drpx = '<table><tr><td>' . $drpx1 . ' </td><td> ' . $drpx2 . '</td><td> ' . $drpx4 . $drpx3 . ' </td></tr></table>';
                                            $drpx = '';
                                        } else {
                                            $drpx = '';
                                        }

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
                                <?php endif; ?>

                                <td class="">
                                    <?php 
                                    if($this->current_user->group_id == 1 || $this->current_user->group_id == 8 || $this->current_user->group_id == 44 || $this->current_user->group_id == 4 || $this->current_user->group_id == 5 || $this->current_user->group_id == 3){
                                    echo anchor('admin/survey/viewm/' . $member->sid, 'View More', array('class' => 'btn btn-success')); 
                                    }
                                    ?> 
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
    <?php
   // if($c == 5){break;}
    endforeach;
    ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
<?php else: ?>
<div class="panel panel-default" style="margin: 10px;">
<div class="panel-body">
    
    <h5 style="font-weight: bold;">No Screening Data For This Account</h5>
</div>
</div>
<?php endif; ?>