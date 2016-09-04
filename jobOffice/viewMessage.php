<?php
	if($msgID!=""){

		$sql = mysqli_query($conn,"SELECT * FROM messages WHERE ID='$msgID'");
		$roww = mysqli_fetch_assoc($sql);

		echo "<div class='read-message-display'><div class='read-message-header'>From : <b>" .$roww['fr']. "</b></div><div id='reply' class='reply-button'>Reply</div><br>
					<div class='message'>"
						.$roww['content'].
					"</div>
				</div>";
	}
?>