<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="TVction">

<!--    <link rel="icon" href="img/ico.jpg">-->
    <link href="css/material-design-iconic-font.css" rel="stylesheet">
        
    <title>.::. MobiMarket .::.</title>

    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script> 
    <script src="js/init.js"></script>
    
<body> 
  <div id="wrapper">
      <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
    <li><a href="{{URL::to('/')}}">Perfil</a></li>
    <li><a href="{{URL::to('logout')}}">Sair</a></li>
    </ul>
    
    <div class="navbar-fixed"> 
      <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="" class="brand-logo">MobiMarket</a>

          @if(Session::has('user'))
          <ul class="right hide-on-med-and-down">
            <li class="menu"><a href="{{URL::to('products')}}">Negociar</a></li>
            <li class="menu"><a href="{{URL::to('actionslist')}}">Lista de Operações</a></li>
            <li class="menu"><a href="{{URL::to('newproduct')}}">Nova Mercadoria</a></li>
            <!-- Dropdown Trigger -->
            <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="zmdi zmdi-account"></i></a></li>
            <li>R$<b id="account">{{$profile->account}}</b></li>
          </ul>
          <ul id="nav-mobile" class="side-nav">
            <li class="center"><h5 class="black-text">MobiMarket</h5></li>
            <li class="menu"><a href="{{URL::to('products')}}">Negociar</a></li>
            <li class="menu"><a href="{{URL::to('actionslist')}}">Lista de Operações</a></li>
            <li class="menu"><a href="{{URL::to('newproduct')}}">Nova Mercadoria</a></li>
            <li><a href="{{URL::to('logout')}}">Sair</a></li>
          </ul>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="zmdi zmdi-menu"></i></a>
          @endif

        </div>
      </nav>
    </div>
  
    <div id="main">
      @if(Session::has('user'))
        @include('profile')
      @else
      <div class="wrapper-valign">
        <div class="container row valign" style="width:400px;">
          <div class="card-panel hoverable #fafafa grey lighten-5 " style="position:relative;top:30px;margin-bottom:100px">
            <ul class="collection">
          @foreach($users as $user)
              <li class="collection-item avatar">
                <img src="img/{{$user->img}}" alt="" class="circle">
                <span class="title">{{$user->name}}</span>
                <p>{{$user->email}}</p>
                <a href="#!" email="{{$user->email}}" class="secondary-content login"><i class="zmdi zmdi-sign-in zmdi-hc-3x"></i></a>
              </li>
          @endforeach
            </ul>
            <div class="center">
              <button class="btn waves-effect waves-light #bf360c green darken-2" id="modal-new" href="#modal1" ><i class="zmdi zmdi-plus-circle-o"></i> Novo Cadastro</button>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div> <!--#main-->
    
    <div id="footer">
      <footer class="page-footer #795548 brown">
        <div class="container">
          <div class="row">
            <div class="col s12 center">
              <h5 class="white-text">MobiMarket</h5>
              <p class="grey-text text-lighten-4">Trading Market Company</p>
            </div>
          </div>
        </div>
        <div class="footer-copyright" >
          <div class="container">
            Made by <a class="orange-text text-lighten-3" href="#">Raymundo Saraiva</a>
          </div>
        </div>
      </footer>
    </div> <!--#footer-->
  </div><!--#wrapper-->
  
  <!-- Modal Structure -->
    <div id="modal1" class="modal">
      <div class="modal-content">
        <h4 class="caption center-align">Novo Cadastro</h4>
          <div class="row">
          <div class="input-field col s12">
            <input id="register-username" name="username" type="text">
            <label for="register-username" data-error="Errado" >Nome</label>
          </div>
            <div class="input-field col s4">
            <select id="select-img" class="icons" name="img">
              <option value="avatar.png" data-icon="img/avatar.png" class="left circle">Avatar 1</option>
              <option value="avatar1.png" data-icon="img/avatar1.png" class="left circle">Avatar 2</option>
              <option value="avatar2.png" data-icon="img/avatar2.png" class="left circle">Avatar 3</option>
              <option value="avatar3.png" data-icon="img/avatar3.png" class="left circle">Avatar 4</option>
            </select>
          </div>
          <div class="input-field col s4">
            <input id="register-email" type="email" name="email" class="validate">
            <label for="register-email" data-error="Errado">Email</label>
          </div>
          <div class="input-field col s4">
            <input id="register-account" type="number" name="account">
            <label for="register-account">Saldo Conta</label>
          </div>
        </div>
        <div class="row center">
            <br/><a class="btn waves-effect waves-light green registerUser" >Cadastrar</a><br/><br/>
        </div>
      </div>
    </div>
    
  
</body>
</html>
