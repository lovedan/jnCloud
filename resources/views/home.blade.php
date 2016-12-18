@extends('layouts.disk')

@section('menubar')
<?php
    if(isset($_GET['dir']) && !empty($_GET['dir'])){
        $current_path = str_replace($remote_dir,'',$dir_pcs_path);
        $current_dir_string = array();
        $current_path_arr = array_filter(explode('/',$current_path));
        if(!empty($current_path_arr))foreach($current_path_arr as $key => $current_dir){
            $current_dir_string[] = urlencode($current_dir);
            $current_dir_link = implode('/',$current_dir_string);
            $current_dir_link = "/home?dir=".$remote_dir."/".$current_dir_link;
            $current_dir_link = '<li><a href="'.$current_dir_link.'">'.$current_dir.'</a></li>';
            echo $current_dir_link;
        }
    }
?>
@endsection

@section('databody')
<?php
$userPcsUrl = config('app.fileurl').'/'.$userNewId.'/';
if(!empty($files_on_pcs))
{
	foreach($files_on_pcs as $file){
		$file_path = explode('/',$file->path);
		$file_name = $file_path[count($file_path)-1];
		$file_ext = substr($file_name,strrpos($file_name,'.')+1);
		$file_type = strtolower($file_ext);
		for($i=0;$i<count($file_path);$i++){
			$file_path[$i] = urlencode($file_path[$i]);
		}
		$file->path = implode('/',$file_path);
		$link = false;
		$thumbnail = false;
		$class = '';
		// 判断是否为图片
		if(in_array($file_type,array('jpg','jpeg','png','gif','bmp'))){
//			$thumbnail = App::make('app\Http\Controllers\HomeController')->wp_storage_to_pcs_media_thumbnail($file->path,$userPcsUrl);
			$thumbnail = config('app.url').'/images'.$file->path;
			$file_type = 'image';
		}
		// 判断是否为视频
		elseif(in_array($file_type,array('asf','avi','flv','mkv','mov','mp4','wmv','3gp','3g2','mpeg','ts','rm','rmvb','m3u8'))){
			$file_type = 'video';
			$class .= ' file-type-video ';
		}
		// 判断是否为音频
		elseif($file_type == 'mp3'){ //array('ogg','mp3','wma','wav','mp3pro','mid','midi')
			$file_type = 'audio';
			$class .= ' file-type-audio ';
		}
		else{
			$file_type = 'file';
		}
		// 判断是否为文件（图片）还是文件夹
		if($file->isdir === 0){
			$class .= ' file-type-file can-select ';
		}else{
			$class .= ' file-type-dir ';
			$link = true;
			$file_type = 'dir';
		}

        echo '<tr>';
		ECHO '<td width="30%" style="line-height:4">';
		if($link)echo '<a class="gallery-item" href="/home?dir='.$file->path.'" title="'.$file_name.'" data-gallery>';
		// echo '<div class="file-on-pcs'.$class.'" data-file-name="'.$file_name.'" data-file-type="'.$file_type.'" data-file-path="'.$file->path.'">';
		if($thumbnail)echo '<img src="'.$thumbnail.'" alt="'.$file_name.'"/>';
			elseif($file_type == 'dir')echo '<img src="asset/folder.png" alt="'.$file_name.'"/>';
			elseif($file_type == 'video')echo '<img src="asset/video.png" alt="'.$file_name.'"/>';
			elseif($file_type == 'audio')echo '<img src="asset/audio.png" alt="'.$file_name.'"/>';
			else echo '<img src="asset/archive.png" alt="'.$file_name.'"/>';
		if($link)echo '</a>';
		echo $file_name;
        echo '</td>';
        echo '<td width="50%" >';
        if($file_type != 'dir') echo '直链地址：<input type="text" class="form-control " value="'.App::make('app\Http\Controllers\HomeController')->wp_storage_to_pcs_media_thumbnail($file->path,$userPcsUrl).'"><BR>';
//        if($file_type != 'dir') echo 'MarkDown地址：<input type="text" class="form-control " value="!['.$file_name.']('.App::make('app\Http\Controllers\HomeController')->wp_storage_to_pcs_media_thumbnail($file->path,$userPcsUrl).')">';
        echo '</td>';
        echo '<td width="10%" style="line-height:4">';
        if($file_type != 'dir') echo number_format($file->size/1024, 2, '.', '')."KB";
        echo '</td>';
        echo '<td width="10%" style="line-height:4">';
        echo date("Y-m-d",$file->ctime);
        echo '</td>';
		echo '</tr>';
	}
}
?>
@endsection
