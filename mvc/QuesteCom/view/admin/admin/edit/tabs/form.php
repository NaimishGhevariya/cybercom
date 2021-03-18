<?php
$admin = $this->getTableRow();
?>
<div class="container">

    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl("save", null, null, true); ?>">
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="username" class="form-label"><b>Username</b></label>
                <input type="text" class="form-control" name="admin[username]" id="username" placeholder="UserName" value="<?php echo $admin->username; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="emailId" class="form-label"><b>Email Id</b></label>
                <input type="text" class="form-control" name="admin[emailId]" id="emailId" placeholder="Email Id" value="<?php echo $admin->emailId; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="password" class="form-label"><b>Password</b></label>
                <input type="text" class="form-control" name="admin[password]" id="password" placeholder="Password" value="<?php echo $admin->password; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="status" class="form-label"><b>Status</b></label>
                <select class="custom-select form-control" name="admin[status]" id="status">
                    <?php
                    foreach ($admin->getStatusOptions() as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($admin->status == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <a type='button' href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button type='submit' name="submit" id="submit" class="btn btn-primary m-3"><i class="fas fa-plus"></i> <?php echo $this->getButton(); ?></button>
    </form>
</div>