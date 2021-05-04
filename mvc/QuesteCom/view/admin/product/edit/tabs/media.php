<?php
$media = $this->getMedia()->getData();
$id = $this->getRequest()->getGet('id');
if ($media) {
    $id = $media[0]->productId;
}
?>

<div class="container">
    <form method="POST" enctype="multipart/form-data" action="<?php echo $this->getUrlObject()->getUrl('update', 'productMedia', ['id' => $id], TRUE); ?>">
        <div class="my-4">
            <div class="col-md-8 float-start">
                <input type="file" class="form-control" name="image">
            </div>
            <div class="col-md-4 float-end">
                <button class="btn btn-primary float-end" type="submit" formaction="<?php echo $this->getUrlObject()->getUrl('save', 'productMedia', ['id' => $id]); ?>"><i class="fas fa-upload"></i> Upload</button>
            </div>
        </div>

        <button class="btn btn-primary float-end mt-3 ms-3" type="submit" formaction="<?php echo $this->getUrlObject()->getUrl('update', 'productMedia', ['id' => $id]); ?>"><i class="fas fa-pencil-alt"></i> Update</button>
        <button class="btn btn-primary float-end mt-3 ms-3" type="submit" formaction="<?php echo $this->getUrlObject()->getUrl('delete', 'productMedia',  ['id' => $id]); ?>"><i class="fas fa-trash-alt"></i> Remove</button>

        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Label</th>
                    <th>Small</th>
                    <th>Thumb</th>
                    <th>Base</th>
                    <th>Gallery</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <h3><?php if (!$media) : echo "No Record Found";  ?></h3>
            <?php else : ?>
                <?php foreach ($media as $key => $value) : ?>
                    <tr>
                        <th>
                            <div class="img"><img src="Uploads\Admin\Product\<?php echo $value->image ?>" height="100" width="100" class="preview rounded"></div>
                        </th>
                        <th><input type="text" class="form-control" name="img[data][<?php echo $value->id ?>][label]" value="<?php echo $value->label ?>"></th>
                        <th><input type="radio" class="form-check-input" name="img[small]" value="<?php echo $value->id ?>" <?php echo $value->small ? "checked" : "" ?>></th>
                        <th><input type="radio" class="form-check-input" name="img[thumb]" value="<?php echo $value->id ?>" <?php echo $value->thumb ? "checked" : "" ?>></th>
                        <th><input type="radio" class="form-check-input" name="img[base]" value="<?php echo $value->id ?>" <?php echo $value->base ? "checked" : "" ?>></th>
                        <th><input type="checkbox" class="form-check-input" name="img[data][<?php echo $value->id ?>][gallery]" value="1" <?php echo $value->gallery ? "checked" : "" ?>></th>
                        <th><input type="checkbox" class="form-check-input" name="img[data][<?php echo $value->id ?>][remove]" value="<?php echo $value->id ?>"></th>
                    </tr>
                <?php endforeach; ?>

            <?php endif;  ?>
            </tbody>
        </table>
    </form>
    <a href="<?php echo $this->getUrlObject()->getUrl('grid', 'product'); ?>" name="back" id="back" class="btn btn-light my-4"><i class="fas fa-long-arrow-alt-left"></i> Back</a>

</div>