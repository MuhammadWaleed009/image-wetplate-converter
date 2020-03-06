<?php 

/* Getting file name */
$filename = "uploads/".$_FILES['file']['name']; 

/* Location */

$location = $filename; 
$uploadOk = 1; 
if($uploadOk == 0){ 
echo 0; 
}else{ 
/* Upload file */
if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if($ext=="png")
        $im = imagecreatefrompng($filename);
    elseif ($ext=="gif")
        $im = imagecreatefromgif($filename);
    elseif ($ext=="jpg" ||$ext=="JPG" )
        $im = imagecreatefromjpeg($filename);
    elseif($ext=="jpeg")
        $im = imagecreatefromjpeg($filename);
    elseif($ext=="bmp")
        $im = imagecreatefromjpeg($filename);

        imagefilter($im, IMG_FILTER_GRAYSCALE);
    $dest = imagecreatefrompng('./texture.png');

    $ij = $im;



imagealphablending($dest, false);
imagesavealpha($dest, true);

list($width, $height) = getimagesize($filename);
list($newwidth, $newheight) = getimagesize('./texture.png');

$new_image=$dest;
if($width<$newwidth)
{
    
    $new_image = imagecreatetruecolor ( $width, $newheight ); // new wigth and height
    imagealphablending($new_image , false);
    imagesavealpha($new_image , true);
    imagecopyresampled ( $new_image, $dest, 0, 0, 0, 0, $newwidth, $newheight, imagesx ( $dest ), imagesy ( $dest ) );
     

    // saving
    imagealphablending($new_image , false);
    imagesavealpha($new_image , true);
    imagepng ( $new_image, './texture1.png' );
    $newwidth=$width;
}   
if($height<$newheight)
{
     $new_image = imagecreatetruecolor ( $newwidth, $height ); // new wigth and height
    imagealphablending($new_image , false);
    imagesavealpha($new_image , true);
    imagecopyresampled ( $new_image, $dest, 0, 0, 0, 0, $newwidth, $newheight, imagesx ( $dest ), imagesy ( $dest ) );
     

    // saving
    imagealphablending($new_image , false);
    imagesavealpha($new_image , true);
    imagepng ( $new_image, './texture1.png' );
      $newheight=$height;
}

imagecopyresized($im, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
imagecopymerge($new_image, $im, 0, 0, 0, 0,  $newwidth,$newheight, 80);

$im = $new_image;



    if($ext=="png")
        imagepng($im, $filename);
    elseif ($ext=="gif")
        imagegif($im, $filename);
    elseif ($ext=="jpg" ||$ext=="JPG")
        imagejpeg($im, $filename);
    elseif($ext=="jpeg")
        imagejpeg($im, $filename);
    elseif($ext=="bmp")   
        imagebmp($im, $filename);
       
    
    
    
imagedestroy($im);
    echo $location; 
}else{ 
    echo 0; 
} 
} 

?> 
