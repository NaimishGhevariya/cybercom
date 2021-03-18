<!DOCTYPE html>
<html>

<head>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo  $this->baseUrl('Skin/Admin/Js/jQuery.js') ?> "> </script>
    <script type="text/javascript" src="<?php echo  $this->baseUrl('Skin/Admin/Js/mage.js') ?> "> </script>
</head>

<body>

    <table border="0" width="100%" cellspacing=0 cellpadding=0>
        <tbody>
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
                <!-- <td width="35%"> </td> -->
            <tr>
                <td colspan="3"> <?php echo $this->getChild('footer')->toHtml(); ?> </td>
            </tr>
        </tbody>
    </table>

</body>

</html>