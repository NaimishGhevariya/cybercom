<?php
$attribute = $this->getTableRow();
$BackendTypeOptions = $this->getBackendTypeOptions();
$inputTypeOptions = $this->getinputTypeOptions();
$entityTypeOptions = $this->getEntityTypeOptions();
?>
<div class="container">

    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl('save', null, null, true); ?>">
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="entityTypeId" class="form-label"><b>Entity Type</b></label>
                <select class="custom-select form-control" name="attribute[entityTypeId]" id='entityTypeId'>
                    <?php foreach ($entityTypeOptions as $key => $value) : ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($attribute->entityTypeId == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5 m-3">
                <label for="name" class="form-label"><b>Name</b></label>
                <input type="text" class="form-control" name="attribute[name]" id="name" placeholder="Attribute Name" value="<?php echo $attribute->name; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="code" class="form-label"><b>Code</b></label>
                <input type="text" class="form-control" name="attribute[code]" id="code" placeholder="Code" value="<?php echo $attribute->code; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="inputType" class="form-label"><b>inputTypeOptions</b></label>
                <select class="custom-select form-control" name="attribute[inputType]" id='inputType'>
                    <?php foreach ($inputTypeOptions as $key => $value) : ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($attribute->inputType == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="backendType" class="form-label"><b>backendType</b></label>
                <select class="custom-select form-control" name="attribute[backendType]" id='backendType'>
                    <?php
                    foreach ($BackendTypeOptions as $key => $value) : ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($attribute->backendType == $key) : echo "selected";
                                                                                    endif; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5 m-3">
                <label for="backendModel" class="form-label"><b>Backend Model</b></label>
                <input type="text" class="form-control" name="attribute[backendModel]" id="backendModel" placeholder="backendModel" value="<?php echo $attribute->backendModel; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="sortOrder" class="form-label"><b>Sort Order</b></label>
                <input type="text" class="form-control" name="attribute[sortOrder]" id="sortOrder" placeholder="sortOrder" value="<?php echo $attribute->sortOrder; ?>">
            </div>
        </div>
        <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary my-4"><i class="fas fa-plus"></i> <?php echo $this->getButton(); ?></button>
        <br><br>
    </form>
</div>