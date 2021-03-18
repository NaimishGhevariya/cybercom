<?php
$cmsPage = $this->getTableRow();
?>
<div class="container">

    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl("save", 'cms', ['id', $cmsPage->pageId], true); ?>">
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="title" class="form-label"><b>Title</b></label>
                <input type="text" class="form-control" name="cms[title]" id="title" placeholder="CMS Page title" value="<?php echo $cmsPage->title; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="identifier" class="form-label"><b>Identifier</b></label>
                <input type="text" class="form-control" name="cms[identifier]" id="identifier" placeholder="CMS Page Identifier" value="<?php echo $cmsPage->identifier; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="title" class="form-label"><b>Title</b></label>
                <input type="text" class="form-control" name="cms[title]" id="title" placeholder="CMS Page title" value="<?php echo $cmsPage->title; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="status" class="form-label"><b>Status</b></label>
                <select class="custom-select form-control" name="cms[status]">
                    <?php
                    foreach ($cmsPage->getStatusOptions() as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($cmsPage->status == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 m-3">
                <label for="editor" class="form-label"><b>Content</b></label>
                <textarea id="editor" name="cms[content]"><?php echo $cmsPage->content; ?></textarea>
            </div>
        </div>

        <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary m-3"><i class="fas fa-plus"></i> <?php echo $this->getButton(); ?></button>

    </form>
</div>