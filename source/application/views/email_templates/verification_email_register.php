<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo lang('ctn_1'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
<br>   
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Dear <?php echo $first_name;?>,</p> 
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Please verify your email address by clicking below link </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><a href="<?php echo base_url();?>newpassword?u=<?php echo urlencode($this->encrypt->encode($user_id));?>"><?php echo base_url();?>newpassword?u=<?php echo urlencode($this->encrypt->encode($user_id));?></a></p>


<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">
Your Login Details below<br>

<table>
	<tr><th>First Name : </th><td><?php echo $first_name;?></td></tr>
	<tr><th>Last Name : </th><td><?php echo $last_name;?></td></tr>
	<tr><th>Email : </th><td><?php echo $email;?></td></tr>
</table>

</p>
</div>
</body>
</html>