<?php
$customer = $this->getTableRow();
$getCustomerGroupOptions = $this->getCustomerGroupOptions();
?>
<div class="container">

    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl('save', 'customer', null, true); ?>">
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="firstName" class="form-label"><b>First Name</b></label>
                <input type="text" class="form-control" name="customer[firstName]" id="firstName" placeholder="First Name" value="<?php echo $customer->firstName; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="lastName" class="form-label"><b>Last Name</b></label>
                <input type="text" class="form-control" name="customer[lastName]" id="lastName" placeholder="lastName" value="<?php echo $customer->lastName; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 m-3">
                <label for="email" class="form-label"><b>Email</b></label>
                <input type="email" class="form-control" name="customer[email]" id="email" placeholder="email" value="<?php echo $customer->email; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="password" class="form-label"><b>Password</b></label>
                <input type="password" class="form-control" name="customer[password]" id="password" placeholder="password" value="<?php echo $customer->password; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 m-3">
                <label for="customerGroup" class="form-label"><b>Customer Group</b></label>
                <select class="form-select" name="customer[customerGroupId]">
                    <?php foreach ($getCustomerGroupOptions as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($customer->customerGroupId == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-5 m-3">
                <label for="status" class="form-label"><b>Status</b></label>
                <select class="custom-select form-control" name="customer[status]">
                    <?php foreach ($customer->getStatusOptions() as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($customer->status == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="mobile" class="form-label"><b>Mobile No.</b></label>
                <input type="number" class="form-control" name="customer[mobile]" id="mobile" placeholder="mobile" value="<?php echo $customer->mobile; ?>">
            </div>
        </div>
        <input type="text" name="customer[updatedDate]" value="<?php date_default_timezone_set("Asia/Kolkata");
                                                                echo date('Y-m-d H:i:s') ?>" hidden>
        <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary m-3"><i class="fas fa-plus"></i> <?php echo $this->getButton(); ?></button>
    </form>
</div>