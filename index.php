<?php
/*
 * 用途：显示店铺信息和店铺商品
 * 作者：feb1234@163.com
 * 时间：2015-07-25
 * */
//error_reporting(7);

$base_dir = dirname(__FILE__).'/../../';
require_once($base_dir.'inc/init.php');
require_once($base_dir.'config/config.php');
require_once($base_dir.'model/clsAuthUsers.php');

$user = new AuthUsers();
$uinfo = $user->IsAuthLogin();
if($uinfo === false)
{
  $title = "登陆";
  if(!empty($_POST))
  {
    $type = GetItemFromArray($_POST, 'type');
    if($type == 'login')
    {
      $uid = $user->CheckAuthUser($_POST);
      if($uid !== false)
      {
        $uinfo = $user->IsAuthLogin();
      }
    }
  }
}

if($uinfo !== false)
{
  $title = 'WIKI编辑';
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.4.3/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.4.3/themes/icon.css">
  <script type="text/javascript" src="js/jquery-easyui-1.4.3/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-easyui-1.4.3/jquery.easyui.min.js"></script>
  <title><?php echo $title;?></title>
</head>

<?php if($uinfo === false) { ?>
<body>
  <div class="container">
  <div class="row">
  <div class="row" style="margin:20px 0 20px 0">
    <h4 class="text-center">管理员登陆</h4>
  </div>
  <form method="post" class="form-horizontal">
    <input type="hidden" name="type" value="login" />
    <div class="form-group">
      <div class="col-xs-8 col-xs-offset-2">
        <input class="form-control" id="mobileinput" name="name" placeholder="用户名(邮箱)" />
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-8 col-xs-offset-2">
        <input class="form-control" id="pwdinput" name="passwd" type="password" placeholder="密码" />
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-offset-2 col-xs-8 text-left">
        <button value="登  陆" class="btn btn-default" onclick="javascript:return login();" >登&nbsp;&nbsp;陆</button>
      </div>
    </div>
  </form>
  </div>
  </div>
</body>
  <?php } else { ?>
	<frameset cols="100%" border=1>
<!--		<frame src="menu.php" />-->
		<frame src="wiki.php" name="show"/>
	</frameset>
  <?php }  ?>
</html>

