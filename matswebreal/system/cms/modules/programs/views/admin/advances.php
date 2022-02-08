
<section class="title">
    <strong>MATS Survey Log</strong>
    <span style="float: right"><a href="index.php/admin/programs/advancesearch" class="btn-info">Advanced Search</a></span>
</section>

<section class="item">
    <div class="content">


        <div id="filter-stage">
            <?php if (!empty($users)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <?php if ($this->current_user->group_id == 7): ?>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <?php if ($this->current_user->id != 622) : ?> <th>Name</th><?php endif; ?>
                                        <th class="">Mobile</th>
                                        <th>Hub Facility</th>
                                        <th>Spoke Facility</th>
                                        <th class="">Respondent</th>
                                        <th class="">TB Status</th>
                                        <th class="">Date</th>
                                        <th width="200">Actions</th>
                                    </tr>
                                </thead>






                                <tfoot>
                                    <tr>
                                        <td colspan="9">
                                            <div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    $link_profiles = Settings::get('enable_profiles');
                                    //var_dump($pagination["current_page"]); 
                                    $page = ((int)$pagination["current_page"] == 0) ? 1 : (int) $pagination["current_page"];
                                  //  var_dump($page);
                                    $i = 0;
                                     ?>
                                    <?php $c=0;  foreach ($users as $member): ?>
                                        <tr class="odd gradeX" >
                                            <td >
                                            <?php echo ++$i + (($page - 1) * (int)$pagination["limit"]); ?>
                                            </td>
                                            <?php if ($this->current_user->id != 622) : ?> 
                                            <td>
                                                    <?php echo $member->firstname ?>
                                                </td>
                                            <?php endif; ?>
                                            <td class=""><?php echo ($member->mobile) ?></td>
                                            <td class=""><?php echo ($member->name) ?></td>
                                            <td class=""><?php echo ($member->fullname) ?></td>
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
                                            <td class=""><?php
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
                                                ?></td>

                                            <td class=""><?php echo (@format_date($member->date_screened) != 'December 31, 1969') ? format_date(@$member->date_screened) : format_date($member->date_uploaded) ?></td>

                                            <td class="">
                                                <?php echo anchor('admin/programs/viewm/' . $member->sid, 'View More', array('class' => 'btn btn-success')) ?>
                                                <?php
                                                if ($this->current_user->group_id == 1 || $this->current_user->group_id == 44 || $this->current_user->group_id == 3) {
                                                    echo anchor('admin/programs/deleten/pat/' . $member->sid, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
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
                    <?php if ($this->current_user->group_id == 8 || $this->current_user->group_id == 9) : ?>
                        <div class="btn blue" style="margin: 10px;"><strong><a class="btn blue" href="index.php/admin/programs/downcsv" style="float: right"><strong>Export CSV</strong> </a></strong> </div>
                    <?php endif; ?>
                    <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') ))   
                    ?>

                </div>
            <?php endif
            ?>
        </div>



    </div>
</section>

