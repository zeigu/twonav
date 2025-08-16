<?php
/*
	路径
*/
defined('LUJING')or define('LUJING',dirname($_SERVER['SCRIPT_FILENAME']).'/');

//定义字体路径
$ziti = LUJING.'zt/simhei.ttf';

$ziti1 = LUJING.'zt/zzgf.ttf';

$ziti2 = LUJING.'zt/weiruanyahei.ttf';

$ziti3 = LUJING.'zt/fangzhegnzongyi.ttf';

$ziti4 = LUJING.'zt/fangzhegncuyuan.ttf';


/*********************************************************************************
/
/
/				以下为横幅制作
/
/
/*********************************************************************************/



if ($_GET['t'] == 't1'){
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/1/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'238','15','15',0);

$coll2 = imagecolorallocatealpha($dst,'45','96','241',0);

$coll1 = imagecolorallocatealpha($dst,'255','255','255',0);

/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'26',0,110,42,$coll,$ziti3, $_GET["a"]);

imagettftext($dst,'19',0,100,80,$coll2,$ziti, $_GET["b"]);

imagettftext($dst,'16',0,308,40,$coll1,$ziti, $_GET["c"]);

imagettftext($dst,'16',0,500,40,$coll1,$ziti, $_GET["d"]);

imagettftext($dst,'16',0,700,40,$coll1,$ziti, $_GET["e"]);

imagettftext($dst,'16',0,855,40,$coll1,$ziti, $_GET["f"]);

imagettftext($dst,'18',0,310,80,$coll,$ziti, $_GET["h"]);


/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);


}elseif($_GET['t'] == 't2'){
	
	
	
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/2/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'238','15','15',0);

$coll2 = imagecolorallocatealpha($dst,'45','96','241',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'24',0,120,33,$coll,$ziti, $_GET["a"]);

imagettftext($dst,'15',0,120,62,$coll2,$ziti, $_GET["b"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 't3'){
	
	
	
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/3/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'255','177','17',0);

/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'30',0,150,50,$coll,$ziti, $_GET["a"]);


/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 't4'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/4/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'16','131','221',0);

$coll1 = imagecolorallocatealpha($dst,'61','255','249',0);

$coll2 = imagecolorallocatealpha($dst,'253','0','227',0);

/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'15',0,58,35,$coll,$ziti, $_GET["a"]);

imagettftext($dst,'13',0,58,54,$coll,$ziti, $_GET["b"]);

imagettftext($dst,'35',0,165,52,$coll1,$ziti3, $_GET["c"]);

imagettftext($dst,'35',0,550,52,$coll2,$ziti3, $_GET["d"]);


/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 't5'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/5/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'255','255','255',0);

$coll1 = imagecolorallocatealpha($dst,'1','54','123',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'26',0,25,60,$coll,$ziti3, $_GET["a"]);

imagettftext($dst,'30',0,350,60,$coll1,$ziti3, $_GET["b"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 't6'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/6/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'255','255','0',0);

$coll1 = imagecolorallocatealpha($dst,'255','255','255',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'18',0,90,25,$coll,$ziti3, $_GET["a"]);

imagettftext($dst,'18',0,290,25,$coll1,$ziti3, $_GET["b"]);

imagettftext($dst,'14',0,90,55,$coll1,$ziti3, $_GET["c"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 't7'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/7/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'255','255','0',0);

$coll1 = imagecolorallocatealpha($dst,'255','255','255',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'12',0,43,21,$coll1,$ziti3, $_GET["a"]);

imagettftext($dst,'10',0,43,35,$coll1,$ziti3, $_GET["b"]);

imagettftext($dst,'30',0,170,45,$coll1,$ziti3, $_GET["c"]);

imagettftext($dst,'18',0,170,80,$coll1,$ziti3, $_GET["d"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 't8'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/8/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'0','0','0',0);
$coll2 = imagecolorallocatealpha($dst,'255','0','0',0);
$coll1 = imagecolorallocatealpha($dst,'255','255','255',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'25',0,148,55,$coll,$ziti3, $_GET["a"]);

imagettftext($dst,'25',0,315,55,$coll2,$ziti3, $_GET["b"]);

imagettftext($dst,'20',0,780,55,$coll1,$ziti3, $_GET["c"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 't9'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/9/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'253','253','8',0);
$coll1 = imagecolorallocatealpha($dst,'255','255','255',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'35',0,46,55,$coll1,$ziti3, $_GET["a"]);

imagettftext($dst,'35',0,450,55,$coll1,$ziti3, $_GET["b"]);

imagettftext($dst,'35',0,720,55,$coll,$ziti3, $_GET["c"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 't10'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/10/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'255','255','255',0);
$coll1 = imagecolorallocatealpha($dst,'255','0','0',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'29',0,10,46,$coll1,$ziti3, $_GET["a"]);

imagettftext($dst,'15',0,250,25,$coll,$ziti4, $_GET["b"]);

imagettftext($dst,'15',0,252,50,$coll,$ziti4, $_GET["c"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}









/*********************************************************************************
/
/
/				以下为店标制作
/
/
/*********************************************************************************/









if($_GET['t'] == 'd1'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/db/1/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'26','17','15',0);



$coll1 = imagecolorallocatealpha($dst,'0','123','60',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'35',0,7,150,$coll,$ziti3, $_GET["a"]);
imagettftext($dst,'20',0,6,192,$coll1,$ziti, $_GET["b"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 'd2'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/db/2/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'26','17','15',0);



$coll1 = imagecolorallocatealpha($dst,'75','75','75',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'20',0,20,150,$coll,$ziti3, $_GET["a"]);
imagettftext($dst,'15',0,20,180,$coll1,$ziti, $_GET["b"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}

















/*********************************************************************************
/
/
/				以下为横幅制作
/
/
/*********************************************************************************/



if($_GET['t'] == 'logo1'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/logo/1/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'90','180','90',0);



$coll1 = imagecolorallocatealpha($dst,'75','75','75',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'45',0,8,50,$coll,$ziti1, $_GET["a"]);
imagettftext($dst,'20',0,133,30,$coll,$ziti, $_GET["b"]);
imagettftext($dst,'17',0,140,55,$coll1,$ziti, $_GET["c"]);



/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 'logo2'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/logo/2/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'112','112','112',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'30',0,68,37,$coll,$ziti4, $_GET["a"]);
imagettftext($dst,'25',0,67,68,$coll,$ziti, $_GET["b"]);


/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 'logo3'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/logo/3/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'112','112','112',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'28',0,78,37,$coll,$ziti, $_GET["a"]);
imagettftext($dst,'18',0,78,63,$coll,$ziti, $_GET["b"]);


/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}elseif($_GET['t'] == 'logo4'){
		
	
//输出协议头
header('Content-Type: image/png');
 
 //背景图
$dst_path = './img/logo/4/chengfeng.png';

/*
	imagecreatefromstring 从字符串中的图像流新建一图像
	file_get_contents 把整个文件读入一个字符串中

*/
$dst = imagecreatefromstring(file_get_contents($dst_path));

/*
	imagecolorallocatealpha 为一幅图像分配颜色和透明度
*/

$coll = imagecolorallocatealpha($dst,'112','112','112',0);


/*
	imagettftext 用 TrueType 字体向图像写入文本
	imagettftext(图像,字体,角度,坐标,坐标,颜色,字体,文本字符串);
*/
imagettftext($dst,'24',0,62,35,$coll,$ziti, $_GET["a"]);
imagettftext($dst,'18',0,67,62,$coll,$ziti, $_GET["b"]);


/*
	getimagesize() 函数用于获取图像大小及相关信息，成功返回一个数组，失败则返回 FALSE 并产生一条 E_WARNING 级的错误信息。
	list — 把数组中的值赋给一组变量 
*/
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

/*
	imagepng — 以 PNG 格式将图像输出到浏览器或文件
*/
imagepng($dst);

/*
	imagedestroy 销毁一图像
*/
imagedestroy($dst);	

}