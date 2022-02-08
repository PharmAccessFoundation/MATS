
<section class="title">
    <strong>Input Test Results For <?php echo ucfirst($user->firstname) ?></strong>
</section>

<section class="item">
    <div class="content">

        <?php echo form_open('') ?>

        <style>
            .info-color{
                background-color: #33b5e5 !important;
                border-radius: 8px;
                color: #fff;
                padding: .75rem 1.25rem;
            }

            #afbd{
                display: none;
            }
            #gxpertd{
                display: none;
            }
            #tblampd{
                display: none;
            }
            #chestxrayd{
                display: none;
            }
            #sumb{
                display: none;
            }
        </style>
        <!-- Material form contact -->

        <div class="col-lg-12" style="padding-top: 0px;">
            <div class="card col-md-6" id="select">
                <fieldset>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Test Result Type</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">


                        <select name="testselect" id="testselect" class="mdb-select" onchange="showTest(this)" >
                            <option value="">Select An Option</option>
                            <option value="afb">AFB</option>
                            <option value="gxpert">Gene-Xpert</option>
                            <option value="tblamp">TB Lamp</option>
                            <option value="chestxray">Chest X-ray</option>
                        </select>
                    </div>

                </fieldset>
            </div>
        </div>
        <div class="col-lg-12" style="padding-top: 20px;">

            <div class="card col-md-6" id="afbd">
                <fieldset>
                    <legend>AFB:</legend>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Result</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">

                        <input type="hidden" name="afbhid" value="" id="afbhid" />
                        <select name="afb" id="afb" class="mdb-select">
                            <?php
                            if (false) {
                                echo "<option value='$test->afb'>" . ucfirst(@$test->afb) . "</option>";
                            }
                            ?>
                            <option value="">Select An Option</option>
                            <option value="negative">Negative</option>
                            <option value="scanty (1-9)">Scanty (1-9)</option>
                            <option value="1+">1+</option>
                            <option value="2+">2+</option>
                            <option value="3+">3+</option>
                        </select>
                        <!-- Send button -->

                        <!-- Form <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Send</button> -->

                    </div>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Date of Sample Collection</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <input name="afb_sample" type="date" value="" class="mdb-select"/>
                    </div>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Date of Result Collection</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <input name="afb_result" type="date" value="" class="mdb-select"/>
                    </div>

                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Remarks</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">

                        <textarea name="afb_remarks" style="height:100px" class="mdb-select" maxlength="160">
                            <?php echo (@$test->afb_remarks) ? @$test->afb_remarks : '' ?>
                        </textarea>
                    </div>
                </fieldset>
            </div>

            <div class="card col-md-6" id="gxpertd">
                <fieldset>
                    <legend>GENE-XPERT:</legend>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Result</strong>
                    </h5>

                    <input type="hidden" name="genehid" value="" id="genehid" />
                    <div class="card-body px-lg-5 pt-0">

                        <select name="genexpert" id="genexpert" class="mdb-select">
                            <?php
                            if (false) {
                                echo @"<option value='$test->gene_xpert'>" . ucfirst($test->gene_xpert) . "</option>";
                            }
                            ?>
                            <option value="">Select An Option</option>
                            <option value="MTB not detected">MTB not detected</option>
                            <option value="MTB detected Rif resistance not detected">MTB detected Rif resistance not detected</option>
                            <option value="MTB detected Rif resistance indeterminate">MTB detected Rif resistance indeterminate</option>
                            <option value="MTB detected (Trace) Rif resistance Indeterminate">MTB detected (Trace) Rif resistance Indeterminate</option>
                        </select>
                        <!--
                                           <div class="mdb-select">
                                               <input readonly="readonly" name="genexpert" value="" id="genexpert" />
                                           </div>
                                           Send button -->

                        <!-- Form <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Send</button> -->

                    </div>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Date of Sample Collection</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <input name="gx_sample" type="date" value="" class="mdb-select"/>
                    </div>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Date of Result Collection</strong>
                    </h5>
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <input name="gx_result" type="date" value="" class="mdb-select"/>
                    </div>
                    
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Remarks</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">

                        <textarea name="gx_remarks" style="height:100px" class="mdb-select" maxlength="160">
                            <?php  ?>
                        </textarea>
                    </div>

                </fieldset>
            </div>
        </div>
        <div class="col-lg-12" style="">


            <div class="card col-md-6" id="tblampd">

                <input type="hidden" name="tbhid" value="" id="tbhid" />
                <fieldset>
                    <legend>TB LAMP:</legend>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Result</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">


                        <select name="tblamp" id="tblamp" class="mdb-select">
                            <?php
                            if (FALSE) {
                                echo @"<option value='$test->tb_lamp'>" . ucfirst($test->tb_lamp) . "</option>";
                            }
                            ?>
                            <option value="">Select An Option</option>
                            <option value="negative">Negative</option>
                            <option value="positive">Positive</option>
                        </select>
                        <!-- Send button -->

                        <!-- Form <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Send</button> -->

                    </div>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Date of Sample Collection</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <input name="tb_sample" type="date" value="" class="mdb-select"/>
                    </div>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Date of Result Collection</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <input name="tb_result" type="date" value="" class="mdb-select"/>
                    </div>
                    
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Remarks</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">

                        <textarea name="tb_remarks" style="height:100px" class="mdb-select" maxlength="160">
                            <?php ?>
                        </textarea>
                    </div>
                </fieldset>
            </div>

            <div class="card col-md-6" id="chestxrayd">
                <fieldset>
                    <input type="hidden" name="cxhid" value="" id="cxhid" />

                    <legend>CHEST X-RAY:</legend>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Result</strong>
                    </h5>


                    <div class="card-body px-lg-5 pt-0">


                        <select name="chestxray" id="chestxray" class="mdb-select">
                            <?php
                            if (false) {
                                echo @"<option value='$test->chest_xray'>" . ucfirst($test->chest_xray) . "</option>";
                            }
                            ?>
                            <option value="">Select An Option</option>
                            <option value="negative">Negative</option>
                            <option value="positive">Positive</option>
                        </select>
                        <!-- Send button -->

                        <!-- Form <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Send</button> -->

                    </div>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Date X-ray was Performed</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <input name="xray_sample" type="date" value="" class="mdb-select"/>
                    </div>
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Date X-ray Film was Reported/Collected</strong>
                    </h5>
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <input name="xray_result" type="date" value="" class="mdb-select"/>
                    </div>

                    
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Remarks</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">

                        <textarea name="xray_remarks" style="height:100px" class="mdb-select" maxlength="160">
                            <?php ?>
                        </textarea>
                    </div>
                </fieldset>
            </div>


            <!-- Material form contact -->
            <div class="col-lg-12" style="padding-top: 20px; padding-bottom: 50px" id="sumb">
                <div style=" padding-top: 0px; padding-bottom: 10px;">
                    <button class="btn btn-success" type="submit">Submit Result</button> <a class="btn btn-danger" href="admin/survey">Cancel</a>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>



</section>

<section>
    <div class="panel panel-default" style="padding-top: 0px;">
        <div class="panel-heading">
            <strong>Test Result Logs For <?php echo ucfirst($user->firstname) ?></strong>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                    <thead>
                        <tr>
                            <th class="">Test Type</th>
                            <th>Result Status</th>
                            <th class="">Sample Collection</th>
                            <th>Result Collection</th>
                            <th>Remarks</th>
                            <th class="">Date Uploaded</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (!empty($logs)): ?>
                            <?php $link_profiles = Settings::get('enable_profiles') ?>
                            <?php foreach ($logs as $member): ?>
                                <tr class="odd gradeX" >
                                    <td class=""><?php echo $member->type ?></td>

                                    <td >
                                        <?php echo $member->result ?>
                                    </td>

                                    <td >
                                        <?php echo $member->sample_date ?>
                                    </td>
                                    <td >
                                        <?php echo $member->result_date ?>
                                    </td>
                                    <td >
                                        <?php echo $member->remarks ?>
                                    </td>
                                    <td >
                                        <?php echo $member->date_uploaded ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>

                                <td><strong> No Data Available </strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</section>



<script>
    function showTest(element)
    {
        if (element.value == 'afb') {
            document.getElementById('afbd').style.display = 'block';
            document.getElementById('tblampd').style.display = 'none';
            document.getElementById('gxpertd').style.display = 'none';
            document.getElementById('chestxrayd').style.display = 'none';
            document.getElementById('sumb').style.display = 'block';
            document.getElementById("posttype").value = ''
        } else if (element.value == 'tblamp') {
            document.getElementById('afbd').style.display = 'none';
            document.getElementById('tblampd').style.display = 'block';
            document.getElementById('gxpertd').style.display = 'none';
            document.getElementById('chestxrayd').style.display = 'none';
            document.getElementById('sumb').style.display = 'block';

        } else if (element.value == 'gxpert') {
            document.getElementById('afbd').style.display = 'none';
            document.getElementById('tblampd').style.display = 'none';
            document.getElementById('gxpertd').style.display = 'block';
            document.getElementById('chestxrayd').style.display = 'none';
            document.getElementById('sumb').style.display = 'block';

        } else if (element.value == 'chestxray') {

            document.getElementById('afbd').style.display = 'none';
            document.getElementById('tblampd').style.display = 'none';
            document.getElementById('gxpertd').style.display = 'none';
            document.getElementById('chestxrayd').style.display = 'block';
            document.getElementById('sumb').style.display = 'block';
        } else {
            document.getElementById('afbd').style.display = 'none';
            document.getElementById('tblampd').style.display = 'none';
            document.getElementById('gxpertd').style.display = 'none';
            document.getElementById('chestxrayd').style.display = 'none';
            document.getElementById('sumb').style.display = 'none';

        }
    }
</script>
