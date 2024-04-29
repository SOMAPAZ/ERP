<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/3e533b6411.js" crossorigin="anonymous"></script>
  <title>SOMAPAZ SERVICES</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" type="text/css" />
  <link rel="icon" href="/img/icono.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
  <?php include "./controller/controller_login.php" ?>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>

    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
      <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>

    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
  </svg>
  <nav class="navbar navbar-expand py-3 fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse float-end" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 ms-2 mb-lg-0 bg-secondary-subtle rounded p-1">
          <li class="nav-item dropdown w-25" data-bs-theme="light">
            <button class="btn btn-link nav-link py-1 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
              <svg class="bi my-1 theme-icon-active" width="16" height="16" fill="currentColor">
                <use href="#circle-half"></use>
              </svg>
              <span class="d-lg-none ms-2">Tema</span>
            </button>

            <ul class="dropdown-menu dropdown-menu-start px-1" aria-labelledby="bd-theme">
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                  <svg class="bi me-2 opacity-50 theme-icon" width="16" height="16" fill="currentColor">
                    <use href="#sun-fill"></use>
                  </svg>
                  Light
                </button>
              </li>
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                  <svg class="bi me-2 opacity-50 theme-icon" width="16" height="16" fill="currentColor">
                    <use href="#moon-stars-fill"></use>
                  </svg>
                  Dark
                </button>
              </li>
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
                  <svg class="bi me-2 opacity-50 theme-icon" width="16" height="16" fill="currentColor">
                    <use href="#circle-half"></use>
                  </svg>
                  Auto
                </button>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main>
    <!-- Modal Button -->
    <div id="welcome-components">
      <h1>SOMAPAZ</h1>
      <h4>Software de Gestión</h4>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="button-access">
        Ingresar al sistema
      </button>
    </div>
    <img src="/img/logo index.png" alt="image-logo" id="image-icon" />
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
              Bienvenido
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-center align-items-center">
              <div>
                <form action="#" method="post" class="text-center rounded">
                  <img src="/img/somapaz log.png" alt="img user icon" class="w-50 mb-3" />
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Ingrese usuario" name="user-name" />
                    <label for="floatingInput">Usuario</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Ingrese contraseña" name="password" />
                    <i class="fa-solid fa-eye password-icon" id="Eye"></i>
                    <label for="floatingPassword">Contraseña</label>
                  </div>
                  <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger mt-2" role="alert">
                      <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" width='30' viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                      </svg>
                      <?php echo $error_message; ?>
                    </div>
                  <?php endif; ?>
                  <div class="d-grid gap-2 mt-1">
                    <input class="btn btn-primary" type="submit" value="Iniciar sesión" name="btn-access">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="/js/code.js"></script>
  <script src="/js/theme.js"></script>
</body>

</html>