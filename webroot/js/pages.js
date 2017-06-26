$(document).ready(function(){
	function getCities(sigla){
		$.post("/Ibge/getCities", { "sigla": sigla },
			function(data, status){
				if(status === "success"){
					var cidades = JSON.parse(data);
					$("#cidade select").empty();
					for(var i = 0; i < cidades.length; i++){
						var cidade = cidades[i]["NOME_MUNICIPIO"];	
						cidade = cidade.substr(0,1) + cidade.substr(1).toLowerCase();
						$("#cidade select").append(
							"<option value="+ cidades[i]['NOME_MUNICIPIO'] +">"+ cidade +"</option>"
						);				
					}
				}
			}
		);
	}

	function findExpression(word, expression){
		if(word.search(expression) === -1){
			return false;
		}
		return true;
	}

	function showMessage(inputElement, message){
		$(inputElement).after(
			"<p id='" + $(inputElement)[0]['attributes'][0]['value'] + "' class='error'>" + message + "</p>"
		);
	}

	function removeMessage(inputElement){
		$("#" + $(inputElement)[0]["attributes"][0]["value"]).remove();
	}

	function disableButton(buttonId){
		if(
			$("#razao")[0] !== undefined ||
			$("#endereco")[0] !== undefined ||
			$("#bairro")[0] !== undefined
		){
			$(buttonId).attr("disabled", "disabled");
		}
	}

	function enableButton(buttonId){
		if(
			$("#razao")[0] === undefined &&
			$("#endereco")[0] === undefined &&
			$("#bairro")[0] === undefined
		){
			$(buttonId).removeAttr("disabled");
		}
	}

	$("input[name=razao], input[name=endereco], input[name=bairro]").on("focusout", function(){
		if(
			findExpression($(this).val(), /[!#$*|\\\/{}'|_£¢¬;=+§<>`´'~^?]/igm)
		){
			if($("#" + $(this)[0]["attributes"][0]["value"])[0] === undefined){
				showMessage(this, "<em>Caracteres especiais não são permitidos.</em>");
				disableButton("#btn-cadastrar-empresa");
			}
		}
		else{
			removeMessage(this);
			enableButton("#btn-cadastrar-empresa");
		}
	});

	$("button.close").on("click", function(){
		$("div.alert").remove();
	});

	$("input[name=cnpj]").on("focusin",function(){
		if($(this).val() === ""){
	    	$(this).mask("99.999.999/9999-99",{placeholder:"__.___.___/____-__"});
		}
	});
	$("input[name=cnpj]").on("focusout",function(){
		if($(this).val() === "__.___.___/____-__"){
			$(this).val("");
		}
	});

	$("input[name=cep]").on("focusin",function(){
		if($(this).val() === ""){
	    	$(this).mask("99999-999",{placeholder:"_____-___"});
		}
	});
	$("input[name=cep]").on("focusout",function(){
		if($(this).val() === "_____-___"){
			$(this).val("");
		}
	});

	getCities($("#estado select").val());

	$("#estado select").on("change", function(){
		getCities($("#estado select").val());
	});
});