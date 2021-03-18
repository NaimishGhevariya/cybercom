<?php
$customerGroup = $this->getTableRow();

?>
<div class="container">

    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl("save", null, null, true); ?>">

        <div class="row">
            <div class="col-md-5 m-3">
                <label for="name" class="form-label"><b>Name</b></label>
                <input type="text" class="form-control" name="customerGroup[name]" id="sku" placeholder="name" value="<?php echo $customerGroup->name; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="status" class="form-label"><b>Status</b></label>
                <select class="custom-select form-control" name="customerGroup[status]">
                    <?php
                    foreach ($customerGroup->getStatusOptions() as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($customerGroup->status == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary m-3"><i class="fas fa-plus"></i> <?php echo $this->getButton(); ?></button>
    </form>
</div>