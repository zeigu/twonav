<?php
// +----------------------------------------------------------------------
// | TOPThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://topthink.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// | 类库来源 ThinkPHP
// +----------------------------------------------------------------------

class file{

    private $contents=array();

    /**
     * 架构函数
     * @access public
     */
    public function __construct() {
    }

    /**
     * 文件内容读取
     * @access public
     * @param string $filename  文件名
     * @return string
     */
    public function read($filename,$type=''){
        return $this->get($filename,'content',$type);
    }

    /**
     * 文件写入
     * @access public
     * @param string $filename  文件名
     * @param string $content  文件内容
     * @return boolean
     */
    public function put($filename,$content,$type=''){
        $dir         =  dirname($filename);
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        if(false === file_put_contents($filename,$content)){
           return false;
        }else{
            $this->contents[$filename]=$content;
            return true;
        }
    }

    /**
     * 文件追加写入
     * @access public
     * @param string $filename  文件名
     * @param string $content  追加的文件内容
     * @return boolean
     */
    public function append($filename,$content,$type=''){
        if(is_file($filename)){
            $content =  $this->read($filename,$type).$content;
        }
        return $this->put($filename,$content,$type);
    }

    /**
     * 加载文件
     * @access public
     * @param string $filename  文件名
     * @param array $vars  传入变量
     * @return void
     */
    public function load($_filename,$vars=null){
        if(!is_null($vars)){
            extract($vars, EXTR_OVERWRITE);
        }
        include $_filename;
    }

    /**
     * 文件是否存在
     * @access public
     * @param string $filename  文件名
     * @return boolean
     */
    public function has($filename,$type=''){
        return is_file($filename);
    }

    /**
     * 文件删除
     * @access public
     * @param string $filename  文件名
     * @return boolean
     */
    public function unlink($filename,$type=''){
        unset($this->contents[$filename]);
        return is_file($filename) ? unlink($filename) : false;
    }

    /**
     * 读取文件信息
     * @access public
     * @param string $filename  文件名
     * @param string $name  信息名 mtime或者content
     * @return boolean
     */
    public function get($filename,$name,$type=''){
        if(!isset($this->contents[$filename])){
            if(!is_file($filename)) return false;
           $this->contents[$filename]=file_get_contents($filename);
        }
        $content=$this->contents[$filename];
        $info   =   array(
            'mtime'     =>  filemtime($filename),
            'content'   =>  $content
        );
        return $info[$name];
    }
	/*
	 * 创建一个文件或者目录
	 * $dir 目录名
	 * $file 如果是文件，则设为true
	 * $mode 文件的权限
	 */
	public function cr($dir, $file = false, $mode = 0777)
	{
		$path = str_replace("\\", "/", $dir);
		if (is_dir($path))
			return true;
		if ($file) {
			if (is_file($path))
				return true;
			$temp_arr = explode('/', $path);
			array_pop($temp_arr);
			$dir = implode('/', $temp_arr);
		}
		$mdir = "";
		foreach (explode("/", $dir) as $val) {
			$mdir .= $val . "/";
			if ($val == ".." || $val == "." || trim($val) == "")
				continue;
			if (!is_dir($mdir)) {
				@mkdir($mdir);
				@chmod($mdir, $mode);
			}
		}
		if ($file) {
			$fh = @fopen($path, 'a');
			if ($fh) {
				fclose($fh);
				return true;
			}
		}
		if (is_dir($dir))
			return true;
	}
	/*
	* 删除一个目录或者文件
	*/
	function sc($path_url){

	if(file_exists($path_url)){

		if(is_dir($path_url)){

			$pathdir=@scandir($path_url);

			if(is_array($pathdir)){
				foreach($pathdir as $value){

				if($value !="." && $value !=".."){

					$dir_url="{$path_url}/{$value}";
					
					if(is_dir($dir_url)){

						$this->sc($dir_url);
						
					}
					$this->unlink($dir_url);

				}

				}
			}
			return rmdir($path_url);

		}else{

			if(@unlink($path_url)==false){

				return false;

			}else{

				return true;

			}
		}
	}else{

		return false;

	}
	}
}