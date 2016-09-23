(function($){
  $(function(){
    $('.button-collapse').sideNav();
    $('#modal-new').leanModal();
    $('#select-sex').material_select();
    $('#select-img').material_select();
    $(".dropdown-button").dropdown();
    
    $(".menu a").click(function(e){ // Load the menu pages into the Main section
        e.preventDefault();
        var href = $( this ).attr('href');
        $("#main").load(href);
        $(".side-nav").sideNav('hide');
    });   
       
     $("body").delegate(".login","click",function(e){ // When click to login
      e.preventDefault();
        var email = $( this ).attr('email');
          $.post("/login", { // Post the data to the route
              email: email
          }, function(data){
              location.reload();    
          });   
     });
    
    $("body").delegate(".registerUser","click",function(e){ // When click to register user
      e.preventDefault();
        var name = $('#register-username').val();
        var email = $('#register-email').val();
        var account = $('#register-account').val();
        var img = $('#select-img').val();
        var validateEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; // Regular Expression for Email Format 
        var validateAccount = /^\d+(\.\d{1,2})?$/; // Regular Expression for Decimal with precision of 2
  
        if(name && email && account){
          if(validateEmail.test(email)){ // Validate de email
            if(validateAccount.test(account)){ // Validate the account(Decimal with precision of 2)
              $.post("/registeruser", { // Post the data to the route
                name: name,
                email: email,
                account: account,
                img: img
              }, function(data){
                if(!data){
                  $('#modal1').closeModal();
                  Materialize.toast('Registrado com Sucesso!', 4000);
                  location.reload();   
                }else{
                    Materialize.toast(data, 2000);
                }        
              }); 
            }else{
              Materialize.toast('Saldo Inválido!', 2000);
            }
            
          }else{
            Materialize.toast('Email Inválido!', 2000);
          }   
        }else{
            Materialize.toast('Preencha os Campos Vazios ou Incorretos!', 2000);
        }                   
     });
    
    $("body").delegate(".registerProduct","click",function(e){ // When click to register product
      e.preventDefault();
      
      var name = $('#productName').val();
      var productType = $('#productType').val();
      var quantity = $('#quantity').val();
      var price = $('#price').val();
      var businessType = $('#select-type').val();
      var validateInteger = /^[1-9]\d*$/; // Regular Expression for positive integer excluding 0 
      var validatePrice = /^\d+(\.\d{1,2})?$/; // Regular Expression for Decimal with precision of 2
      
      if(name && productType && quantity && price && businessType){
        if(validateInteger.test(quantity)){ // Validate the quantity of items (positive integer excluding 0 )
          if(validatePrice.test(price)){ // Validate the price (Decimal with precision of 2)
            $.post("/registerproduct", { // Post the data to the route
              name: name,
              productType: productType, 
              quantity: quantity,
              price: price, 
              businessType: businessType
            }, function(data){
                Materialize.toast('Registrado com Sucesso!', 2000);
                location.reload();    
            });  
          }else{
            Materialize.toast('Preço Inválido!', 2000);
          }
        }else{
          Materialize.toast('Quantidade Inválida!', 2000);
        }
       }else{
            Materialize.toast('Preencha os Campos Vazios ou Incorretos!', 2000);
        } 
     });
    
    $("body").delegate(".registerAction","click",function(e){ // When click to register the operation
      e.preventDefault();
      
      var cod = $( this ).attr('data-cod');
      var quantity = $( this ).attr('data-quantity');
      var price = $( this ).attr('data-price');
      var items = $('#items').val();
      var total = items * price;
      var userAcount = $('#account').html();
      var businessType = $('#businessType').html();

      if(items <= quantity && items > 0){ // Check if all the values were typed
        if((total > userAcount) && (businessType == "Venda") ){ // Check if the user has enought money
          Materialize.toast('Você não tem saldo suficiente!', 2000);
        }else{
          $.post("/registeraction", { // Post the data to the route
            cod: cod,
            items: items,
            total: total
          }, function(data){
              Materialize.toast('Registrado com Sucesso!', 2000);
              location.reload();  
          });  
        }
       }else{
            Materialize.toast('Campo Vazio ou Incorreto!', 2000);
        } 
     });
  }); // end of document ready
})(jQuery); // end of jQuery name space