<?
    //$f1 = '/var/www/vhosts/noideersoftware.co.uk';
    $f = $_SERVER['DOCUMENT_ROOT'];
    //die ($f);
    $io = popen ( '/usr/bin/du -sh ' . $f, 'r' );
    
    $size = fgets ( $io, 4096);
   
    //echo "total disk space ".$size1."<br>"; 
    //echo "bytes left ".intval($size1-$size)."<br>";
    $size = substr ( $size, 0, strpos ( $size, "\t" ) );
    pclose ( $io );
    //pclose ($io1);
     echo "folder size ".$size."<br>";
    //echo 'Directory: ' . $f . ' => Size: ' . $size;
    
    $units = explode(' ', 'B KB MB GB TB PB');
    $SIZE_LIMIT = 7368709120; // 5 GB
    $disk_used = foldersize($_SERVER['DOCUMENT_ROOT']);

    $disk_remaining = $SIZE_LIMIT - $size;

    echo("<html><body>");
    echo('diskspace used: ' . format_size($disk_used) . '<br>');
    echo( 'diskspace left: ' . format_size($disk_remaining) . '<br><hr>');
    echo("</body></html>");
    $ds = disk_total_space($_SERVER['DOCUMENT_ROOT']);
     $df = disk_free_space($_SERVER['DOCUMENT_ROOT']);
     $pt = $_SERVER['DOCUMENT_ROOT'];
     
     echo "<br>dir =  ".$pt."<br>";
     echo "total = ".format_size($ds)."<br>";
     echo "used = " .$size."<br>";
//print_r ($_SERVER);
//phpinfo(1);

$path=$_SERVER['DOCUMENT_ROOT']; 
$ar=getDirectorySize($path); 

echo "<h4>Details for the path : $path</h4>"; 
echo "Total size : ".sizeFormat($ar['size'])."<br>"; 
echo "No. of files : ".$ar['count']."<br>"; 
echo "No. of directories : ".$ar['dircount']."<br>";  

function foldersize($path) {
    $total_size = 0;
    $files = scandir($path);
    $cleanPath = rtrim($path, '/'). '/';

    foreach($files as $t) {
        if ($t<>"." && $t<>"..") {
            $currentFile = $cleanPath . $t;
            if (is_dir($currentFile)) {
                $size = foldersize($currentFile);
                $total_size += $size;
            }
            else {
                $size = filesize($currentFile);
                $total_size += $size;
            }
        }   
    }

    return $total_size;
}


function format_size($size) {
    global $units;

    $mod = 1024;

    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }

    $endIndex = strpos($size, ".")+3;

    return substr( $size, 0, $endIndex).' '.$units[$i];
}

function getDirectorySize($path) 
{ 
  $totalsize = 0; 
  $totalcount = 0; 
  $dircount = 0; 
  if ($handle = opendir ($path)) 
  { 
    while (false !== ($file = readdir($handle))) 
    { 
      $nextpath = $path . '/' . $file; 
      if ($file != '.' && $file != '..' && !is_link ($nextpath)) 
      { 
        if (is_dir ($nextpath)) 
        { 
          $dircount++; 
          $result = getDirectorySize($nextpath); 
          $totalsize += $result['size']; 
          $totalcount += $result['count']; 
          $dircount += $result['dircount']; 
        } 
        elseif (is_file ($nextpath)) 
        { 
          $totalsize += filesize ($nextpath); 
          $totalcount++; 
        } 
      } 
    } 
  } 
  closedir ($handle); 
  $total['size'] = $totalsize; 
  $total['count'] = $totalcount; 
  $total['dircount'] = $dircount; 
  return $total; 
} 

function sizeFormat($size) 
{ 
    if($size<1024) 
    { 
        return $size." bytes"; 
    } 
    else if($size<(1024*1024)) 
    { 
        $size=round($size/1024,1); 
        return $size." KB"; 
    } 
    else if($size<(1024*1024*1024)) 
    { 
        $size=round($size/(1024*1024),1); 
        return $size." MB"; 
    } 
    else 
    { 
        $size=round($size/(1024*1024*1024),1); 
        return $size." GB"; 
    } 

}  
?>
