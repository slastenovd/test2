<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <div class="container">
    <header>
      <h1><a href="test.php">Lavazza Комсомольск-на-Амуре</a></h1>
      <p class="lead">Самый пиздаттый кофе в городе!</p>
    </header>
    <div class="navbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Домой</a></li>
        <li><a href="#feauters">Описание</a></li>
        <li><a href="#xuinya">Хуйня</a></li>
        <li><a href="#ibata">Ебота</a></li>
      </ul>
    </div>

    <div class="carousel slide" id="carousel-example">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example" data-slide-to="1"></li>
        <li data-target="#carousel-example" data-slide-to="2"></li>
      </ol>

      <div class="carousel-inner">
        <div class="item active">
          <img src="http://lorempixel.com/1170/300/food" alt="Image">
         <div class="carousel-caption"><h3>Кофе реально пиздатый</h3>отвечаем мля... сами тащимся шо ппц!</div>
        </div>
        <div class="item">
          <img src="http://lorempixel.com/1170/300/people" alt="Image">
         <div class="carousel-caption"><h3>Капсулки агонь блеать!!!</h3>сами пьем каждый день!!!</div>
        </div>
        <div class="item">
          <img src="http://lorempixel.com/1170/300/business" alt="Image">
         <div class="carousel-caption"><h3>Напольные автоматы это аще  песня!</h3>поставили целую кучу по городу и всё еще просят!</div>
        </div>

      </div>
      <a href="#carousel-example" class="left carousel-control" data-slide="prev">
      <span class="icon-prev"></span>
      </a>

      <a href="#carousel-example" class="right carousel-control" data-slide="next">
      <span class="icon-next"></span>
      </a>
    </div>

    <section id="features">
      <h3>Преимущества капсул</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui cupiditate assumenda voluptatem quia adipisci, magnam delectus accusamus, quae eaque tempora recusandae molestias maiores omnis. Necessitatibus voluptates praesentium vel nobis autem.</p>
    <hr></section>
    
    <div class="row">
    
      <div class="col-lg-4"> 
        <div class="media">
          <a href="#" class="pull-left">
          <img src="http://lorempixel.com/64/64" alt="Image">
          </a>
          <div class="media-body">
            <h4 class "media-heading">12 сортов!</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt, consequuntur!</p>
          </div>
        </div>
      </div>
    
      <div class="col-lg-4"> 
        <div class="media">
          <a href="#" class="pull-left">
          <img src="http://lorempixel.com/64/64/cats" alt="Image">
          </a>
          <div class="media-body">
            <h4 class "media-heading">12 сортов!</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt, consequuntur!</p>
          </div>
        </div>
      </div>
    
      <div class="col-lg-4"> 
        <div class="media">
          <a href="#" class="pull-left">
          <img src="http://lorempixel.com/64/64/food" alt="Image">
          </a>
          <div class="media-body">
            <h4 class "media-heading">12 сортов!</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt, consequuntur!</p>
          </div>
        </div>
      </div>
    </div>
    <hr>

    <section id="testimonials">
      <div class="panel">
        <div class="panel-heading well well-lg">Отзывы покупателей.</div>
          <div class="row">
            <div class="col-lg-6">
             <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, iusto.<small>John from<cite>Source</cite></small></blockquote>
            </div>
            <div class="col-lg-6">
             <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, iusto.<small>John from<cite>Source</cite></small></blockquote>
            </div>
          </div>
        
      </div>
    </section>

    <section id="order">
      <div class="well well-lg">
        <h3 class="text-center">Order now!</h3>
        <p class="text-center">Receive a great bonus.</p>
        <p class="text-center"><a href="#" class="btn btn-primary">Place order &rarr;</a></p>
      </div>
    </section>

  </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>