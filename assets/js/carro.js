$(document).ready(function() {
	var link = "/tsp-lab4-cart/"; 
	$("table.productos_lista tbody tr form").submit(function() {
		var id = $(this).find('input[name=id_producto]').val();  
		var qty = $(this).find('input[name=cantidad]').val();
		if(qty > 0) {
			$.post(link + "carro/agregar_producto", { id_producto: id, cantidad: qty, ajax: '1' },  
	        function(data) {
				if(data == 'true') {
					$.get(link + "productos/carro_productos", function(cart) {
						$("#carrito_contenido").html(cart);
						});
	        	} else {  
	        		alert("Producto inexistente!");  
	        	}    
	        });	        
		} else {
			alert("Cantidad inválida!");
		}
		return false;
	});
	
	$("ul.ofertas form").submit(function() {
		var id = $(this).find('input[name=id_producto]').val();  
		var qty = $(this).find('input[name=cantidad]').val();		
		if (qty > 0) {	
			$.post(link + "carro/agregar_producto", { id_producto: id, cantidad: qty, ajax: '1' },  
	        function(data) {
				if(data == 'true') {
					$.get(link + "main/carro_ofertas", function(cart) {
						$("#carrito_contenido").html(cart);
						});
	        	} else {  
	        		alert("Producto inexistente!");  
	        	}    
	        });
		} else {
			alert("Cantidad inválida!");
		}
			return false;
    }); 

	$(".vaciar").live("click", function() {
		$.get(link + "carro/vaciar_carro", function() {
			$.get(link + "carro/vaciar_carro", function(cart){
				$("#carrito_contenido").html(cart);  
	        });  
	    });  
	    return false;  
	}); 
});
