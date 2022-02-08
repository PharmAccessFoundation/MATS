<?php ini_set("memory_limit","16M"); ?>
<script>
      
    $(document).ready(function () {
        $('.dataTables-examplee').dataTable({
            "paging": true,
            "dom": 'Bfrtip',
            "buttons": [
               'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 1, "asc" ]],
        });
    });
</script>
<section class="title">
    Hub Facility Details
</section>

<section class="item">
    <div class="content">
<div class="panel panel-default" style="margin: 10px;">
            <div class="panel-heading">
                
            </div>
            <div class="panel-body div_top_hypers" style="">
			
					<?php if($this->current_user->group_id != 4): ?>
                <fieldset id="filters">



                    <?php 
                $page = (int)$pagination["current_page"];
                echo form_open('') ?>
				
                    <ul style="list-style: none; display:  inline; " class="col-md-3 ul_top_hypers">
                        <li class="form-group input-group" style="float: left;">
                            <span class="input-group-addon">Linkage Co-ordinator</span>
                            <select name="hub" id="hub" class="form-control">
                                <option selected="selected" value='all'>All</option>
                                <?php
                                foreach ($hubs as $v) {
                                    echo "<option value='$v->user_id'>$v->first $v->last</option>";
                                }
                                ?>
                            </select>
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
				<?php endif; ?>
            </div>
        </div>
        

        <?php echo form_open('admin/users/action') ?>

        <div id="filter-stage">
            <?php if (!empty($facs)): ?>
                <div class="panel panel-default" style="margin: 10px;">
                    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover example2" id="example2" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th class="">S/N</th>
                                        <th>Hub Facility Name</th>
                                        <th>Linkage Coordinator</th>
                                        <th class="">Phone</th>
                                        <th class="">State</th>
                                        <th class="">LGA</th>
                                        <th class="">Email</th>
                                        <th class="">Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="9">
                                            <div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody><?php $link_profiles = Settings::get('enable_profiles') ?>
                                    <?php $i = 0;
                                    foreach ($facs as $member): ?>
                                    <tr class="odd gradeX" >
                                            <td >
        <?php echo ++$i + ($page * (int)$pagination["limit"]); ?>
                                            </td>
                                            <td class=""><?php echo ($member->name) ?></td>
                                            <td class=""><?php echo ($member->first.' '.$member->last) ?></td>
                                            <td class=""><?php echo ($member->phone) ?></td>
                                            <td class=""><?php echo ($member->stat) ?></td>
                                            <td class=""><?php echo ($member->lga) ?></td>
                                            <td class=""><?php echo ($member->email) ?></td>
                                            <td class=""><?php echo format_date($member->date_added) ?></td>
                                            <td class="actions">
                                                <?php echo 
                                                anchor('admin/survey/mydatafac/' . $member->fid, 'View Screened Data', array('class' => 'btn btn-success')); ?>
                                                <?php 
                                                if ($this->current_user->group_id != 11 &&  $this->current_user->group_id != 13 ):
                                                    
                                                 if ($member->id != 8 && $this->current_user->group_id != 4 && $this->current_user->group_id != 12 && $this->current_user->group_id != 16) echo anchor('admin/survey/editemail/' . $member->fid, 'Edit Facility Details', array('class' => 'btn btn-info'))//.'<br><br>' ?>
                                                <?php
                                                
                                                if ($member->id != 8 && $this->current_user->group_id != 5 && $this->current_user->group_id != 4) {
                                                    echo ($member->statuss == 1 ) ? anchor('admin/survey/dactivate/' . $member->fid, 'Deactivate', array('class' => 'confirm btn btn-warning')) : anchor('admin/survey/factivate/' . $member->fid, 'Activate', array('class' => 'confirm btn btn-primary'));
                                                
                                                    //echo '<br>';echo '<br>';
                                                }
                                                
                                                ?>
        <?php if ($member->id != 8 && $this->current_user->group_id != 4 && $this->current_user->group_id != 5 && $this->current_user->group_id != 12 && $this->current_user->group_id != 16) echo anchor('admin/survey/deleten/facility/' . $member->fid, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));                                                
        endif; ?>
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

         <script>
                 $(document).ready(function () {
        $('.example2').dataTable({
            paging: false,
            dom: 'Bfrtip',
            buttons: [
               'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    </script>
        </div>
    
<?php echo form_close() ?>
    </div>
</section>


