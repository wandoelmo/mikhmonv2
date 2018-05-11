<?php
/*
 *  Copyright (C) 2018 Laksamadi Guko.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// hide all error
error_reporting(0);

// get user profile
	$getprofile = $API->comm("/ip/hotspot/user/profile/print");
	$TotalReg = count($getprofile);
// count user profile
	$countprofile = $API->comm("/ip/hotspot/user/profile/print", array(
	  "count-only" => "",));

?>
<div>
<section class="content bg-trp">
<div class="">
<div class="col-12">
<div class="card">
<div class="card-header">
    <h3 class="card-title pull-left">
    <?php
		if($countprofile < 2 ){echo "$countprofile item  ";
  		}elseif($countprofile > 1){echo "$countprofile items   ";}
	?>
	</h3>
</div>
<!-- /.card-header -->
<div class="card-body">
<div id="example2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
<div class="row">
<div class="col-sm-12">
			  
<div class="div-t"> 			   
<table id="tFilter" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
  <thead>
  <tr> 
		<th ></th>
		<th >Name</th>
		<th >Shared<br>Users</th>
		<th >Rate<br>Limit</th>
		<th >Expired Mode</th>
		<th >Validity</th>
		<th >Grace<br>Period</th>
		<th >Price <?php echo $curency;?></th>
		<th >Total<br>User</th>
    </tr>
  </thead>
  <tbody>
<?php

for ($i=0; $i<$TotalReg; $i++){
echo "<tr>";
$profiledetalis = $getprofile[$i];
$pid = $profiledetalis['.id'];
$pname = $profiledetalis['name'];
$psharedu = $profiledetalis['shared-users'];
$pratelimit = $profiledetalis['rate-limit'];
$ponlogin = $profiledetalis['on-login'];

echo "<td style='text-align:center;'><a class='btnsmall' href='./?remove-user-profile=".$pid . "' title='Remove User Profile " . $pname . "'><i class='fa fa-minus-square text-danger'></i></a>&nbsp;&nbsp;&nbsp;<a title='Open User by profile " .$pname. "' class='btnsmall' href='./?user-by-profile=" .$pname . "'><i class='fa fa-users text-dark'></i></a></td>";
echo "<td><a style='color:#000;' title='Open User Profile " . $pname . "' href='./?user-profile=".$pid."'><i class='fa fa-edit'></i> $pname</a></td>";
//$profiledetalis = $ARRAY[$i];echo "<td>" . $profiledetalis['name'];echo "</td>";
echo "<td>" . $psharedu;echo "</td>";
echo "<td>" . $pratelimit;echo "</td>";

echo "<td>";
$getexpmode = explode(",",$ponlogin);
// get expired mode
$expmode = $getexpmode[1];
if($expmode == "rem"){
	echo "Remove";
}elseif($expmode == "ntf"){
	echo "Notice";
}elseif($expmode == "remc"){
	echo "Remove & Record";
}elseif($expmode == "ntfc"){
	echo "Notice & Record";
}else{
	
}
echo "</td>";
echo "<td>";
// get validity
$getvalid = explode(",",$ponlogin);
echo $getvalid[3];

echo "</td>";
echo "<td>";

$getgracep= explode(",",$ponlogin);
echo $getgracep[4];
echo "</td>";

echo "<td style='text-align:right;'>";
// get price
$getprice = explode(",",$ponlogin);
$price = trim($getprice[2]);
if($price == "" || $price == "0" ){
	  echo "";
}else{
	echo " " .number_format($price);
}

echo "</td>";
echo "<td style='text-align:right';>";

$countuser = $API->comm("/ip/hotspot/user/print", array(
    "count-only" => "",
    "?profile" => "$pname",
    ));
	if($countuser < 2 ){echo "$countuser";
  }elseif($countuser > 1){
  echo "$countuser";}
echo  "</td>";
echo "</tr>";
}
?>
  </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
</div>	
