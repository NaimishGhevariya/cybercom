<?php
$result = $this->getCmsPages();
?>


<div class="container">
	<h2 class="my-4">
		<?php echo $this->getTitle(); ?>
		<a class="btn btn-primary float-end" href="<?php echo $this->getUrlObject()->getUrl('form', null, NULL, TRUE); ?>"><i class="fas fa-plus"></i> Add</a>
	</h2>
	<hr>
	<h4><?php if (!$result) {
			echo "No Record Found";
			die();
		} ?></h4>

	<table class="table table-striped table-inverse table-responsive">
		<thead class="thead-inverse">
			<tr>
				<th>Id</th>
				<th>CMS Page Title</th>
				<th>CMS Page Identifier</th>
				<th>CMS Page Content</th>
				<th>CMS Page Status</th>
				<th>Created Date</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<strong>
				<?php
				foreach ($result as $row) {
				?> </strong>
			<tr>
				<td><?php echo $row->pageId  ?></td>
				<td><?php echo $row->title ?></td>
				<td><?php echo $row->identifier ?></td>
				<td><?php echo $row->content ?></td>
				<td><?php
					if ($row->status)
						echo "Enable";
					else
						echo "Disable";
					?>
				<td><?php echo $row->createdDate ?></td>
				</td>
				<td><a href="<?php echo $this->getUrl('form', NULL, ['id' => "$row->pageId"], TRUE); ?>"><i class="fas fa-pencil" aria-hidden="true"></i></a></td>
				<td><a href="<?php echo $this->getUrl('delete', NULL, ['id' => "$row->pageId"], TRUE); ?>"><i class="fas fa-trash-alt" aria-hidden="true" style="color: tomato;"></i></a></td>
			</tr>

		<?php
				}
		?>
		</tbody>
	</table>
</div>