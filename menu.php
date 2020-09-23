<?php
/*
 * 用途：显示左边的菜单
 * 作者：feb1234@163.com
 * 时间：2015-07-26
 * */
$base_dir = dirname(__FILE__).'/../../';
require_once($base_dir.'inc/init.php');
require_once($base_dir.'config/config.php');
require_once($base_dir.'inc/func.php');
require_once($base_dir.'model/clsAuthUsers.php');

$user = new AuthUsers();

$uinfo = $user->IsAuthLogin();

if($uinfo === false)
  GotoUrl('index.php');

$finfos = $user->gettierlevel($type=STATE_NOR);

//var_dump($finfos);
$afids = $user->getmenu($uinfo['auid']);
$ret = $user->judgeuserfuncbyuidandafid($uinfo['auid'],50);
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
    <script type="text/javascript" src="js/jquery-1.8.3.js" ></script>
    <script type="text/javascript" src="js/init.js" ></script>
    <script type="text/javascript" src="js/echarts.min.js" ></script>
</head>
<body>
  <div class="row" style="margin:10px 20px 10px 5px">
    <div style="float:left;margin-top:06px"><?php echo $uinfo['aumobile'];?></div>
    <form method="post" action="funcaction.php">
      <input type="hidden" id="type" name="type" value="logout" />
      <a class="btn btn-link" href="logout.php" >退出</a>
    </form>
  </div>
  <div class="easyui-panel" style="padding:15px;">
	<ul class="easyui-tree">
		<?php 
			foreach($finfos as $finfo )
			{
				if( in_array($finfo['afid'],$afids) )
				{
					echo '<li><span>'.$finfo['afname'].'</span><ul>';
					foreach($finfo['twolevel'] as $twofinfo )
					{
						
						if(in_array($twofinfo['afid'],$afids) )
						{
							echo '<li><span><a href="#/'.$twofinfo['afurl'].'" onclick="clickme(this);">'.$twofinfo['afname'].'</a></span></li>';
						}
					}
					echo '</ul></li>';
				}
			}
       ?>
	</ul>

  </div>


<!--<embed id="workermus" src="/js/worker.mp3" type=audio/mpeg autostart=true hidden=true loop=true width=1px height=1px />
<embed id="ordermus"   src="/js/order.mp3" type=audio/mpeg autostart=true hidden=true loop=true width=1px height=1px />-->
<audio id="awards" controls="false" style="height:0;width:0;display:none">
    <source src="js/awards.mp3">你的浏览器不支持video标签。</audio>
<audio id="17UG" controls="false" style="height:0;width:0;display:none">
    <source src="js/17UG.mp3">你的浏览器不支持video标签。</audio>

<script type="text/javascript">
var state = 0; 

<?php //if($uinfo['auid'] != 1) { ?>
loopquery('awards');
//jump();
setTimeout('1+1;', 4000);
loopquery('shop');
<?php //} ?>

function loopquery(new_type)
{

  var subtype = new_type;
  var type = 'check_untreated_order';
    <?php
    $params = array('type','subtype');
    echo generate_ajax($params, 'loopquerycallback');
    ?>

  setTimeout("loopquery('"+subtype+"')", 60000);
}

function loopquerycallback(data)
{
  var subtype = data.subtype;

  if(data.untreated_state == 1)
  {
    if(subtype == 'awards')
    {
      document.getElementById('awards').play();
    }
    else if(subtype == 'shop')
    {
      document.getElementById('17UG').play();
    }
  }
}

function clickme(obj)
{
  var href = obj.href;
  var pos = href.indexOf('#');
  var url = href.substr(pos+1);
  var title = obj.innerHTML;
  self.parent.frames['show'].addTab(title,url);
}

function jump(){
    var type = 'GeTuntreatedinfos';
    <?php
    $params = array('type');
    echo generate_ajax($params,'tishi');
    ?>
    setTimeout("jump()", 60000); //每个五秒调用一次函数
}

function tishi(data)
{

}
</script>
</body>
</html>

