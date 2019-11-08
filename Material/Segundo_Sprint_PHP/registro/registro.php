<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="registro.css">
  <title>Registrate</title>
</head>
<body>
    <header>
        <div class="logo">
          <a href="../home/index.html">
            <img src="img/logo2.png" alt="logo">
          </a>
        </div>
        <div class="buscador">
          <select name="Barrio">
              <option value="Barrio"disabled selected>-Selecciona tu barrio-</option>
              <option value="Almagro">Almagro</option>
              <option value="Balvanera">Balvanera</option>
              <option value="Belgrano">Belgrano</option>
              <option value="Colegiales">Colegiales</option>
              <option value="Chacarita">Chacarita</option>
              <option value="Coghlan">Coghlan</option>
              <option value="Caballito">Caballito</option>
              <option value="Flores">Flores</option>
              <option value="Nueva Pompeya">Nueva Pompeya</option>
              <option value="Palermo">Palermo</option>
              <option value="San Telmo">San Telmo</option>
              <option value="Versalles">Versalles</option>
              <option value="Villa Luro">Villa Luro</option>
          </select>
        </div>
        <div class="preguntas">
          <a href="../faq/faq.html">Preguntas Frecuentes</a>
        </div>
        </div>
    </header>


  <main>
      <div class="container" id="container">
            <div class="form-container sign-in-container">
              <form action="#">
                  <h1>Registrate</h1>
                  <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                  </div>
                  <span>O usa tu correo electronico para registrarse</span>
                  <input type="text" placeholder="Nombre" />
                  <input type="email" placeholder="Email" />
                  <input type="password" placeholder="Contraseña" />
                  <button>Registrate</button>
              </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                      <div class="overlay-panel overlay-right">
                          <h1>Bienvenido!</h1>
                          <p>Para seguir conectado, por favor inicia sesión con tus datos</p>
                          <a href="../login2.0/login2-0.html"><button class="ghost" id="signUp">Inicia Sesión </button></a>
                      </div>
                </div>
            </div>
      </div>
    </main>
</body>
</html>
