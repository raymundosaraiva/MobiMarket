<div class="container">
          <br><h5 class="caption center-align">Nova Mercadoria</h5>
        <div class="row">
        <div class="input-field col s8">
          <input id="productName" name="name" type="text">
          <label for="productName" >Nome</label>
        </div>
          
        <div class="input-field col s4">
           <input id="productType" name="productType" type="text">
          <label for="productType" >Tipo de Produto</label>
        </div>
          
          <div class="input-field col s4">
            <select id="select-type" name="businessType" required>
                <option value="" disabled selected>Tipo de Negócio</option>
                <option value="Compra">Compra</option>
                <option value="Venda">Venda</option>
            </select>
        </div>
          <div class="input-field col s4">
            <input id="quantity" type="number" name="quantity">
          <label for="quantity">Quantidade</label>
          </div>
          <div class="input-field col s4">
            <input id="price" type="number" name="price">
          <label for="price">Preço (R$)</label>
          </div>
      </div>
      <div class="row center">
          <br/><a class="btn waves-effect waves-light green registerProduct" name="action" >Cadastrar</a><br/><br/>
      </div>
  </div>
</div>

<script>
$('#select-type').material_select();
</script>