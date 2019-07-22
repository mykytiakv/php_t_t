<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $action_title; ?> user</li>
        </ol>
    </nav>
    <div class="row">
        <div class="mb-3 col-sm-6 offset-sm-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4><?php echo $title; ?></h4>
                </div>
                <div class="card-body">
                    <form action="/user/<?php if(!isset($id)) { ?>create<?php } else { ?>edit/<?php echo $id; } ?>" method="post" class="mb-2">

                        <?php if (isset($id)) { ?>
                            <input name="id" value="<?php echo $id; ?>" hidden>
                        <?php }; ?>

                        <div class="form-group">
                            <label>User name:</label>
                            <input class="form-control" type="text" name="name"
                                   value="<?php echo $name; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Email address:</label>
                            <input class="form-control" type="email" name="email"
                                   value="<?php echo $email; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" name="country_id">
                                <option value="" <?php if ($country_id === '' or $country_id === null) { ?> selected <?php }; ?>> - </option>

                                <?php foreach ($countries as $country) { ?>

                                    <option value="<?php echo $country->id; ?>"
                                        <?php if ($country_id === $country->id){ ?> selected <?php }; ?>>
                                        <?php echo $country->country; ?>
                                    </option>

                                <?php }; ?>

                            </select>
                        </div>

                        <div class="align-items-baseline d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary btn-block mr-1 ml-1">
                                <i class="fas fa-user-<?php echo (!$id) ? 'plus' : 'edit' ?>"></i> <?php echo $action_title; ?>
                            </button>

                            <?php if (isset($id)) { ?>
                                <a class="btn btn-danger btn-block mr-1 ml-1 remove"
                                   href="/user/delete/<?php echo $id; ?>"
                                   data-name="<?php echo $name; ?>"
                                   data-toggle="modal" data-target="#removeModal">
                                    <i class="fas fa-user-times"></i> Delete
                                </a>
                            <?php } ?>

                        </div>

                    </form>
                    <?php if ($message) { ?>
                        <div class="alert text-center alert-<?php echo ($message['status'] === 'success') ? 'success' : 'danger' ?>">
                            <?php echo $message['message']; ?>
                        </div>
                    <?php }; ?>
                </div>
            </div>
        </div>
    </div>
</div>