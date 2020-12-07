<?php

namespace app\model;

use think\Model;

class First extends Model
{
  protected $table = "cn_first";

  public function text()
  {
    dump(1);
    // dump($this->where("id", ">", 0)->select());
    return $this->where("id", ">", 0)->select();
    // return $this->where("id", ">", 0)->find();

  }
}
