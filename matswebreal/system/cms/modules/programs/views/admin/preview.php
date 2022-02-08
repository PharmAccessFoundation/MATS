<section class="title">
    <strong>Screened Details</strong>
</section>

<section class="item">
    <div class="content">

        <?php template_partial('filters') ?>

        <?php echo form_open('admin/users/action') ?>

        <div id="filter-stage">
            <?php if (!empty($member)): ?>
                 <div class="table-responsive">
                                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Questions</th>
                            <th>Answers</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="">Date</td>
                            <td class=""><?php echo format_date($member->date_uploaded) ?></td>
                        </tr>
                        <?php if ($this->current_user->id != 622) : ?>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $member->firstname ?></td>
                        </tr><tr>
                            <td class="">Mobile</td>
                            <td class=""><?php echo ($member->mobile) ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Hub Facility</td>
                            <td class=""><?php echo ($member->name) ?></td>
                        </tr><tr>
                            <td>State</td>
                            <td class=""><?php echo ($member->state) ?></td>
                        </tr><tr>
                            <td>LGA</td>
                            <td class=""><?php echo ($member->lga) ?></td>
                        </tr><tr>
                            <td class="">Respondent</td>
                            <td><?php
                                if ($member->respondent == 1)
                                    echo 'Self';
                                if ($member->respondent == 2)
                                    echo 'Dependent Adult';
                                if ($member->respondent == 3)
                                    echo 'Child';
                                ?></td>
                        </tr><tr>
                            <td>Coughing?</td>
                            <td><?php
                                if ($member->cough == 1)
                                    echo 'Yes';
                                if ($member->cough == 2)
                                    echo 'No';
                                if ($member->cough == 0)
                                    echo 'Nil';
                                ?>
                            </td>
                        </tr><tr>
                            <td>Cough More Than 2 Weeks?</td>
                            <td><?php
                            if ($member->more == 1)
                                echo 'Yes';
                            if ($member->more == 2)
                                echo 'No';
                            if ($member->more == 0)
                                echo 'Nil';
                            ?>
                            </td>
                        </tr><tr>
                            <td>Weight Loss? </td>
                            <td><?php
                                if ((int) $member->weightloss == 1) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Night Sweat? </td>
                            <td><?php
                                if ((int) $member->nightsweat == 1) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Fever? </td>
                            <td><?php
                           if ((int) $member->fever == 1) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Adequate Growth? </td>
                            <td><?php
                            if ($member->growth == 1)
                                echo 'Yes';
                            if ($member->growth == 2)
                                echo 'No';
                            if ($member->growth == 0)
                                echo 'Nil';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>More Details</td>
                            <td><?php
        echo ($member->details == '0' || trim($member->details) == '') ? 'Nil' : $member->details;
        ?>
                            </td>
                        <tr>
                            <td class="">Presumptive Status?</td>
                            <td class=""><?php echo ucfirst($member->status) ?></td>
                            <tr>
                            <td class="">TB Status</td>
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
                                            if(($member->status)){
                                                $status = "Pending";
                                            }else{
                                            $status = 'Not Available';
                                            }
                                        }
                                        echo $status;
                                        ?></td>
                        </tr>
                        </tr>

                    </tbody>
                </table>
                 </div>
<?php endif ?>
        </div>


<?php echo form_close() ?>
    </div>
</section>
