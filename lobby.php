<?php session_start(); ?>
<script type="text/javascript">
	function send()
	{
		var mess = $("#mess_to_send").val();
		$.ajax({
				type: "POST",
				url: "add_mess.php",
				data:"mess="+mess,
				success: function(html) {
					load_messes();
					$("#mess_to_send").val('');
				}
			});
	}
	function load_messes()
	{
		$.ajax({
			type: "POST",
			url:  "load_messes.php",
			data: "req=ok",
			success: function(html)
			{
				$("#messages").empty();
				$("#messages").append(html);
				$("#messages").scrollTop(90000);
			}
		});
	}
	function createroom()
	{
		$.ajax({
				type: "POST",
				url: "add_room.php",
				data:"req=ok",
				success: function(html) {
					load_rooms();
				}
			});
	}
	function joinroom()
	{
		var id = $("#join").serialize();
		alert(id);
		$.ajax({
				type: "POST",
				url: "join_room.php",
				data:"id="+id,
				success: function(html) {
				}
			});
	}
	function delroom()
	{
		$.ajax({
				type: "POST",
				url: "delroom.php",
				data:"req=ok",
				success: function(html) {
					load_rooms();
				}
			});
	}
	function load_rooms()
	{
		$.ajax({
			type: "POST",
			url:  "load_rooms.php",
			data: "req=ok",
			success: function(html)
			{
				$("#rooms").empty();
				$("#rooms").append(html);
			}
		});
	}
	load_messes();
	load_rooms();
	setInterval(load_messes,1000);
	setInterval(load_rooms,3000);
</script>
<div class="box">
	<table>
		<tr>
			<td>
				<div id="messages">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<form onsubmit="javascript:send();">
					<input type="text" id="mess_to_send">
					<input type="submit" value="Отправить">
				</form>
			</td>
		</tr>
	</table>
	<? if (!isset($_SESSION['room'])){?>
	<form onsubmit="javascript:createroom();">
		<input type="submit" value="Create">
	</form>
	<?}?>
	<div class="box" id="rooms">
	</div>
</div>
