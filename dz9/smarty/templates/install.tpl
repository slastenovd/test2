<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Лаба №9 - инсталляция</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


        <div class="container-fluid"> <div class="row"> <div class="col-xs-8 col-sm-4 col-md-2">
                    <form  method="post">
                        <div class="form-group">
                            <label for="ServerName">ServerName</label>
                            <input type="text" class="form-control" id="ServerName" name="ServerName" placeholder="ServerName" value="localhost">
                        </div>
                        <div class="form-group">
                            <label for="UserName">User name:</label>
                            <input type="text" class="form-control" id="UserName" name="UserName" placeholder="UserName" value="test">
                        </div>
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control" id="Password" name="Password" placeholder="Input Password" value="123">
                        </div>
                        <div class="form-group">
                            <label for="Database">Database:</label>
                            <input type="text" class="form-control" id="Database" name="Database" placeholder="Database" value="test">
                        </div>
                        <button type="submit" class="btn btn-default" id="form_submit"  name="main_form_submit">Install</button>
                    </form>      
                </div>
            </div>
        </div>
    </body>
</html>