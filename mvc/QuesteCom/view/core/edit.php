<table class="one-column-layout-edit" cellspacing="0" cellpadding="0">
    <tr>
        <td class="one-column-layout-left-tab"><?php echo $this->getTabHtml(); ?></td>
        <td class="one-column-layout-left-tab-content">
            <form action="<?php $this->getFormUrl(); ?>" enctype="multipart/form-data"></form>
            <h2 class="m-4"><?php $this->getTitle(); ?></h2>
            <hr>
            <?php echo $this->getTabContent()->toHtml(); ?>
        </td>
    </tr>
</table>