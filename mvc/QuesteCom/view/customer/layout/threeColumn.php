<!DOCTYPE html>
<html>

<?php echo $this->getChild('head')->toHtml();  ?>

<body>

	<table border="0" width="100%" cellspacing=0 cellpadding=0>
		<tbody>
			<tr>
				<td colspan="3">
					<?php echo $this->getChild('header')->toHtml();  ?>
				</td>
			</tr>
			<tr>
				<td class="align-top" width="10%"> <?php echo $this->getChild('left')->toHtml(); ?></td>
				<td width="80%">
					<?php echo $this->getChild('message')->toHtml(); ?>
					<?php echo $this->getChild('content')->toHtml(); ?>
				</td>
				<td width="10%"> </td>
			<tr>
				<td colspan="3"> <?php echo $this->getChild('footer')->toHtml(); ?> </td>
			</tr>
		</tbody>
	</table>

</body>

</html>