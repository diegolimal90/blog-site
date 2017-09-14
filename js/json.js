$(document).ready(function(){
	var item = "";
	$.getJSON('php/consulta.php', function(data){
		$.each(data, function(i, v){
			/*aqui vamos por o codigo para a parecer na tela*/
	        item += "<div class='post' style='float:left;'>";
		        item += "<div class='col-lg-5'>";
			        item += "<div class='cl-blog-img'>";
			        	item += "<img src='assets/images/"+v.img+"' alt='' style='width: 90%; padding-left: 100px;'>";
			    	item += "</div>";
			    item += "</div>";
			    item += "<div class='col-lg-7'>";
			        item += "<div class='med-blog-naz'>";
			        	item += "<div class='cl-blog-type'><i class='pe-7s-photo-gallery'></i></div>";
			        	item += "<div class='cl-blog-name' id='titulo'>"+v.titulo+"</div>";
			        	item += "<div class='cl-blog-detail' id='data'>"+v.dia+"</div>";
			        	item += "<div class='cl-blog-text more' id='txt' style='overflow:hidden;'>"+v.texto+"</div>";
			        item += "</div>";
			        item += "<div class='cl-blog-line'></div>";
		        item += "</div>";
	        item += "</div> <br>";
			//$("#data").html(v.dia);
			$("#conteudo").html(item);
		});
		
	});
});
/*
function carregaritens(){
	
	$.ajax({
		url: 'php/consulta.php',
		dataType: "json",
		sucess: function(retorno){
			if(retorno.erro){
				$("#teste").html(retorno);
				console.log(retorno);
			}
			else{
				/*aqui vamos por o codigo para a parecer na tela
				for(var i=0; i<retorno.length; i++){
				var item = "<h1>";
				item += retorno[i].texto; 
				item +="</h1>";
				}
				$("#teste").html("item");
				console.log("item");
			}
		}
	});
}
*/
