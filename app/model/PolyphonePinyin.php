<?php

namespace app\model;

use think\Model;

class PolyphonePinyin extends Model
{
  protected $table = "polyphone_pinyin";

  public function createPinyin()
  {
    dump(1);
    // dump($this->where("id", ">", 0)->select());
    return $this->where("id", ">", 0)->field('value,audio_url')->select();
    // return $this->where("id", ">", 0)->find();

  }
}
