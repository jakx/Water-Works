<!DOCTYPE html >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="author" href="mailto:dainesj@gmail.com" />
<title><?php echo isset($title) ? $title : "Water Works Frame" ?> </title>
<link rel="stylesheet" href="/stylesheets/defaulttemplate.css" type="text/css" media="screen" />
<!--
<script type="text/javascript" src="http://weblabels.fsf.org/www.fsf.org/20130529/files/crm.fsf.org/jquery-1.7.js">
</script>
-->
<meta name="keywords" content="" />
<meta name="description" content="." />
<link rel="shortcut icon" href="/images/favico.ico" />

</head>
<body>

<div id="all-content">

<?php require $BASEDIR . '/includes/header.php' ?>


<div id="default-content">
<?php
 echo $pageContents ;
 ?>
</div>

<div class='spacer2'> </div>

<div id="footer"> 
<?php require $BASEDIR . '/includes/footer.php' ?>
</div>

</div>


</body>

</html>
