

<?php

	function warningMessage($id, $titel, $body, $confirmName){
		echo '<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<h4 class="modal-title" id="'.$id.'">'.$titel.'</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">'.$body.'</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
						<button type="button" class="btn btn-primary">'.$confirmName.'</button>
					</div>

				</div>
			</div>
		</div>';
	}
?>
