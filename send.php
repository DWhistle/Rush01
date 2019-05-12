<!--Подключаем Jquery!-->
<script type="text/javascript">
	//Загружаем библиотеку JQuery
	//Функция отправки сообщения
	function send()
	{
	//Считываем сообщение из поля ввода с id mess_to_add
	var mess=$("#mess_to_send").val();
	// Отсылаем паметры
		$.ajax({
				type: "POST",
				url: "add_mess.php",
				data:"mess="+mess,
				// Выводим то что вернул PHP
				error: function() {
		alert('There was some error performing the AJAX call!');
	},
				success: function(html)

		{
		  //Если все успешно, загружаем сообщения
		  load_messes();
		  //Очищаем форму ввода сообщения
		  $("#mess_to_send").val('');
				}
		});
  }
  //Функция загрузки сообщений
  function load_messes()
  {
	$.ajax({
				type: "POST",
				url:  "load_messes.php",
				data: "req=ok",
				// Выводим то что вернул PHP
				success: function(html)
		{
		  //Очищаем форму ввода
		  $("#messages").empty();
		  //Выводим что вернул нам php
		  $("#messages").append(html);
		  //Прокручиваем блок вниз(если сообщений много)
		  $("#messages").scrollTop(90000);
				}
		});
  }
  </script>
