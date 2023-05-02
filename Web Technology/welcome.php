<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Welcome to Warteg!</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body  style="font-family: 'Poppins', sans-serif; font-size: larger">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
            .btn-fill{
                font: 600 1.125rem/1.75rem Poppins, sans-serif;            
                background-color: #FF2442;
                padding: 1rem 1.5rem;
                border-radius: 0.75rem;
            }
            .btn-fill:hover{
                --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }
            @media(min-width: 425px){
                .empty-4-5 .title-text{
                font-size: 40px;
            }
            }
            @media (min-width: 576px) {
                .empty-4-5{
                    padding: 3.5rem 2rem 4rem;               
                }
                .empty-4-5 .main-img{
                    margin-bottom: 0.625rem;
                    width: auto;
                }
            }       
        </style>

        <div class="container mx-auto d-flex align-items-center justify-content-center flex-column">    
            <img src="assets/logowarteg.png" width="400px">            
            <div class="text-center w-100">
                <h1 class="title-text">
                    Welcome to Warteg! 
                </h1>
                <p style="color: #9C9C9C">Please sign in to continue.</p>
                <div class="d-flex justify-content-center">    
                    <a href="loginuser.php" style="text-decoration: none;">
                        <button class="btn btn-fill d-inline-flex text-white" style="margin: 10px;">
                            <span style="color: #FFEDDA;">Customer</span>
                        </button>
                    </a>
                    <a href="loginadmin.php" style="text-decoration: none;">
                        <button class="btn btn-fill d-inline-flex text-white" style="margin: 10px;">
                            <span style="color: #FFEDDA;">Administrator</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>