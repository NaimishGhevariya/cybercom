<?php
$category = $this->getTableRow();
$categoryOptions = $this->getCategoryOptions();
?>
<div class="container">

    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl('save', null, null, true); ?>">
        <div class="row">
            <div class="col-md-5 m-3">
                <label class="form-label"><b>Parent Category</b></label>
                <select class="select form-control" name="category[parentId]">
                    <?php if ($categoryOptions) : ?>
                        <?php foreach ($categoryOptions as $id => $categoryName) : ?>
                            <option class="form-control" value="<?php echo $id; ?>" <?php if ($category->parentId == $id) echo "selected"; ?>> <?php echo $categoryName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-5 m-3">
                <label for="name" class="form-label"><b>Name</b></label>
                <input type="text" class="form-control" name="category[name]" id="name" placeholder="CategoryName" value="<?php echo $category->name; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="description" class="form-label"><b>Description</b></label>
                <input type="text" class="form-control" name="category[description]" id="description" placeholder="Description" value="<?php echo $category->description; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="name" class="form-label"><b>Status</b></label>
                <select class="custom-select form-control" name="category[status]">
                    <?php
                    foreach ($category->getStatusOptions() as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($category->status == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="featured" class="form-label"><b>Category featured</b></label>
                <select class="custom-select form-control" name="category[featured]" id='featured'>
                    <?php
                    foreach ($category->getFeaturedOptions() as $key => $value) : ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($category->featured == $key) : echo "selected";
                                                                                    endif; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5 m-3">
            </div>
        </div>
        <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary my-4"><i class="fas fa-plus"></i> <?php echo $this->getButton(); ?></button>
        <br><br>
    </form>
</div>