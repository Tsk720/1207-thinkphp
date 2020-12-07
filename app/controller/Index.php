<?php

namespace app\controller;

use app\BaseController;
use app\model\First;
use app\model\Create;
use app\model\PolyphonePinyin;
use think\Validate;
use think\Request;

class Index extends BaseController
{
  public function index()
  {
    // return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V' . \think\facade\App::version() . '<br/><span style="font-size:30px;">14载初心不改 - 你值得信赖的PHP框架</span></p><span style="font-size:25px;">[ V6.0 版本由 <a href="https://www.yisu.com/" target="yisu">亿速云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ee9b1aa918103c4fc"></think>';
    dump($this);
  }

  public function testConfig()
  {
    $firstModel  = new First();
    // dump($this);
    // echo $firstModel;
    // dump($firstModel);
    // dump($firstModel->text());
    dump($firstModel->text()->toJson());
    dump($firstModel->text());
    dump($firstModel);
    $list = $firstModel->text()->toArray();
    dump($list);
    foreach ($list as $key => $value)
      echo $list[$key]['name'] . "<br>";

    //   foreach ($list as $user) {
    //     dump($user);
    // }
  }

  public function hello($name = 'ThinkPHP6')
  {
    return 'he llo,' . $name;
  }
  public function print()
  {
  }
  // public function create()
  // {
  //   $createPinyin = new Create();
  //   $list = $createPinyin->createPinyin()->toArray();
  //   dump($list);
  // }
  public function createPin()
  {
    // 參數校驗
    $validate = \think\facade\Validate::rule([
      'value' => 'max:36',
      'audio_url' => 'max:255'
    ]);
    $inputDate = [
      'value' => input('value'),
      'audio_url' => input('audio_url')
    ];

    if (!$validate->check($inputDate)) {
      return json([
        'code'  => 404,
        'msg' => '操作失敗',
        'data' => $inputDate
      ]);
    } else {
      $res = (new PolyphonePinyin())->insert($inputDate);
      if ($res !== 1) {
        return json([
          'code'  => 404,
          'msg' => '入库失败',
        ]);
      }
      return json([
        'code'  => 200,
        'msg' => '操作成功',
        'data' => $res
      ]);
    }
  }
  public function editPin(Request $request, $id)
  {
    // dump($request->param());
    $validate = \think\facade\Validate::rule([
      'id'  => 'require|max:11',
      'value' => 'max:36',
      'audio_url' => 'max:255'
    ]);
    $inputDate = [
      'id'  => $id,
      'value' => input('value'),
      'audio_url' => 'http://www.yueyv.com/sound/mp3/ding1.mp3'
    ];
    if (!$validate->check($inputDate)) {
      dump($validate->getError());
      return json([
        'code'  => 404,
        'msg' => '操作成功',
        'data' => $inputDate
      ]);
    }
    // 狀態校驗
    else {
      $res = (new PolyphonePinyin())->update($inputDate);
      return json([
        'code'  => 200,
        'msg' => '操作成功',
        'data' => $inputDate
      ]);
    }
  }
  public function deletePin()
  {
    $validate = \think\facade\Validate::rule([
      'id'  => 'max:11',
      'value' => 'max:36',
      'audio_url' => 'max:255'
    ]);
    $inputDate = [
      'id'  => input('id')
    ];
    if (!$validate->check($inputDate)) {
      dump($validate->getError());
      return json([
        'code'  => 404,
        'msg' => '操作失敗',
        'data' => $inputDate
      ]);
    } else {
      // $res = (new PolyphonePinyin())->where($inputDate)->find()
      $res = (new PolyphonePinyin())->where($inputDate)->delete();
      if ($res == 0) {
        return json([
          'code'  => 404,
          'msg' => '入库失败',
          'data' => $res
        ]);
      }
      // dump($res);
      // 狀態校驗
      return json([
        'code'  => 200,
        'msg' => '操作成功',
        'data' => $res
      ]);
    }
  }
  public function showPin()
  {
    $validate = \think\facade\Validate::rule([
      'value' => 'max:36',
    ]);
    $inputDate = [
      'value' => input('value'),
    ];
    if (!$validate->check($inputDate)) {
      dump($validate->getError());
      return json([
        'code'  => 404,
        'msg' => '操作失敗',
        'data' => $inputDate
      ]);
      dump($inputDate);
    } else {
      $res = (new PolyphonePinyin())->where($inputDate)->find();
      // dump($res);
      return json([
        'code'  => 200,
        'msg' => '操作成功',
        'data' => $res
      ]);
    }
  }
}
