<section class="title">
    Assigned Spoke Facilities
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
                            <span class="input-group-addon">Hub Facility</span>
                            <select name="hub" id="hub" class="form-control">
                                <option selected="selected" value='all'>All</option>
                                <?php
                                foreach ($hubs as $v) {
                                    echo "<option value='$v->id'>$v->name</option>";
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
            </div>
        </div>
        
        
        <?php echo form_open('admin/users/action') ?>

        <?php if (!empty($users)): ?>
            <div class="panel panel-default" style="margin: 10px;">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-examplee" id="dataTables-examplee">
                            <thead>
                                <tr>
                                    <th width="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?></th>
                                    <th>Spoke</th>
                                    <th class="">Mobile</th>
                                    <th>Hub Facility</th>
                                    <th class="">Email</th>
                                    <th class="">Registered Date</th>
                                    <th width="">Actions</th>
                                  <?php
                                                if ($this->current_user->group_id != 11 && $this->current_user->group_id != 222 &&  $this->current_user->group_id != 666  &&  $this->current_user->group_id != 18 &&  $this->current_user->group_id != 13):  if ($this->current_user->group_id != 4 && $this->current_user->group_id != 5): ?>
                                    <th width="">Actions</th>
                                    <?php 
                                            if ($this->current_user->group_id != 4 && $this->current_user->group_id != 5 && $this->current_user->group_id != 8) { ?>
                                    <th width="">Actions</th>
                                            <?php } if($this->current_user->group_id != 12 &&  $this->current_user->group_id != 16) {?>
                                    
                                    <th width="">Actions</th>
                                    
                                    <?php 
                                            }
                                                endif;
                                                endif; 
                                                ?>
                                </tr>
                            </thead>
                            <tfoot>
                                    <tr>
                                        <td colspan="9">
                                            <div class="inner"><?php //$this->load->view('admin/partials/pagination')  ?></div>
                                        </td>
                                    </tr>
                                </tfoot>
                            <tbody>
                                <?php $link_profiles = Settings::get('enable_profiles'); 
                                $ii = 0; ?>
                                <?php  
                                foreach ($users as $member):
                                ?>
                                    <tr>
                                        <td class="align-center"><?php echo form_checkbox('action_to[]', $member->sid) ?></td>
                                        <td>
                                            <?php echo str_replace('.', "", $member->fullname);?>
                                        </td>
                                        <td class=""><?php echo ($member->phone) ?></td>
                                        <td class=""><?php echo ($member->name) ?></td>

                                        <td class=""><?php echo $member->lemail ?></td>
                                        <td class=""><?php echo $member->reg_date ?></td>
                                            <?php echo ($member->facility_id == 8) ? "<td class=''><a href='admin/survey/assign/$member->sid' class = 'btn btn-info' >Assign Hub Facility</a></td>" : "" ?>
                                            
                                                <?php
                                                 echo '<td class="">';
                                                    echo anchor('admin/survey/mydata/' . $member->sid, 'View Screened Data', array('class' => 'btn btn-success'));
                                                 echo '</td>';
                                                 ?>
                                            </td>
                                                <?php
                                                if ($this->current_user->group_id != 11 && $this->current_user->group_id != 222 &&  $this->current_user->group_id != 13 &&  $this->current_user->group_id != 666 &&  $this->current_user->group_id != 18) {
                                            if ($this->current_user->group_id != 4 && $this->current_user->group_id != 5 && $this->current_user->group_id != 8) {
                                        echo '<td class="">';
                                                echo anchor('admin/survey/reassign/' . $member->sid, 'Re-Assign', array('class' => 'btn btn-info'));
                                                echo '</td>';
                                            }
                                            ?>
                                            
                                                <?php
												
                                                if ($this->current_user->group_id != 4 && $this->current_user->group_id != 5 && $this->current_user->group_id != 12 && $this->current_user->group_id != 16) {
                                                     echo '<td class="actions">';
                                            echo ($member->statusi == 0) ? "<a href='index.php/admin/survey/uapprove/$member->sid' class = 'btn btn-primary' >Activate User</a>" : "<a href='index.php/admin/survey/udapprove/$member->sid' class = 'btn btn-warning' >Deactivate User</a>";
                                    echo '</td>';
                                                }elseif($this->current_user->group_id != 5){
                                                     echo '<td class="actions">';
                                            echo ($member->statusi == 0) ? "<a href='index.php/admin/survey/locuapprove/$member->sid' class = 'btn btn-primary' >Activate User</a>" : "<a href='index.php/admin/survey/locudapprove/$member->sid' class = 'btn btn-warning' >Deactivate User</a>";
                                    echo '</td>';
                                                }
                                                
                                                    ?>
                                    <?php
                                    if ($this->current_user->group_id != 4 && $this->current_user->group_id != 5 && $this->current_user->group_id != 12 && $this->current_user->group_id != 16) {
                                        echo '<td class="">';
                                    echo anchor('admin/survey/deleten/users/' . $member->sid, lang('global:delete'), array('class' => 'btn btn-danger confirm button delete'));
                                    echo '</td>';
                                    }
                                                }
                                    ?>
                                    </tr>
    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div></div></div>
            <?php endif ?>
        <div class="table_action_buttons">
        <?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') ))  ?>
        </div>

<?php echo form_close() ?>
    </div>
</section>


<script>
      
    $(document).ready(function () {
        $('.dataTables-examplee').dataTable({
            paging: true,
            dom: 'Bfrtip',
            buttons: [
               'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
    });
</script>
