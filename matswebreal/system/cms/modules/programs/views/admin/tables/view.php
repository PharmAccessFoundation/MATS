<?php if (!empty($member)): ?>
	<table border="0" class="table-list" cellpadding="0" cellspacing="0">
		<thead>
                    <tr>
                        <th>Questions</th>
                        <th>Answers</th>
                    </tr>
		</thead>
		
		<tbody>
                    <tr>
				<td class="collapse">Date</td>
					<td class="collapse"><?php echo format_date($member->date_uploaded) ?></td>
                        </tr><tr>
				<td>Name</td>
                                <td><?php echo $member->firstname ?></td>
                                </tr><tr>
				<td class="collapse">Mobile</td>
                                <td class="collapse"><?php echo ($member->mobile) ?></td>
                                </tr><tr>
				<td>Hub Facility</td>
                                <td class="collapse"><?php echo ($member->name) ?></td>
                                </tr><tr>
				<td class="collapse">Respondent</td>
					<td><?php 
                                        if($member->respondent == 1) echo 'Self';
                                        if($member->respondent == 2) echo 'Dependent Adult';
                                        if($member->respondent == 3) echo 'Child';
                                        ?></td>
                                </tr><tr>
				<td class="collapse">Status</td>
                                        <td class="collapse"><?php echo ucfirst($member->status) ?></td>
                                </tr><tr>
                                <td>Coughing?</td>
                                <td><?php 
                                if($member->cough == 1) echo 'Yes';
                                        if($member->cough == 2) echo 'No';
                                        if($member->cough == 0) echo 'Nil';
                                        ?>
                                </td>
                                </tr><tr>
                                <td>Cough More Than 2 Weeks?</td>
                                <td><?php 
                                if($member->more == 1) echo 'Yes';
                                        if($member->more == 2) echo 'No';
                                        if($member->more == 0) echo 'Nil';
                                        ?>
                                </td>
                                </tr><tr>
                                <td>Adequate Growth? </td>
                                <td><?php 
                                if($member->growth == 1) echo 'Yes';
                                        if($member->growth == 2) echo 'No';
                                        if($member->growth == 0) echo 'Nil';
                                        ?>
                                </td>
                                </tr><tr>
                                    <td>More Details</td>
                                    <td>
                                        <td><?php 
                               echo ($member->details);
                                        ?>
                                </td>
                                    </td>
                                </tr>
			
		</tbody>
	</table>
<?php endif ?>