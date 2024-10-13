<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Dashboard Template · Bootstrap v5.1</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">



  <!-- Bootstrap core CSS -->
  <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .setimg {
      width: 100%;
      height: 225px;

    }
  </style>


  <!-- Custom styles for this template -->
  <link href="./assets/css/dashboard.css" rel="stylesheet">
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Blog Page</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" name="signout" href="http://localhost:8080/pages/loginview">Sign out</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="http://localhost:8080/pages/dashboard">
                <span data-feather="home"></span>
                My Blogs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="http://localhost:8080/pages/allusers">
                <span data-feather="home"></span>
                All Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="http://localhost:8080/pages/addblog">
                <span data-feather="home"></span>
                Add New Blog
              </a>
            </li>


          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <h2>Various Blogs</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php
          $a = '';
          foreach ($data as $product) {
            $a .= ' <div class="col">
                          <div class="card shadow-sm">
                            <img class="card-img-top setimg" src="../../../public/images/' . $product->blogimage . '" alt="Card image">
                            <div class="card-body">
                                <h5>' . $product->blogname . '</h5>
                                <p class="card-text">' . $product->blogdesc . '</p>
                              <div class="d-flex justify-content-between align-items-center">
                               
                                <form method="POST" action="http://localhost:8080/pages/adminmoreabout">
                                 <input type="hidden" name="item" value=' . $product->id . '>
                                 <input type="submit" name="detail" value="More Details-->" class="btn btn-danger"/>
                                  </form>
                                  <form method="POST" action="http://localhost:8080/pages/dashboard">
                                  <input type="hidden" name="delval" value=' . $product->id . '>
                                <input type="submit" name="delete" class="btn btn-primary" value="Delete">
                                </form>
                                <br>
                                <form method="POST" action="http://localhost:8080/pages/editform">
                                <input type="hidden" name="editval" value=' . $product->id . '>
                              <input type="submit" name="edit" class="btn btn-danger" value="Edit">
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>     ';
          }
          echo $a;
          ?>

        </div>
      </main>
    </div>
  </div>


  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>