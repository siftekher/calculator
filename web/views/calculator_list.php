<!DOCTYPE html>

<html>
<head>
  <title>Math expression demo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://drvic10k.github.io/bootstrap-sortable/Contents/bootstrap-sortable.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
  <script src="https://drvic10k.github.io/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

</head>

<body>
    <div class="container">
      <h1>Math expression</h1>
      <div class="row">
          <?php if(isset($error)) {?>
          <div class="col-xs-12 section5 ">
                 <label style="color:red;">Error: <?php echo $error; ?> </label>
          </div>
          <?php } ?>
          <div class="col-xs-12 section5 ">
             <form name="contentForm" enctype="multipart/form-data" method="POST" action="/calculator/run.php/Calculator/calculate_expression" role="form" data-toggle="validator" novalidate="true">
                 <input type="text" name="expression" size="100" placeholder="Expression">
                 <input type="submit" value="Calculate">
             </form>
          </div>
          <?php if(isset($result)) {?>
          <div class="col-xs-12 section5 ">
                 <label>Result: <?php echo $result; ?> </label>
          </div>
          <?php } ?>
      </div>
    </div>
</body>

</html>