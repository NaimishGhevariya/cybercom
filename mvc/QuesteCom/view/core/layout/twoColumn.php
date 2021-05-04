<!DOCTYPE html>
<html>

<body>

    <table cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="3">
                <?php echo $this->getChild('header')->toHtml();  ?>
            </td>
        </tr>
        <tr>
            <td class="align-top" width="20%"> <?php echo $this->getChild('left')->toHtml(); ?></td>
            <td width="80%">
                <?php echo $this->getChild('message')->toHtml(); ?>
                <?php echo $this->getChild('content')->toHtml(); ?>

            </td>
        <tr>
            <td colspan="3"> <?php echo $this->getChild('footer')->toHtml(); ?> </td>
        </tr>

    </table>

</body>

</html>