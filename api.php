<?php
require_once "./config.php";

$OS_TYPE=DIRECTORY_SEPARATOR=='\\'?'windows':'linux';

if($OS_TYPE == 'windows') {
  define('ROOT','.');
}else{
  define('ROOT',__DIR__);
}

$type = isset($_POST['type']) ? $_POST['type'] : false;
$data = isset($_POST['data']) ? $_POST['data'] : false;
$small = isset($_POST['small']) ? $_POST['small'] : false;
$request_time = time(true);

if($type && $data && $small){
  $TEMP_ROOT = ROOT.'/templates/'.$type.'/';
  $TEMP_ASS = $TEMP_ROOT.'template.ass';
  $CACHE_ASS_PATH = ROOT.'/cache/'.$type.'_'.$request_time.'.ass';

  if($small == 'true' || DEFAULT_CREATE_SMALL_GIF === true){
    $TEMP_VIDEO = $TEMP_ROOT.'template-small.mp4';
    if(!file_exists($TEMP_ROOT.'template-small.mp4')){
      $TEMP_VIDEO = $TEMP_ROOT.'template.mp4';
    }
  }else{
    $TEMP_VIDEO = $TEMP_ROOT.'template.mp4';
  }

  if(!file_exists(ROOT.'/cache')){
    if(mkdir(ROOT.'/cache',0777) === false){
      $result['code'] = 500;
      $result['msg'] = '服务器中不存在 `cache` 目录，PHP-BIAOQINGBAO-GIF尝试创建目录但是出现错误，请手动在根目录下创建 `cache` 目录。';
      exit(json_encode($result));
    }
  }

  if(file_exists($TEMP_ROOT)){
    $ass_file = file_get_contents($TEMP_ASS);

    for($i=0;$i<count($data);$i++){
      $str_source[$i] = '<?=['.$i.']=?>';
    }

    $change_ass = str_replace($str_source,$data,$ass_file);
    $create_temporary_ass = fopen($CACHE_ASS_PATH, "w") or die('{"code":501,"msg":"临时文件创建失败，请检查chache目录权限。"}');
    fwrite($create_temporary_ass, $change_ass) or die('{"code":502,"msg":"临时文件写入失败，请检查chache目录权限。"}');
    fclose($create_temporary_ass);

    $out_put_file=ROOT.'/cache/'.$request_time.'.gif';
    $command = 'ffmpeg -y -i '.$TEMP_VIDEO.' -vf "ass='.$CACHE_ASS_PATH.'" '.$out_put_file;
    system($command);
    unlink($CACHE_ASS_PATH); //删除临时文件

    $result['code'] = 200;
    $result['type'] = $type;
    $result['msg'] = '似乎生成成功了。';

    if(UPLOAD_TO_SOGOU_IMG === true && filesize($out_put_file)<10000000){
      require_once ROOT.'/usr/lib/functions.php';
      $r = upload_to_sogou($out_put_file);
      if($r === false) {
        // 如果搜狗IMG上传失败，则使用本地链接。
        $result['path'] = './cache/'.$request_time.'.gif';
        $result['upload_status'] = 'fail';
      }else{
        $result['path'] = 'https://'.$r['host'][rand(0,4)].$r['path'];
        $result['upload_status'] = 'success';
      }
    }else{
      $result['path'] = './cache/'.$request_time.'.gif';
    }

  }else{
    $result['code'] = 404;
    $result['type'] = $type;
    $result['msg'] = '缺少字幕文件，请补全相应模板的字幕文件。';
  }
}else{
  $result['code'] = 400;
  $result['msg'] = '字幕文件缺少必要参数。';
}

echo json_encode($result);
