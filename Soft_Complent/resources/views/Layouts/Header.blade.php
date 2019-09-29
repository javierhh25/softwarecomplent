@if(!empty(session('idUsuario')))
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #BED3E2;">
  <a class="navbar-brand" href="#">
    <img src="{{Asset('images/Logo.png')}}" width="50" height="50" alt="">
    Software Complent
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse collapse justify-content-between" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @if(session('infoUser')->idRol == 1)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuarios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/usuarios/listar">Listar</a>
          <a class="dropdown-item" href="/usuarios/registrarusuario">Crear</a>
      </li>
      @endif
      @if(session('infoUser')->idRol == 1)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tarifas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/tarifas/listar">Listar</a>
          <a class="dropdown-item" href="/tarifas/registrartarifa">Crear</a>
      </li>
      @endif
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ingresos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/ingresos/listar">Listar</a>
          <a class="dropdown-item" href="/ingresos/registraringreso">Crear</a>
      </li>
    </ul>
    <ul class="navbar-nav flex-row ml-md-auto  d-md-flex">
    <li class="nav-item dropdown">
      <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="OptUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
      {{session('infoUser')->nombreUsuario}} {{session('infoUser')->apellidoUsuario}}
      </a>  
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="OptUsuario">
        <a class="dropdown-item active" href="/logout">Cerrar Sesión</a>
        
      </div>
    </li>
  </ul>      
  </div>
</nav>
@endif