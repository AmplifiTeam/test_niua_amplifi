
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
  <title>Page not found</title>
</head>
<style>
    body{
        background:#000;
    }
  .page-404 {
    margin: auto;
    width: 50%;
    text-align: center;
    padding-block: 50px;
}
.page-404 .container {
    background:#fafafa;
    padding-block: 50px;
}
.page-404 .container .text-404 {
    color: #b69c11;
    font-size: 100px;
    font-weight: 800;
    animation: zoomeff 6s infinite ease;
    height: 112px;
}
.errorpagetext {
    color: #000000c4;
    text-transform: capitalize;
    font-size: 33px;
    margin-bottom: 50px;
}
.home-btn-err{
    color:black;
    background: #b69c11;
    border-radius:20px;
    padding: 8px 15px;
    text-decoration:none;

}
@keyframes zoomeff {
    0% {
    transform: scale(1.1);
}
50% {
    transform: scale(1.3);
}
100% {
    transform: scale(1.1);
    color: #b69c11;
}
}
@media (max-width:768px){
    .page-404 {
    margin: auto;
    width: 90%;
 
}
.page-404 .container .text-404 {
    color: #b69c11;
    font-size: 70px;
    animation: zoomeff 6s infinite ease;
}
.errorpagetext {
    font-size: 17px;
}
}

</style>
<body>
  <div class="page-404"><div class="container"><div class="text-404">404</div><p class="errorpagetext">the page you're looking for can't be found.</p><div><p> <a class="home-btn-err" href="<?php echo base_url(); ?>"> Go Home </a> </p></div></div></div>
</body>
</html>