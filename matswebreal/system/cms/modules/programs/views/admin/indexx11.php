
<section class="title">
   <strong>Available Hub Facilities</strong>
</section>

<section class="item">
    <div class="content">

        <div class="panel panel-default" style="margin: 10px;">
            <div class="panel-heading">
                
            </div>
            <div class="panel-body div_top_hypers" style="">
                <fieldset id="filters">



                    <?php echo form_open('') ?>
                    <ul style="list-style: none; display:  inline; " class="col-md-3 ul_top_hypers">
                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Hub Facility Status</span>
                            <select name="status" id="status" class="form-control">
                                <option selected="selected" value='all'>All</option>
                                <option value=1>Active</option>
                                <option value=2 >Inactive</option>
                            </select>
                        </li>
                        
                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Hub Facility State</span>
                            <select name="state" id="state" class="form-control">
                                <option value="" selected="selected" >- Select -</option>
                                <option value='Abia'>Abia</option>
                                <option value='Adamawa'>Adamawa</option>
                                <option value='Akwa Ibom'>Akwa Ibom</option>
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

                        </li>
                        <div class="input form-group" >
                            <label for="numb"> Programme(s) </label>
                            <?php
                            foreach ($pro as $k => $v) {
                                if($k == ''){
                                    continue;
                                }
                                echo '<li class="form-group input-group"  style="margin-top:15px;"><span class="info">'.$v.'</span></li>';
                            }
                            ?>
                        </div>
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
        </div>

        <?php echo form_open('admin/users/action') ?>

        <div id="filter-stage">
            <?php if (!empty($facs)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <?php if (true): ?>
                      <!--  <a class="btn blue"  href="index.php/admin/programs/fac2csv/<?php //echo $exef; ?>" ><strong>Export CSV</strong> </a>-->
                        
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover example" id="example" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Hub Facility</th>
                                        <th>Linkage Cord</th>
                                        <th class="">State</th>
                                        <th class="">LGA</th>
                                        <th class="">Email</th>
                                        <th class="">Phone</th>
                                        <th class="">Date Created</th>
                                        <th width="370">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $link_profiles = Settings::get('enable_profiles') ?>
                                    <?php foreach ($facs as $member): ?>
                                        <tr>
                                            <td class=""><?php echo form_checkbox('one', 1); echo form_hidden('avail', '1')?></td>
                                            <td class=""><?php echo ($member->name) ?></td>
                                            <td class=""><?php echo ($this->current_user->group_id == 9) ? ($member->ppfirst.' '.$member->pplast) : ($member->ppfirst.' '.$member->pplast) ?></td>
                                            <td class=""><?php echo ($member->state) ?></td>
                                            <td class=""><?php echo ($member->lga) ?></td>
                                            <td class=""><?php echo ($member->email) ?></td>
                                            <td class=""><?php echo ($member->phone) ?></td>
                                            <td class=""><?php echo format_date($member->date_added) ?></td>
                                            <td class="actions">
                                                <?php if ($member->iddd != 8 && $this->current_user->group_id != 4 && $this->current_user->group_id != 9) echo anchor('admin/programs/editemail/' . $member->iddd, 'Edit Facility', array('class' => 'btn btn-info')) ?>
                                                 <?php if (true) echo anchor('admin/programs/mydatafac/' . $member->iddd, 'View Screened Data', array('class' => 'btn btn-success')) ?>
                                                <?php
                                                if ($member->iddd != 8 && $this->current_user->group_id != 4) {
                                                    echo ($member->statuss == 1 ) ? anchor('admin/programs/dactivate/' . $member->iddd, 'Deactivate', array('class' => 'btn btn-warning')) : anchor('admin/programs/factivate/' . $member->iddd, 'Activate', array('class' => 'btn btn-primary'));
                                                }
                                                ?>
        <?php if ($member->iddd == 8 || $this->current_user->group_id == 4 || $this->current_user->group_id == 7 || $this->current_user->group_id == 3  || $this->current_user->group_id == 1) echo anchor('admin/programs/deleten/facility/' . $member->iddd, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete')) ?>
                                            </td>
                                        </tr>
    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<?php endif ?>
        </div>


<?php echo form_close() ?>
    </div>
</section>


<script>
    $(document).ready(function () {
        $('#example').dataTable({
            "iDisplayLength": 10;
        });
    });
</script>