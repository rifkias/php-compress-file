<?php 

$imageDir = "./files";
$convertDir = "./done";
$moveDir = "./proccess";

// Check Directory Exists 
if(!is_dir($imageDir)){
    mkdir($imageDir, 0777, true);
}
if(!is_dir($convertDir)){
    mkdir($convertDir, 0777, true);
}
if(!is_dir($moveDir)){
    mkdir($moveDir, 0777, true);
}


$dir =  scandir($imageDir);


foreach ($dir as $key => $value) {
    if($value == "." || $value == ".."){
        continue;
    }
    if(file_exists($imageDir."/".$value)){
        $ext = pathinfo($imageDir."/".$value, PATHINFO_EXTENSION);
        $name = uniqid().".".$ext;
        copy($imageDir."/".$value,$moveDir."/".$name);

        $command = "convert ".$moveDir."/".$name." -quality 50% ".$convertDir."/".$name;
        echo $command;
        echo "<br>";
        exec($command,$res);
        unlink($moveDir."/".$name);
        echo "$value Success";
        echo  json_encode($res);
        echo "<br>";
    }else{
        echo $value. " ga masuk <br>";
    }

    // chmod($convertDir,775);
    # code...
}
