<?php $tabs = $this->getTabs(); ?>
<?php $id = $this->getRequest()->getGet('id'); ?>

<?php foreach ($tabs as $key => $tab) : ?>
    <a class="btn btn-primary m-4 mb-0" href="<?php echo $this->getUrlObject()->getUrl(null, null, ['tab' => $key, 'id' => $id], true); ?>">
        <?php echo $tab['label']; ?>
    </a>
<?php endforeach; ?>