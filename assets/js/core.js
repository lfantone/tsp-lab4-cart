$(document).ready(function() {
	var link = "/tsp-lab4-cart/index.php/"; 
	$("table.productos_lista tbody tr form").submit(function() {
<<<<<<< HEAD
		var id = $(this).find('input[name=id_collectable]').val();  
		var qty = $(this).find('input[name=quantity]').val();
		$.post(link + "cart/add_cart_item", { id_collectable: id, quantity: qty, ajax: '1' },  
        function(data) {
			if(data == 'true') {
				$.get(link + "cart/show_cart", function(cart) {
					$("#carrito_contenido").html(cart);
					});
        	} else {  
        		alert("Producto inexistente!");  
        	}    
        });  
        return false;
    });
	
	$("ul.ofertas form").submit(function() {
		var id = $(this).find('input[name=id_collectable]').val();  
		var qty = $(this).find('input[name=quantity]').val();		
		$.post(link + "cart/add_cart_item", { id_collectable: id, quantity: qty, ajax: '1' },  
        function(data) {
			if(data == 'true') {
				$.get(link + "cart/show_cart", function(cart) {
					$("#carrito_contenido").html(cart);
					});
        	} else {  
        		alert("Producto inexistente!");  
        	}    
        });  
        return false;
=======
		var id = $(this).find('input[name=id_producto]').val();  
		var qty = $(this).find('input[name=quantity]').val();
		if(qty > 0) {
			$.post(link + "cart/add_cart_item", { id_producto: id, quantity: qty, ajax: '1' },  
	        function(data) {
				if(data == 'true') {
					$.get(link + "cart/show_cart", function(cart) {
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
		var qty = $(this).find('input[name=quantity]').val();		
		if (qty > 0) {	
			$.post(link + "cart/add_cart_item", { id_producto: id, quantity: qty, ajax: '1' },  
	        function(data) {
				if(data == 'true') {
					$.get(link + "cart/show_cart", function(cart) {
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
>>>>>>> de7319b30ab1fef9cd8257284caac78d25dd4aed
    }); 

	$(".vaciar").live("click", function() {
		$.get(link + "cart/empty_cart", function() {
			$.get(link + "cart/show_cart", function(cart){
				$("#carrito_contenido").html(cart);  
	        });  
	    });  
	    return false;  
	}); 
});
