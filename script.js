var startFrom = 10;
var pages=1.2;
var inProgress = false;

function get_comments(){
	$.ajax({
        type: "POST",
        url: "get_comments.php",
        data: {'startFrom' : 0},
        success: function(response){
            $('#articles').html(response);
        }
    });
};

function insert_comment(){
	
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var address = $('#email').val();
	
	if(address!='')
	{
		if(reg.test(address) == false) {
			alert('Введите корректный e-mail или оставьте поле пустым');
			return false;
		}
	}
   
	if(($('#user_name').val()=='')||($('#comment_text').val()==''))
	{
		alert('Заполните обязательные поля.');
	}
	else
	{
		$.ajax({
			type: "POST",
			url: "insert_comment.php",
			data: "user_name="+$('#user_name').val()+"&comment_text="+$('#comment_text').val()+"&email="+$('#email').val(),
			success: function(response){
				get_comments();
				startFrom=10;
				pages=1.2;
				inProgress = false;
				$('#user_name').val('');
				$('#comment_text').val('');
				$('#email').val('');
			}
		});
	}
};

//запуск функции при прокрутке


$(document).ready(function(){

/* Переменная-флаг для отслеживания того, происходит ли в данный момент ajax-запрос. В самом начале даем ей значение false, т.е. запрос не в процессе выполнения */

/* С какой статьи надо делать выборку из базы при ajax-запросе */


    /* Используйте вариант $('#more').click(function() для того, чтобы дать пользователю возможность управлять процессом, кликая по кнопке "Дальше" под блоком статей (см. файл index.php) */
    $('.text').scroll(function() {
		
        /* Если высота окна + высота прокрутки больше или равны высоте всего документа и ajax-запрос в настоящий момент не выполняется, то запускаем ajax-запрос */
		
        if($('.text').scrollTop() + $('.text').height() >= $('.text').height()*pages  && !inProgress) {

		
        $.ajax({
            url: 'get_comments.php',
            type: "POST",
            data: {"startFrom" : startFrom},
            beforeSend: function() {
            inProgress = true;}
            }).done(function(data){
			if (data.length > 0) 
			{
				$("#articles").append("<p>" + data + "</p>");
				inProgress = false;
				startFrom += 5;
				pages=pages+0.8;
            }});
        }
    });
});