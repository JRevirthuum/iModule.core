<?php
/**
 * 이 파일은 iModule 의 일부입니다. (https://www.imodule.kr)
 *
 * PHP에서 사용중인 변수를 자바스크립트에 등록한다.
 * 
 * @file /scripts/php2js.js.php
 * @author Arzz (arzz@arzz.com)
 * @license MIT License
 * @version 3.0.0
 * @modified 2018. 5. 27.
 */
REQUIRE_ONCE str_replace(DIRECTORY_SEPARATOR.'scripts','',__DIR__).'/configs/init.config.php';
header('Content-Type: application/x-javascript; charset=utf-8');

$language = Request('language');
$menu = Request('menu');
$page = Request('page');
$view = Request('view');
$container = Request('container');
?>
var ENV = {
	DIR:"<?php echo __IM_DIR__; ?>",
	VERSION:"<?php echo __IM_VERSION__; ?>",
	LANGUAGE:"<?php echo $language; ?>",
	MENU:<?php echo $menu ? '"'.$menu.'"' : 'null'; ?>,
	PAGE:<?php echo $page ? '"'.$page.'"' : 'null'; ?>,
	VIEW:<?php echo $view ? '"'.$view.'"' : 'null'; ?>,
	CONTAINER:<?php echo $container ? '"'.$container.'"' : 'null'; ?>,
	IS_CONTAINER_POPUP:<?php echo $container && preg_match('/\/@[^\/]+$/',$container) == true ? 'true' : 'false'; ?>,
	getProcessUrl:function(module,action) {
		return ENV.DIR+"/"+ENV.LANGUAGE+"/process/"+module+"/"+action;
	},
	getApiUrl:function(module,api) {
		return ENV.DIR+"/api/"+module+"/"+api;
	},
	getModuleUrl:function(module,container,view,idx) {
		var view = view === undefined ? null : view;
		var idx = idx === undefined ? null : idx;
		
		var url = ENV.DIR;
		url+= "/" + ENV.LANGUAGE + "/module/" + module + "/" + container;
		if (view === null || view === false) return url
		url+= "/"+view;
		if (idx === null || idx === false) return url;
		url+= "/"+idx;
		
		return url;
	},
	getUrl:function(menu,page,view,idx) {
		if (menu === false) return ENV.DIR + "/" + ENV.LANGUAGE;
		if (ENV.CONTAINER !== null) return ENV.getModuleUrl(ENV.CONTAINER.split("/").shift(),ENV.CONTAINER.split("/").pop(),view,idx);
		
		var menu = menu === undefined ? null : menu;
		var page = page === undefined ? null : page;
		var view = view === undefined ? null : view;
		var idx = idx === undefined ? null : idx;
		
		menu = menu === null ? ENV.MENU : menu;
		page = page === null && menu == ENV.MENU ? ENV.PAGE : page;
		view = view === null && menu == ENV.MENU && page == ENV.PAGE ? ENV.VIEW : view;
		
		var url = ENV.DIR;
		url+= "/" + ENV.LANGUAGE;
		if (menu === null || menu === false) return url;
		url+= "/" + menu;
		if (page === null || page === false) return url;
		url+= "/" + page;
		if (view === null || view === false) return url;
		url+= "/" + view;
		if (idx === null || idx === false) return url;
		url+= "/" + idx;
		
		return url;
	}
};