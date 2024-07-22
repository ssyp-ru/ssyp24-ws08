

<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head><script src="../assets/js/color-modes.js"></script>
  <script type="module">
  import { Toast } from 'bootstrap.esm.min.js'

  Array.from(document.querySelectorAll('.toast'))
    .forEach(toastNode => new Toast(toastNode))
</script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Signin Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

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

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>

    

    <link href="../assets/css/sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    
<main class="form-signin w-100 m-auto">
  <form method = "POST">
    <!-- <h1 class="h3 mb-3 fw-normal">Please sign in</h1> -->
    <!-- <form method="POST"> -->
<input type="hidden" name="register">
<button class="btn btn-primary rounded-pill px-3" type="submit" value="Edit ">Sign up</button>
  <br>username: <input type="text" name="username">
  password: <input type="text" name="pass">
  <input type="submit" value = "Login">
  <?php $_POST['redirect'] = "login";?>
</form>
    <!-- <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name = "username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="pass">
      <label for="floatingPassword">Password</label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
  </form>
</main>
<script src="../assets/js/bootstrap.bundle.min.js"></script>

    </body>
</html> -->

<!-- 

<html> 
 <head>
  <meta charset="utf-8">
  <title>Стили</title>
  <link rel="stylesheet" href="https://ssyp.local/css1.css">
  <style>html, body{
    height: 1080px;
    width: 1920px;
    margin: 0;
    background-color: #000000;
}
.conteiner{
    color:rgb(240, 255, 255);
    height: 93px;
    text-align: center;
}

.Ready{
    position: relative;
    width: 540px;
    color: #FFFFFF;
    text-align: center;
    font-size: 36px;
    font-family: sans-serif;
    height: 132px;  
    background: #1f201f;
    border-radius: 100px;
    top: -90px;
    left: 650px;
    border: 0;
}

.Meta{
    height: 40px;
    width: 640px;
    border-radius: 20px;
    background-color: #000000;
    margin-left: 545px;
}

.MetPut{
    position: relative;
    height: 10px;
    width: 10px;
    background-color: #ffffff;
    border-radius: 50%;
    top: 15px;
    left:46px
}

.MetPut1{
    position: relative;
    height: 10px;
    width: 10px;
    background-color: #ffffff;
    border-radius: 50%;<html>

    height: 1080px;
    width: 1920px;
    margin: 0;
    background-color: #000000;
}
.conteiner{
    color:rgb(240, 255, 255);
    height: 93px;
    text-align: center;
}

.Ready{
    position: relative;
    width: 540px;
    color: #FFFFFF;
    text-align: center;
    font-size: 36px;
    font-family: sans-serif;
    height: 132px;  
    background: #1f201f;
    border-radius: 100px;
    top: -90px;
    left: 650px;
    top: 5px;
    left: 304px;
}

.MetPut2{
    position: relative;
    height: 10px;
    width: 10px;
    background-color: #ffffff;
    border-radius: 50%;
    top: -4px;
    left: 582px;
}

.MetaText{
    text-align: center;
    font-size: 48px;
    margin-top: 96px;
    color: rgb(240, 255, 255);
    font-family: sans-serif;
}

.Avtoriz{
    height: 642px;
    width: 637px;
    background-color: #000000;
    margin-left: 580px;
    margin-top: 96px;
    background-color: #FFFFFF;
}

.Avtor{
    float: left;
    width: 20px;
    height: 642px;
    background: #03160D;
}

.Avt{
    position: relative;
    width: 544px;
    color: #FFFFFF;
    text-align: center;
    font-size: 36px;
    padding-top: 40px;
    font-family: sans-serif;
    height: 100px;  
    background: #4F714A;
    border-radius: 100px;
    top: 19px;
    left:56px
}
.Avt1{
        position: relative;
        width: 544px;   
        color: white;
        font-family: sans-serif;
        text-align:center;  
        height: 130px;  
        background: #2B3427;
        border-radius: 100px;
        top: 30px;
        left:35px;
        font-size:48;
}

.Avt2{
    position: relative;
    width: 544px;
    color: #FFFFFF;
    text-align: center;
    font-size: 36px;
    padding-top: 40px;
    font-family: sans-serif;
    height: 100px;  
    background: #4F714A;
    border-radius: 100px;
    top: 50px;
    left:56px
}

.Avt3{
    position: relative;
    width: 544px;
    color: white;
    font-family: sans-serif;
    text-align:center;  
    height: 130px;  
    background: #2B3427;
    border-radius: 100px;
    top:60px;
    left:37px;
    font-size:48;
}


.Fon{
    width: 1807px;
    height: 1000px;
    background-color: #2B3427;
    margin-left: 93px;
    border-radius: 100px;
    padding: 21px;
}

.H1{
    width: 1827px;
    height: 93px;
    background-color: #000000;
    font-family: sans-serif;
    font-size: 64px;
}

.square{
    float: left;
    width: 93px;
    height: 93px;
    background: #2B3427;
    text-align: center;
    color: green;
    font-size: 80px;
}
  

.btn-one {
    color: #FFF;
    transition: all 0.3s;
    position: relative;
  }
  .btn-one span {
    transition: all 0.3s;
  }
  .btn-one::before {
    content: '';
    bottom: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    opacity: 0;
    transition: all 0.3s;
    border-top-width: 1px;
    border-bottom-width: 1px;
    border-top-style: solid;
    border-bottom-style: solid;
    border-top-color: rgba(255,255,255,0.5);
    border-bottom-color: rgba(255,255,255,0.5);
    transform: scale(0.1, 1);
  }
  .btn-one:hover span {
    letter-spacing: 2px;
  }
  .btn-one:hover::before {
    opacity: 1; 
    transform: scale(1, 1); 
  }
  .btn-one::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: 1;
    transition: all 0.3s;
    background-color: rgba(255,255,255,0.1);
  }
  .btn-one:hover::after {
    opacity: 0; 
    transform: scale(0.1, 1);
  }

.center{
    text-align: center;
    /*line-height: 93px;*/
    /*display: flex;
    align-items: center;
    justify-content: center;*/
}

</style>
 </head>
    <body>
        <div class="conteiner center">
            <div class="box-1">
            <div class="btn btn-one">
                <span class="square">☘</span>
            </div>
        </div>
            <div class="H1">The Wall</div>
        </div>
        <div class="Fon">
            <div class="Meta">
                <div class="MetPut"></div>
                <div class="MetPut1"></div>
                <div class="MetPut2"></div>
            </div>
            <div class="MetaText">Wow, Go Login Bro>></div>
            <div class="Avtoriz">
                <div class="Avtor"></div>
                <div class="Avt">Enter Name>></div>
                <form>
                    <input class="Avt1"></input>
                </form>
                <div class="Avt2">Enter Password>></div>
                <form>
                    <input class="Avt3"></input>
                </form>
                <form action="" target="_blank">
                    <button class="Ready">>Ready<</button>
                </form>    
            </div>
        </div>
    </body>
</html> 


 -->






<!-- 
<html>
<head>
<style>
body {
  background-color: #4d5459;
}

form {
  width: 280px;
  font-family: system-ui;
  color: white;
		margin: 0 auto;
		text-align: center;
    margin-top: 200px;
		margin-bottom: 35px;

}

h1 {
  font-family: system-ui;
  margin: 0 auto;
  margin-top: 200px;
  color: white;
  text-align: center;
}

p {
  font-family: verdana;
  font-size: 20px;
}
</style>
</head>
<body>
<html>
<head>
<style>
body {
  background-color: #4d5459;
}

form {
  width: 280px;
  font-family: system-ui;
  color: white;
		margin: 0 auto;
		text-align: center;
    margin-top: 200px;
		margin-bottom: 35px;

}

h1 {
  font-family: system-ui;
  margin: 0 auto;
  margin-top: 200px;
  color: white;
  text-align: center;
}

p {
  font-family: verdana;
  font-size: 20px;
}
</style>
</head>
<body>
  <h1>Login</h1>
<form method="POST">
  username: <input type="text" name="username">
  password: <input type="text" name="pass">
  <input type="submit" value = "Login">
  <h1>Login</h1>
<form method="POST">
  username: <input type="text" name="username">
  password: <input type="text" name="pass">
  <input type="submit" value = "Login">
  <?php // $_POST['redirect'] = "login";?>
</form>
</body>
</html> -->
