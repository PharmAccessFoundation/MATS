
<section class="title">
    <strong>Manage Account For <?php echo @$asfacs[0]->plast.' '.@$asfacs[0]->pfirst; ?></strong>
</section>

<section class="item">
    <div class="content">

        <?php echo form_open(current_url()) ?>

        <div id="filter-stage">
            <?php  if (!empty($asfacs)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <strong>Assigned Hub Facilities</strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover example" id="example" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th class="">Hub Facility</th>
                                        <th class="">Manager</th>
                                        <th>Linkage Coordinator</th>
                                        <th class="">Hub Facility Email</th>
                                        <th class="">Hub Facility Phone</th>
                                        <th class="">Status</th>
                                        <th class="">Actions</th>
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
                                    <?php foreach ($asfacs as $member): ?>
                                        <tr>
                                            <td class=""><?php echo form_checkbox($member->fid, 1); echo form_hidden('avail', '1')?></td>
                                            <td class=""><?php echo ($member->name) ?></td>
                                            <td class=""><?php echo ($member->mlast.' '.$member->mfirst) ?></td>
                                            <td class=""><?php echo ($member->plast.' '.$member->pfirst) ?></td>
                                            <td class=""><?php echo ($member->email) ?></td>
                                            <td class=""><?php echo ($member->phone) ?></td>
                                            <td class=""><?php echo ($member->statuss == 1) ? 'Active' : 'Not Active' ?></td>
                                            
                                            <td class=""><?php echo anchor('admin/programs/registered/' . $member->faid, 'View Spokes', array('class' => 'btn btn-success'));  ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <div class="form_controls" style="float: left; padding-top: 20px;">
                        <?php echo form_submit('submit', 'Remove Selected', 'class="btn btn-danger"') ?>
                    </div>
                    </div>
                </div>
            <?php else: ?>
            <div style="text-align: center; font-weight: bold; color: #990000; padding: 15px;">No Assigned Facility Yet To This Linkage Coordinator!</div>
            <?php endif ?>
            
        </div>


        <?php echo form_close() ?>
    </div>
</section>


<section class="item">
    <div class="content">
        <?php echo form_open(current_url()) ?>
        <div id="filter-stage">
            <?php if (!empty($avfacs)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    <div class="panel-heading">
                        <strong>Available Facilities</strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover example" id="example" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Hub Facility Name</th>
                                        <th class="">State</th>
                                        <th class="">LGA</th>
                                        <th class="">Email</th>
                                        <th class="">Phone</th>
                                        <th class="">Date Created</th>
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
                                    <?php foreach ($avfacs as $member): ?>
                                        <tr>
                                            <td class=""><?php echo form_checkbox($member->id, 1); echo form_hidden('ass', '1')?></td>
                                            <td class=""><?php echo ($member->name) ?></td>
                                            <td class=""><?php echo ($member->state) ?></td>
                                            <td class=""><?php echo ($member->lga) ?></td>
                                            <td class=""><?php echo ($member->email) ?></td>
                                            <td class=""><?php echo ($member->phone) ?></td>
                                            <td class=""><?php echo format_date($member->date_added) ?></td>

                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <div class="form_controls" style="float: left; padding-top: 20px;">
                        <?php echo form_submit('submit', 'Assign Selected', 'class="btn btn-success"') ?>
                    </div>
                    </div> 
                </div> 
                    <?php else: ?>
            <div style="text-align: center; font-weight: bold; color: #990000; padding: 15px;">No Available Facility For This Programme!</div>
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