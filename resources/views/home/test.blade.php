<!DOCTYPE html>
<html>
<head>
<title>Laravel Test Page</title>
</head>
<body>

<h1>Laravel Test</h1>
  Id no: {{$id}} <br>
  name : {{$name}}
<?php //blade içinde php de kullanabiliyosunuz
  echo "Id Number :", $id;
  echo "          Name:", $name;
?>

<a href="{{route('home')}}">Ana Sayfa</a>
</body>
</html>