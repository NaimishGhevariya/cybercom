<!DOCTYPE html>
<html>
<?php echo $this->getBlock('Block\Customer\Layout\Head')->toHtml(); ?>

<body>
    <?php echo $this->getChild('header')->toHtml(); ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <?php echo $this->getBlock('Block\Customer\Layout\Message')->toHtml(); ?>
                <?php echo $this->getChild('content')->toHtml(); ?>
            </div>
        </div>
    </div>
    <?php echo $this->getChild('footer')->toHtml(); ?>
</body>

</html>