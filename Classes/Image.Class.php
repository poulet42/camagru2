<?php
class Image {
  public $image;
  private $type;
  private $path;
  static $entrelacement = 1;
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
  public function __construct($type = "png")
  {
    $this->type = $type;
    //$this->image = call_user_func("imagecreatefrom" . $type, $path);
    //$this->path = $path;
    return $this;
  }
  public function from($args)
  {
    $method = rine($args['method'], 'file');
    $data = rine($args['data']);
    if ($method == 'file')
      $method = $this->type;
    imageinterlace($this->image = call_user_func("imagecreatefrom" . $method, $data), self::$entrelacement);
    return $this;
  }
  public function merge($img, $params)
  {
    $dst_x = (isset($params['dst_x']) ? $params['dst_x'] : 0);
    $dst_y = (isset($params['dst_y']) ? $params['dst_y'] : 0);
    $src_x = (isset($params['src_x']) ? $params['src_x'] : 0);
    $src_y = (isset($params['src_y']) ? $params['src_y'] : 0);
    $width = (isset($params['width']) ? $params['width'] : $img->getWidth());
    $height = (isset($params['height']) ? $params['height'] : $img->getHeight());
    //$transparence = rine($params['transparence'], false);
    //if ($transparence != false)
    //imagecolortransparent($img->image);
    imagecopymerge($this->image, $img->image, $dst_x, $dst_y, $src_x, $src_y, $width, $height, 100);
    return $this;
  }
  /*
  public function display($type = NULL) {
    if ($type == NULL)
      $type = $this->type;
    header('Content-Type: image/' . $type);
    call_user_func("image" . $type, $this->image);
    return $this;
  }*/
  public function scaleCoeff($coeff) {
    $this->image = imagescale($this->image, $this->getWidth() * $coeff);
    return $this;
  }
  public function destroy() {
    imagedestroy($this->image);
  }
  //pas sur de l'utilité : Une class string ???
  public function base64() {
    return base64encode($this->image);
  }
  public function to($args) {
    $path = (!empty($args['path']) && $args['path'] != 'screen' ? $args['path'] : null);
    $type = rine($args['type'], $this->type);
    call_user_func("image" . $type, $this->image, $path);
    return $this;
  }
}