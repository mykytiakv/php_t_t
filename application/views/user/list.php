<div class="container">

    <h2 class="text-center mb-3">List of users</h2>

    <div class="table-responsive">
        <div class="text-right">
            <a class="btn btn-primary mb-2" href="/user/create"><i class="fas fa-user-plus"></i> Add</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php if (!$users) { ?>
                <tr>
                    <td colspan="5" class="text-center">No user created</td>
                </tr>
            <?php } ?>

            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo ($user->country) ? $user->country : '-' ; ?></td>
                    <td>
                        <a class="btn btn-primary" href="/user/edit/<?php echo $user->id; ?>">
                            <i class="fas fa-user-edit"></i> Edit
                        </a>
                        <a class="btn btn-danger remove" data-toggle="modal" data-target="#removeModal"
                           data-name="<?php echo $user->name; ?>" href="/user/delete/<?php echo $user->id; ?>">
                            <i class="fas fa-user-times"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>
