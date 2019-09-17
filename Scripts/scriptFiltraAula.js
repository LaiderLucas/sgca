$(function(){
	$("#aulas input").keyup(function(){		

		var index = $(this).parent().index();
		var nth = "#aulas td:nth-child("+(index+1).toString()+")";
		var valor = $(this).val().toUpperCase();
		$("#aulas tbody tr").show();
		$(nth).each(function(){
			if($(this).text().toUpperCase().indexOf(valor) < 0){
				$(this).parent().hide();
			}
		});
	});

	$("#aulas input").blur(function(){
		$(this).val("");
	});
});