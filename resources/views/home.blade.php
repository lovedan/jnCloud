@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <?php
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
                                $thumbnail = wp_storage_to_pcs_media_thumbnail($file->path);
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
                            echo '<td width="25%" style="line-height:10">';
                            if($link)echo '<a class="gallery-item" href="/home?dir='.$file->path.'" title="'.$file_name.'" data-gallery>';
                            // echo '<div class="file-on-pcs'.$class.'" data-file-name="'.$file_name.'" data-file-type="'.$file_type.'" data-file-path="'.$file->path.'">';
                            if($thumbnail)echo '<img src="'.$thumbnail.'?thumbnail=true" width="100" height="100" alt="'.$file_name.'"/>';
                            elseif($file_type == 'dir')echo '<img src="asset/folder.png" alt="'.$file_name.'"/>';
                            elseif($file_type == 'video')echo '<img src="asset/video.png" alt="'.$file_name.'"/>';
                            elseif($file_type == 'audio')echo '<img src="asset/audio.png" alt="'.$file_name.'"/>';
                            else echo '<img src="asset/archive.png" alt="'.$file_name.'"/>';
                            if($link)echo '</a>';
                            echo $file_name;
                            echo '</td>';
                            echo '<td>';
                            if($file_type != 'dir') echo '直链地址：<input type="text" class="form-control " value="'.wp_storage_to_pcs_media_thumbnail($file->path).'"><BR>';
                            if($file_type != 'dir') echo 'MarkDown地址：<input type="text" class="form-control " value="!['.$file_name.']('.wp_storage_to_pcs_media_thumbnail($file->path).')">';
                            echo '</td>';
                            echo '<td style="line-height:10">';
                            if($file_type != 'dir') echo number_format($file->size/1024, 2, '.', '')."KB";
                            echo '</td>';
                            echo '<td style="line-height:10">';
                            echo date("Y-m-d",$file->ctime);
                            echo '</td>';
                            echo '</tr>';
                        }
                    }

                    // 解决路径最后的slah尾巴，如果没有则加上，而且根据不同的服务器，采用/或者\
                    function trailing_slash_path($path_string,$is_win = false){
                        $trail = substr($path_string,-1);
                        if($is_win){
                            if($trail != '/' && $trail != '\\'){
                                $path_string .= '\\';
                            }
                        }else{
                            if($trail != '/'){
                                $path_string .= '/';
                            }
                        }
                        return $path_string;
                    }

                    // 用一个函数来列出PCS中某个目录下的所有文件（夹）
                    function wp_storage_to_pcs_media_list_files($dir_pcs_path,$limit,$orderby = 'time-desc'){
                        global $baidupcs;
                        $orderby = explode('-', $orderby);
                        $results = $baidupcs->listFiles($dir_pcs_path,$orderby[0],$orderby[1],$limit);
                        $results = json_decode($results);
                        $results = $results->list;
                        return $results;
                    }
                    // 用一个函数来显示这些文件（或目录）
                    function wp_storage_to_pcs_media_thumbnail($file_pcs_path,$width = 120,$height = 1600,$quality = 100){
                        // 使用直链，有利于快速显示图片
                        $image_outlink_per = 'http://img.jiangnan.pw/';
                        $file_pcs_path = str_replace(trailing_slash_path('/apps/SyncY'),'',$file_pcs_path);
                        $thumbnail = $image_outlink_per.$file_pcs_path;
                        return $thumbnail;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
