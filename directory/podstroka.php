<?php
function searchFiles($path, $search, &$results) {
    $items = scandir($path);
    
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') continue;
        
        $fullPath = $path . '/' . $item;
        
        if (is_dir($fullPath)) {
            searchFiles($fullPath, $search, $results);
        } else {
            $text = file_get_contents($fullPath);
            $count = substr_count($text, $search);
            if ($count > 0) {
                $results[] = [
                    'filename' => $item,
                    'count' => $count,
                    'content' => $text
                ];
            }
        }
    }
}

if (isset($_GET['fraza']) && !empty($_GET['fraza'])) {
    print("<a href='podstroka.php'>Назад</a><br>");
    $search = $_GET['fraza'];
    $results = [];
    
    searchFiles('C:\OSPanel\domains\localhost', $search, $results);
    
    
    for($i = 0; $i < count($results); $i++){
        for($j = 0; $j < count($results); $j++){
            if($results[$i]["count"] > $results[$j]["count"]){
                $buf = $results[$i];
                $results[$i] = $results[$j];
                $results[$j] = $buf;
            }
        }
    }

    print("Фраза '$search' найдена в " . count($results) . " файлах:<br><br>");
    
    foreach ($results as $file) {
        print("📄". $file['filename'] .' - '. $file['count']. 'раз(а)'."<br>");
        
        $pos = strpos($file['content'], $search);
        $start = max($pos - 30, 0);
        $end = min($pos + strlen($search) + 30, strlen($file['content']));
        $context = substr($file['content'], $start, $end - $start);
        
        if ($start > 0) 
            {$context = '...' . $context;}

        if ($end < strlen($file['content'])) 
            {$context = $context . '...';}
        
        $context = str_replace($search, '<strong>' . $search . '</strong>', $context);
        print("Контекст: \"$context\"<br><br>");
    }
} else {
    print("
        <form method='GET'>
            <input type='text' placeholder='Введите фразу' name='fraza'>
            <button type='submit'>показать</button>
        </form>
    ");
}
?>