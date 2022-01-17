<?php require_once('common/env.php'); ?>

<!DOCTYPE html>
<html>
<head> <?php require_once('common/head.php'); ?></head>

	<body class="container-fluid" onLoad="reloadIFrame()" style="padding:10px">
		<div class="col-lg-2">
			<form autocomplete="off" action="sendRequest.php">
			  <fieldset>
				  <legend>Delete message</legend>
				  
						<input type="text" name="message_id">
						<label for="group">Group</label>
						<input id="group" name="group" type="checkbox" checked style="vertical-align: middle;"><br>
						<div class="col-lg-6"><?= create_groups('send')?></div>
						<br>	
				  <input type="hidden" name="DELETE_MESSAGE" value="true">
				  <input type="submit" value="Submit">
				</fieldset>
			</form>

			<form autocomplete="off" action="sendRequest.php">
			  <fieldset>
				  <legend>Repeat message</legend>
						<input type="text" name="text" placeholder="text">
							<label for="count">Count:</label>
							<input id="count" type="number" name="count" style="width:35px">
						
						<br>
						<input type="text" name="reply_to_message_id" placeholder="MID"><br>
						<div class="col-lg-6"><?= create_groups('send')?></div>
						<br>
				  
				  <input type="hidden" name="REPEAT_MESSAGE" value="true">
				  <input type="submit" value="Submit">
				</fieldset>
			</form>
					
			<form autocomplete="off" action="sendRequest.php">
				<fieldset>
				  <legend>Send to admins</legend>
						<input type="text" name="text" placeholder="text">				
						<br>
						<div class="col-lg-6"><?= create_groups('send')?></div>
						<br>
				  
				  <input type="hidden" name="SEND_MESSAGE_TO_ADMINISTRATOR" value="true">
				  <input type="submit" value="Submit">
				</fieldset>
			</form>
	</div>
	
	<div class="col-lg-10">
		<form action="sendRequest.php" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Send message</legend>
								
					
					<div class="col-lg-12">
						<textarea name="text" placeholder="message" rows="3" cols="40" ></textarea>
					</div>
					<div class="col-lg-12">
						<?= create_groups('send')?>
					</div>
					<div class="col-lg-12">
						<input type="text" name="reply_to_message_id" placeholder="MID">
						<input type="submit" value="Submit">
					</div>
					<div class="col-lg-12">
						<input id="markdown" type='radio' name='parse_mode' value="markdown" checked>
						<label for="markdown">Markdown</label>
						<input id="html" type='radio' name='parse_mode' value="html">
						<label for="html">HTML</label>
					</div>
							
					
					<input type="hidden" name="SEND_MESSAGE" value="true">

					
			</fieldset>
		</form> 
			<fieldset class="col-lg-6">
				<legend>System log</legend>
				<a href="https://api.telegram.org/bot<?=BOT_TOKEN?>/getUpdates?offset=-6"><button>Remove logs</button></a>
				<div id="ajax-result"></div>
			</fieldset>
	</div>	
	</body>
</html>
