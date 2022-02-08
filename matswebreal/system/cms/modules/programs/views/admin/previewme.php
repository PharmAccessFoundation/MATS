
<section class="item">
        <div class="content">
            <div id="filter-stage">
            <?php if (!empty($user)): ?>
                 <div class="table-responsive">
                                <table class="table table-striped">
                <tr>
                    <th>User Parameters</th>
                    <th>Values</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo $user->display_name ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $user->email ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?php echo ($user->mobile) ? $user->mobile : $user->phone ?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><?php echo $user->username ?></td>
                </tr>
                <tr>
                    <td>Group</td>
                    <td><?php echo $user->group_description ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><?php echo $user->state ?></td>
                </tr>
                <tr>
                    <td>Manager</td>
                    <td><?php echo (trim($user->manager) == '') ? "NO" : "YES" ?></td>
                </tr>
                <tr>
                    <td>Organization</td>
                    <td><?php echo $user->organization ?></td>
                </tr>
            </table>
        </div>

<?php endif; ?>
    </div>
</div>
    </section>
