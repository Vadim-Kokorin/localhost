<?
function printTree($path, $c = 0) {
    $items = scandir($path);
    $otstup = str_repeat('&nbsp;&nbsp;&nbsp;', $c);
    $result = '';
    
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        
        $fullPath = $path . '/' . $item;
        if (is_dir($fullPath)) {
            $result .= "<div onClick='f(this)'>". $otstup . '📁 <strong>'.$item.'</strong></div>';
            $result .= "<div style='display:none'>" . printTree($fullPath, $c + 1) . "</div>";
        } else {
            $result .= "<div>" . $otstup . "📄 $item</div>";
        }
    }
    
    return $result;
}

$directory = 'C:\Users\kokos\Desktop';
?>
<html>
<head>
<script type="text/javascript">
    function f(obj) {
        
        var nextDiv = obj.nextElementSibling;
        
        if (nextDiv.innerHTML.includes('div') && nextDiv.style.display !== 'none') {
            nextDiv.style.display = 'none';
        } else {
            nextDiv.style.display = 'block';
        }
        
        event.stopPropagation(); 
    }
</script>
</head>
<body>
    <h3>Полная иерархия директории '<? print($directory); ?>':</h3>
    <? print(printTree($directory)); ?>
</body>
</html>