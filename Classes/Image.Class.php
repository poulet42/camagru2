<?php
class Photo {
    public $image;
    private $type;
    private $path;
    public function getWidth() 
    {
        return imagesx($this->image);
    }
    public function getHeight() 
    {
        return imagesy($this->image);
    }
    public function getType()
    {
        return $this->type;
    }
    public function __construct($path, $type = "png")
    {
        $this->type = $type;
        $this->image = call_user_func("imagecreatefrom" . $type, $path);
        $this->path = $path;
    }
    public function merge($img, $params)
    {
        $dst_x = (isset($params['dst_x']) ? $params['dst_x'] : 0);
        $dst_y = (isset($params['dst_y']) ? $params['dst_y'] : 0);
        $src_x = (isset($params['src_x']) ? $params['src_x'] : 0);
        $src_y = (isset($params['src_y']) ? $params['src_y'] : 0);
        $width = (isset($params['width']) ? $params['width'] : $img->getWidth());
        $height = (isset($params['height']) ? $params['height'] : $img->getHeight());
        return imagecopymerge($this->image, $img->image, $dst_x, $dst_y, $src_x, $src_y, $width, $height, 100);
    }
    public function display() {
        call_user_func("image" . $this->type, $this->image);
    }
    public function scaleCoeff($coeff) {
        $this->image = imagescale($this->image, $this->getWidth() * $coeff);
    }
}