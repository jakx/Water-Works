<div id="order_page">

<table>
<tr class="table-header">
<td> Data 1</td>
<?php 
if(true){
echo "<td>Action </td>";
}
?>
</tr>
<?php

foreach($dataRowViews as $example){
    echo "<tr>";
    echo  $example->htmlRow();
    echo "</tr>";
}
?>
<?php
if(true){
  echo '<tr> <td class="create-button" colspan="2"><a class="create-link" href="/create/example" > Create new model</a></td></tr>';
}

?>
 
</table>


</div>
<div class='spacer2'> </div>
