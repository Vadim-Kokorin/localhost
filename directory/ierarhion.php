

<?
function printDirectoryTree($path, $c = 0) {
    $items = scandir($path);
    $otstup = str_repeat('&nbsp;&nbsp;&nbsp&nbsp;', $c);
    
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        
        $fullPath = $path . '/' . $item;
        
        if (is_dir($fullPath)) {
            print($otstup . "📁 <strong>$item</strong><br>");
            printDirectoryTree($fullPath, $c + 1);
        } else {
            print($otstup . "📄 $item<br>");
        }
    }
}

$directory = 'C:\Users\kokos\Desktop\primer';
print("Полная иерархия директории '$directory':<br><br>");
printDirectoryTree($directory);

?>