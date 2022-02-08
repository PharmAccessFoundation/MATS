
<section class="title">
    <strong>MATS Survey Log</strong>
    <span style="float: right"><a href="index.php/admin/survey/advancesearch" class="btn-info">Advanced Search</a></span>
</section>

<section class="item">
    <div class="content">


        <div id="filter-stage">
            <?php if (!empty($users)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <?php if ($this->current_user->group_id == 7): ?>
                            <a class="btn blue" href="index.php/admin/survey/tocsv2" strong>Export CSV</strong> </a>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Screened Date</th>
                                        <th>Name</th>
                                        <th class="">Mobile</th>
                                        <th>Hub Facility</th>
                                        <th class="">Respondent</th>
                                        <th class="">Date</th>
                                        <th width="200">Actions</th>
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
                                            <div class="inner"><?php // $this->load->view('admin/partials/pagination')  ?></div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $link_profiles = Settings::get('enable_profiles') ?>
                                    <?php $count = 0;
                                    foreach ($users as $member): ?>
                                        <tr class="odd gradeX" >
                                            <td >
        <?php echo ++$count; ?>
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
                                                    echo 'Child (Below 6 Years)';
                                                if ($member->respondent == 4)
                                                    echo 'Child (6 - 15 Years)';
                                                ?></td>
                                            <!--<td class=""><?php //echo (strtoupper($member->status) == 'YES') ? 'Positive' : 'Negative'  ?></td>-->

                                            <td class=""><?php echo (@format_date($member->date_screened) != 'December 31, 1969') ? format_date(@$member->date_screened) : format_date($member->date_uploaded) ?></td>

                                            <td class="">
                                                <?php echo anchor('admin/survey/viewm/' . $member->sid, 'View More', array('class' => 'btn btn-success')) ?>
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
                    <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') ))  ?>
                    <?php if ($this->current_user->group_id != 6): ?>
                        <?php
                        /// $_SESSION['pager2'] = $base_where;
                        // var_dump($_SESSION['pager2']);
                        ?>
                <?php endif; ?>
                </div>
            <?php endif
            ?>
        </div>



    </div>
</section>