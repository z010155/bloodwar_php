<?php  include "index_top.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<title><?=TITLE?></title>
<script src="AC_OETags.js" language="javascript"></script>
<script src="bloodwar.js" language="javascript"></script>
<script src="pass.js" language="javascript"></script>
<script src="lang_zh_CN.js" language="javascript"></script>
<style>
div,ul,li,input{margin:0px;padding:0px;}
body {margin:0px;font-family:Arial, Helvetica, sans-serif;overflow:hidden;background:url(images/login_bj.jpg);}
#loginWrap{}
ul,li{list-style:none;}
.wrapper{width:1006px;height:340px;padding:290px 0 0 0;margin:0 auto; background:url(images/dl_001.jpg) no-repeat;}
.main{width:799px;height:326px; margin:0 auto; background:url(images/dl_003.jpg) repeat-y;}
.maintop{height:53px; background:url(images/dl_002.jpg) no-repeat;}
.mainbom{height:326px; background:url(images/dl_004.jpg) no-repeat bottom;}
.maincenn{ padding:0 21px;height:252px;}
.mainleft{width:289px;height:252px; background:url(images/dl_006.jpg) no-repeat; float:left;}
.div1{background:url(images/dl_005.jpg) no-repeat bottom;height:252px;padding-left:12px;color:#EFDA9D;font-size:12px;line-height:21px; overflow-x:hidden;overflow-y:scroll;
scrollbar-3dlight-color: #ACAB8D;  /*图1,立体滚动条亮边的颜色*/
scrollbar-highlight-color: #23231E;  /*图2,滚动条空白部分的颜色*/
scrollbar-shadow-color: #353429;  /*图3,立体滚动条阴影的颜色*/
scrollbar-darkshadow-color: #666;  /*图4,151515*/
scrollbar-face-color: #6F6F5E;  /*图5,立体滚动条的颜色*/
scrollbar-arrow-color: #23231F;  /*图6,三角箭头的颜色*/
scrollbar-track-color: #1B1B14;  /*图7,立体滚动条背景颜色*/
scrollbar-base-color:#f8f8f8; }
.div1 p{text-indent:2em; padding:8px 10px 0 0;}
.div1 h1{font-size:12px;padding-top:10px;}
.mainright{width:450px;height:252px; background:url(images/dl_008.jpg) no-repeat; float:right;}
.div2{background:url(images/dl_009.jpg) no-repeat bottom;height:252px;}
.logins{width:412px;height:163px; padding-top:8px;background:url(images/dl_010.jpg) no-repeat 0 8px; margin:0 auto; margin-bottom:5px;}
.Ids{padding-top:26px;padding-left:105px;font-size:14px;color:#DCDCDC;}.Ids_1{padding-top:21px;*padding-top:14px;}
.Ids .texts{background:none;border:none;height:22px;color:#FFCE00;font-size:14px;line-height:22px;width:166px;font-weight:700; margin-right:10px;}
.AD{width:402px;height:65px;border:2px #000 solid;margin:0 auto;}
.AD img{border:0;}
.butts{padding-top:13px; height:35px; padding-left:50px;}
.but_1,.but_2,.but_2 a,.but_2 a:hover{cursor:pointer;width:113px;height:34px;font-size:16px;font-family:"微软雅黑", "黑体";font-weight:700;color:#FFFFFF;border:none; background:none;background:url(images/dl_013.jpg) no-repeat; margin-right:8px;float:left;}
.but_2,.but_2 a,.but_2 a:hover{width:94px; background:url(images/dl_012.jpg) no-repeat;color:#EFDA9D;font-size:14px; display:block;  text-align:center; line-height:34px;}
.but_2 a,.but_2 a:hover{text-decoration:none;margin-right:0;}.but_2 a:hover{color:#fff;}
</style>
<?php  if (is_callable(index_head)) index_head(); ?>
<script>
 function getWangye173Auth()
 {
	return "<?=$auth?>";
 }
 function goRegister(){
   window.open(getRegisterUrl());
 } 
 function $(id){
	return document.getElementById(id);
 }
 function goHome(){
   window.open(getHomeUrl());
 }
 function getServerUrl(){
 	return getEndPoint().replace("server/amfphp/gateway.php","");
 }
 function showLogin(){
 	 window.location.reload();
 	/*
    document.body.style.background="url(images/login_bj.jpg)";    
 	$("loginWrap").style.display = "";	
    $("flashWrap").style.display = "none";    
    */
 }
function showFlash(){
	 document.body.style.background="black";
	 $("loginWrap").style.display = "none";	
	 $("flashWrap").style.height="600px";
	 getFlashMovieObject("BloodWar").height=600;
     $("flashWrap").style.display = "";
}
 $onLoginInterval=null;
 var process_sumbitLogin=false;
 function submitLogin(){
 	var username=$("txt_Login_UserName").value;
 	var password=$("txt_Login_Password").value;
 	
 	var result = checkUserName_login(username);
    if(result!=true) {alert(result);$("txt_Login_UserName").focus();return false;}
                    
    var result = checkPasssord_login(password);
    if(result!=true) {alert(result);$("txt_Login_Password").focus();return false;}   
    if (process_sumbitLogin){
    	alert("登录中，请稍候...");
    	return false;
    }
    process_sumbitLogin=true;
    loadJS(getServerUrl()+"server/game/forlogin.php?type=0&passport="+encodeURIComponent(username)+"&password="+password+"&passtype="+getPassType());
 }
 function setAnnounce(announce){
	$("announce").innerHTML = announce;
 }
 var loadJS = function(path, callBack){
        var nNode = document.createElement('script');
        nNode.src = path;
        // callback
        var ready = function(){
                if(callBack){
                        if(typeof(callBack) == "string") eval(callBack)(nNode);
                        else if(typeof(callBack) == "function") callBack(nNode);
                }
        };
        // add script tag to doc head
        nNode.onload = function(){ ready(); };
        nNode.onreadystatechange = function(){ if(nNode.readyState == "loaded") ready(); };
        document.getElementsByTagName("head")[0].appendChild(nNode);
};

 function loginNow(checkPassResult){
    if (checkPassResult==1){
    	alert("账号或者密码输入错误");
    	process_sumbitLogin=false;
    	return ;
    }
    alert("登陆成功");
 }
 function getInputLoginValues(){ 	 
 	var checked_username=$("checked_Login_UserName").checked;
 	var checked_Login_Password=$("checked_Login_Password").checked;
 	 var username=$("txt_Login_UserName").value;
 	var password=$("txt_Login_Password").value;
	return {"username":username,"password":password,"checked_username":checked_username,"checked_Login_Password":checked_Login_Password};
 }
 //登录时验证通行证帐号
function  checkUserName_login(name){      
        if(name.length == 0){
            return "请输入登录名！";
        }        
        return true;     
}
//验证密码
function checkPasssord_login(pwd){
    if(pwd.length == 0){
       return "请输入密码！";
    }
    return true;
}
function selectPassword(){
   if ($("checked_Login_Password").checked==false) return ;
   if(confirm("为了您的帐号安全，如果您在公共场合上网，请不要选择记住密码，以避免账号被他人盗用。")){
   	return true;
   }else return false;
}
function init(){
		if (false==getAutoLogin() && getWangye173Auth() == ""){ //需要登陆的先显示登陆界面
		    $("loginWrap").style.display = "";	
		    var savedUsername=getSavedUsername();
		    var savedPassword=getSavedPassword();
		    if (savedUsername) {
		    	$("checked_Login_UserName").checked =true;
		    	$("txt_Login_UserName").value =savedUsername;
		    }
		    if (savedPassword) {
		    	$("checked_Login_Password").checked =true;
		    	$("txt_Login_Password").value =savedPassword;
		    }	    
		    $("txt_Login_UserName").focus();
		    //加载公告
		    loadJS(getServerUrl()+"server/game/forlogin.php?type=1");
		    $("flashWrap").style.height="1px";
		    $("flashWrap").style.display="";
		    getFlashMovieObject("BloodWar").height=1;
		}else
	   	  showFlash();
}
</script>
</head>
<body bgcolor=black leftmargin="0"  topmargin="0"    onfocus="focusflash();" onresize="resetiframe();">
<!-- ***********flash Content begin************-->
<TABLE width=1000 height=600 align=center border="0" cellpadding="0" cellspacing="0" id="flashWrap" style="display:none;">
<TR>
	<TD align=center valign=top>
<script language="JavaScript" type="text/javascript">
<!--
// Globals
// Major version of Flash required
var requiredMajorVersion = 9; 
// Minor version of Flash required
var requiredMinorVersion = 0;
// Minor version of Flash required
var requiredRevision = 124;	
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);


// Check to see if a player with Flash Product Install is available and the version does not meet the requirements for playback
if ( hasProductInstall && hasRequestedVersion ) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
			"src", "BloodWar",
			"width", "1000",
			"height", "600",
			"align", "middle",
			"id", "BloodWar",
			"quality", "high",
			"wmode","transparent",
			"bgcolor", "#000000",
			"name", "BloodWar",
			"allowScriptAccess","sameDomain",
			"type", "application/x-shockwave-flash",
			"pluginspage", "http://www.adobe.com/go/getflashplayer"
	);
  } else {  // flash is too old or we can't detect the plugin
  var alternateContent = '<br/><br/><br/><br/><br/><br/><div align="center"><p><img src="noflash.jpg" width="476" height="230" border="0" usemap="#Map" /><map name="Map" id="Map"><area shape="rect" coords="63,105,218,129" href="http://sg.uuyx.com/uploadfile/install_flash_player_active_x_9f.exe" target="_blank" alt="点击下载安装Flash" /><area shape="rect" coords="56,181,228,211" href="http://sg.uuyx.com/uploadfile/install_flash_player_active_x_9f.rar" target="_blank" alt="点击下载Flash安装包" /></map></p></div>';
    document.write(alternateContent);  // insert non-flash content
  }
// -->
</script>
<noscript>
  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="BloodWar" width="1000" height="600"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="BloodWar.swf" />
			<param name="quality" value="high" />
			<param name="wmode"   value="transparent">   
			<param name="bgcolor" value="#000000" />
			<param name="allowScriptAccess" value="sameDomain" />
			<embed src="BloodWar.swf" quality="high" bgcolor="#000000"
				width="1000" height="600" name="BloodWar" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowScriptAccess="sameDomain"
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
</noscript>
</TD>
</TR>
</TABLE>

<!-- ***********flash Content begin************-->

<!-- ***********login Content begin************-->
<div id="loginWrap" style="display:none;">
<div class="wrapper" >
<div class="main">
<!--底部-->
<div class="mainbom">
<!--标题栏目-->
<div class="maintop">

</div><!--END 标题栏目-->
<!--内容-->
<div class="maincenn">
<!--左侧栏-->
<div class="mainleft"><div class="div1" id="announce"></div></div>
<!--END 左侧栏-->
<!--右侧栏-->
<div class="mainright">
<div class="div2">
<!--登录-->
<div class="logins">
<div class="Ids"><input name="txt_Login_UserName" id="txt_Login_UserName" type="text" class="texts" tabindex=1 onkeypress="if(event.keyCode==13) submitLogin(); "/>
  <label>
 <input name="checked_Login_UserName" id="checked_Login_UserName" type="checkbox" /> 记住账号
  </label>
</div>
<div class="Ids Ids_1"><input name="txt_Login_Password" id="txt_Login_Password"  type="password" class="texts" tabindex=2 onkeypress="if(event.keyCode==13) submitLogin(); "/><label>
 <input id="checked_Login_Password" type="checkbox"  onclick="return selectPassword()"/> 记住密码
  </label></div>
  <div class="butts"><input name="" type="button" value="登录游戏" onclick="submitLogin();return false;" class="but_1" tabindex=3/><b class="but_2"><a href="#" onclick="goRegister();return false;">注册账号</a></b><b class="but_2"><a href="#" onclick="goHome();return false;">官方网站</a></b></div>
</div>
<!--登录-->
<!--广告-->
<div class="AD"><a href="#"><img src="images/dl_011.jpg" border="0" /></a></div>
<!--广告-->
</div>
</div>
<!--END 右侧栏-->
</div>
<!--END 内容目-->
</div>
<!--END 底部-->
</div>
</div>
</div>
<!-- ***********login Content end************-->	
	
<div style="overflow:auto;z-index:100;"> 
<iframe id="content" frameborder="0"  name="content" scrolling="auto"  style="position:absolute;background-color:transparent;border:0px;visibility:hidden;" allowtransparency="true">
</iframe>
</div>
<script>
    init();
</script>
<?php  if (is_callable(index_bottom)) index_bottom(); ?>
</body>
</html>