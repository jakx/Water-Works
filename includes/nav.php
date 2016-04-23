

<div id="header">
<div id="nav">

<a href="/">
<h1>
A Water Works Wrame 
</h1>
</a>
</div>
<div id="subnav">
<?php 
if($_SESSION['loggedin']){
?>
 <a href="/examples"><div class="subnav-button"> Examples</div></a>
 <a href="/logout"><div class="subnav-button"> Logout</div></a>
<?php
}
else {
?>
 <a href="/signin"><div class="subnav-button"> Sign-in</div></a>
<?php
}
?>
</div>


