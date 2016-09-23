<div class="container">
    <div class="content"><br>
        <div class="row">
            <nav><div class="nav-wrapper teal lighten-3" >
                <form><div class="input-field">
                    <input id="search" class="filterResults" name="table_search" class="form-control input-sm pull-right" type="search" required />
                    <label for="search"><i class="zmdi zmdi-search"></i></label></div>
                </form>
            </div></nav>
        </div>
      <ul class="collection hoverable">
          @foreach($actions as $action)
          <li class="collection-item avatar filter">
            @if($action->businessType == "Venda")
            <i class="circle green">{{$action->id}}</i>
            @else
            <i class="circle blue">{{$action->id}}</i>
            @endif
            <h5>{{$action->type}}</h5>
            <span class="title">{{$action->name}} ({{$action->productType}})</span>
            <p>{{$action->user}}  <b class="right">Qtd: {{$action->items}}</b></p>
            <a href="#!" class="secondary-content">Total: R$ {{$action->total}}</a>
          </li>
          @endforeach
      </ul>
  </div>
</div>

<script>
    
$("#main").on("keyup", ".filterResults", function(e){
		if (e.keyCode == 13) return false;
		search_str = $(this).val().toLowerCase();
		find = $(".filter");

		for(i = 0 ; i < $(find).length ; i++) {
			name = $(find).eq(i).text().toLowerCase();
			if(name.indexOf(search_str) > -1)
							$(find).eq(i).show();
			else
							$(find).eq(i).hide();
		}
}); 

</script>