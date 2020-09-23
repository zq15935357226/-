<?php
/* 右侧*/
$base_dir = dirname(__FILE__).'../../../';
require_once($base_dir.'config/config.php');
require_once($base_dir.'inc/init.php');
require_once($base_dir.'inc/func.php');
require_once($base_dir.'model/clsFunc.php');

?>
<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <title>管理界面</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="stylesheet" href="./js/AmazeUI-2/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="./js/AmazeUI-2/assets/css/app.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/AmazeUI-2/assets/js/jquery.min.js"></script>
  <script src="./js/AmazeUI-2/assets/js/amazeui.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <style>
    .am-tabs-nav li {
      position: relative;
      z-index: 1;
    }

    .am-tabs-nav .am-icon-close {
      position: absolute;
      top: 0;
      right: 10px;
      color: #888;
      cursor: pointer;
      z-index: 100;
    }

    .am-tabs-nav .am-icon-close:hover {
      color: #333;
    }
    .am-tabs-nav .am-icon-close ~ a {
      padding-right: 25px!important;
    }
    /* #doc-tab-demo-1{
       background-color: #D7EDFB;
     }*/
  </style>
</head>
<body >

<div class="am-tabs" data-am-tabs="{noSwipe: 1}" id="doc-tab-demo-1" class="col-sm-12">
  <div id="gonggao" style="position:relative; height: 100%" >
    <!--<img src="ad.jpg">-->
    <div class="text-center" style="position:absolute ; width:760px;height: 360px;left:150px;top:135px;">
      <h1>欢迎来到17VS管理后台 </h1>
      <p> </p>
    </div>
  </div>
  <ul class="am-tabs-nav am-nav am-nav-tabs">
  </ul>

  <div class="am-tabs-bd" id="am-tabs-bd" style="">
  </div>
</div>

<script>

  var tabCounter = 0;
  var $tab = $('#doc-tab-demo-1');
  var $nav = $tab.find('.am-tabs-nav');
  var $bd = $tab.find('.am-tabs-bd');

  var tabs = [];

  function addTab(title, url) {
    $('#gonggao').hide();
    var nav = '<li><span class="am-icon-close"></span>' +
        '<a href="javascript: void(0)">' + title + '</a></li>';
    var content = '<div class="am-tab-panel" style="height:'+(tabHeight-00)+'px"> <iframe width="100%" height="100%" src="'+url+'"></iframe> </div>';

    var curIndex = -1;
    for(var idx in tabs)
    {
      if(tabs[idx].title == title)
      {
        curIndex = idx;
        break;
      }
    }
    if(curIndex == -1)
    {
      $nav.append(nav);
      $bd.append(content);
      tabCounter++;
      tabs[tabCounter-1] = {'title':title,'url':url};
      curIndex = $bd.children().length-1;
      $tab.tabs('refresh');
      $tab.tabs('open', curIndex);
      $tab.tabs('refresh');
    }
    else
    {
      //$tab.tabs('open', curIndex);
      //$tab.tabs('refresh');
      $nav.children('li').eq(curIndex).children().eq(1).click();
      //$bd.children('div').eq(curIndex).children().eq(0).document.location.reload(true);
      //$bd.children('div').eq(0).children('iframe').eq(0).context.location.reload();
      $bd.children('div').eq(curIndex).children('iframe')[0].contentWindow.location.reload();
    }
  }
  $nav.on('click', '.am-icon-close', function() {
    var $item = $(this).closest('li');
    var index = $nav.children('li').index($item);

    $item.remove();
    $bd.find('.am-tab-panel').eq(index).remove();

    delete tabs[index];
    var newtabs = [];
    var idx = 0;
    for(var i in tabs)
    {
      newtabs[idx] = tabs[i];
      ++idx;
    }
    tabs = newtabs;
    tabCounter = idx;
    $tab.tabs('open', index > 0 ? index - 1 : index + 1);
    $tab.tabs('refresh');
  });

  var tabHeight = window.innerHeight-40;
  /*$('#am-tabs-bd').css('height',tabHeight);*/

</script>
<?php exit;?>
</body>
</html>
