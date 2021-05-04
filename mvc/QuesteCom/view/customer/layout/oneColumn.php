<!DOCTYPE html>
<html>

<?php echo $this->getChild('head')->toHtml();  ?>

<body>
	<table class="one-column-layout" cellspacing="0" cellpadding="0">
		<tr>
			<td class="one-column-layout-header sticky-top" colspan="2"><?php echo $this->getChild('header')->toHtml();  ?></td>
		</tr>
		<tr>
			<td class="one-column-layout-message"><?php echo $this->getChild('message')->toHtml();  ?></td>
			<td class="one-column-layout-content"><?php echo $this->getChild('content')->toHtml();  ?></td>
		</tr>
		<tr>
			<td class="one-column-layout-footer" colspan="2"><?php echo $this->getChild('footer')->toHtml(); ?> </td>
		</tr>
	</table>
</body>

</html>