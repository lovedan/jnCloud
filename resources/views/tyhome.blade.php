@extends('layouts.tydisk')

@section('menubar')
<?php
    if(!empty($folderInfo)){
            foreach($folderInfo as $current_dir){
                $current_dir_link = "/tyhome?dirid=".number_format($current_dir["folderid"],0,"","");
                $current_dir_link = '<li><a href="'.$current_dir_link.'">'.$current_dir["folderpath"].'</a></li>';
                echo $current_dir_link;
            }
    }
?>
@endsection

@section('databody')
<?php

if(!empty($files_on_pcs))
{
    foreach ($files_on_pcs->folder as $folder){
        echo '<tr style="font-size: 10px;">';
        echo '<td width="2%" style="line-height:4">';
        echo '<input type="checkbox" name="delFile[]" class="minimal-red" value="'.$folder->id.'">';
        echo '</td>';
        echo '<td width="30%" style="line-height:4;">';
        echo '<a class="gallery-item" href="/tyhome?dirid='. number_format($folder->id,0,'','') .'" title="'.$folder->name.'" data-gallery>';
        echo '<img src="asset/images/folder.png" alt="'.$folder->name.'"/>';
        echo '</a>';
        echo "&nbsp;&nbsp;".$folder->name;
        echo '</td>';
        echo '<td width="30%" style="vertical-align:middle">';
        echo '</td>';
        echo '<td width="10%" style="line-height:4">';
        echo '</td>';
        echo '<td width="10%" style="line-height:4">';
        echo $folder->createDate;
        echo '</td>';
        echo '</tr>';
    }
    foreach ($files_on_pcs->file as $file){
        echo '<tr style="font-size: 10px;">';
        echo '<td width="2%" style="line-height:4">';
        echo '<input type="checkbox" name="delFile[]" class="minimal-red" value="'.$file->id.'">';
        echo '</td>';
        echo '<td width="30%" style="line-height:4;">';
        if($file->mediaType == 1 )echo '<img src="'.$file->icon->smallUrl.'" alt="'.$file->name.'"/>';
        elseif($file->mediaType == 2)echo '<img src="asset/images/music.png" alt="'.$file->name.'"/>';
        elseif($file->mediaType == 3)echo '<img src="asset/images/video.png" alt="'.$file->name.'"/>';
        elseif($file->mediaType == 4)echo '<img src="asset/images/text.png" alt="'.$file->name.'"/>';
        else echo '<img src="asset/images/unknown.png" alt="'.$file->name.'"/>';
        echo "&nbsp;&nbsp;".$file->name;
        echo '</td>';
        echo '<td width="30%" style="vertical-align:middle">';
        echo '</td>';
        echo '<td width="10%" style="line-height:4">';
        echo number_format($file->size/1024, 2, '.', '')."KB";
        echo '</td>';
        echo '<td width="10%" style="line-height:4">';
        echo $file->createDate;
        echo '</td>';
        echo '</tr>';
    }
}
?>
@endsection
