<?php//验证码都是单独的页面!!!//开启sessionsession_start();//session生存周期setcookie(session_name(),session_id(),time()+86400*7);/***图片验证码类*/class Captcha{    private $width;	//画布的宽度    private $height;	//画布的高度    private $codeNum; //随机数的个数    private $code; //生成的随机数    private $_img; //生成的图片	//构造函数    function __construct($width=80, $height=20, $codeNum=4){        $this->width = $width;        $this->height = $height;        $this->codeNum = $codeNum;    }	//执行创建验证的动作    public function showImg(){        //创建图片        $this->createImg();        //设置干扰元素        //$this->setDisturb();        //设置验证码        $this->setCaptcha();        //输出图片        $this->outputImg();    }	//创建图片    private function createImg(){		//创建一张图像        $this->_img = imagecreatetruecolor($this->width, $this->height);		//创建颜色,后面三个数字指代RGB颜色值 0---255        $bgColor = imagecolorallocate($this->_img, 0, 0, 0);		//背景颜色填充        imagefill($this->_img, 0, 0, $bgColor);    }	//设置干扰元素    private function setDisturb(){        $area = ($this->width * $this->height) / 20;        $disturbNum = ($area > 250) ? 250 : $area;        //加入点干扰        for ($i = 0; $i < $disturbNum; $i++) {            $color = imagecolorallocate($this->_img, rand(0, 255), rand(0, 255), rand(0, 255));			//imagesetpixel()在 image图像中用 color颜色在 x，y 坐标（图像左上角为 0，0）上画一个点。            imagesetpixel($this->_img, rand(1, $this->width - 2), rand(1, $this->height - 2), $color);        }        //加入弧线        for ($i = 0; $i <= 5; $i++) {            $color = imagecolorallocate($this->_img, rand(128, 255), rand(125, 255), rand(100, 255));			//imagearc() 以 cx，cy（图像左上角为 0, 0）为中心在 image 所代表的图像中画一个椭圆弧。w和 h 分别指定了椭圆的宽度和高度，起始和结束点以 s 和 e参数以角度指定。0°位于三点钟位置，以顺时针方向绘画。,第四个和第五个参数指定弧度的大小            imagearc($this->_img, rand(0, $this->width), rand(0, $this->height), rand(30, 300), rand(20, 200), 50, 30, $color);        }    }	//创建随机数    private function createCode(){		//随机码的个数		$_rnd_code = 4;		//创建随机码		$text    = '3456789ABDEFHKMNUWXY';		for($i = 0; $i < $this->codeNum; $i++){			$this->code .= substr($text, rand(0, strlen($text) - 1), 1);		}		//保存在session中,前提是session需要开启		$_SESSION['code'] =  $this->code;		//echo $_SESSION['code'];die;    }	//输出验证码    private function setCaptcha(){		//执行生成四个验证        $this->createCode();        for ($i = 0; $i < $this->codeNum; $i++) {			//创建颜色            $color = imagecolorallocate($this->_img, rand(50,70), rand(100, 250), rand(128, 150));			//设置字体大小            $size = rand(floor($this->height / 2), floor($this->height / 1));			//放置验证的位置            $x = floor($this->width / $this->codeNum) * $i + 5;            $y = rand(0, $this->height - 20);			//imagechar() 将字符串 c 的第一个字符画在 image 指定的图像中，其左上角位于 x，y（图像左上角为 0, 0），颜色为 color。如果 font是 1，2，3，4 或 5，则使用内置的字体（更大的数字对应于更大的字体）。            imagechar($this->_img, $size, $x, $y, $this->code{$i}, $color);        }    }	//输出图片    private function outputImg(){        if (imagetypes() & IMG_JPG) {            header('Content-type:image/jpeg');            imagejpeg($this->_img);        } elseif (imagetypes() & IMG_GIF) {            header('Content-type: image/gif');            imagegif($this->_img);        } elseif (imagetype() & IMG_PNG) {            header('Content-type: image/png');            imagepng($this->_img);        } else {            die("Don't support image type!");        }		//销毁,释放内存		imagedestroy($this->_img);    }}//实例化$captcha = new Captcha(80,30,4);//输出图像$captcha->showImg();