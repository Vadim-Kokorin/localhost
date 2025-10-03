<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интерактивная иерархия директорий</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .directory-tree {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .folder, .file {
            cursor: pointer;
            padding: 2px 0;
        }
        .folder:hover, .file:hover {
            background-color: #f0f0f0;
        }
        .folder::before {
            content: "📁 ";
        }
        .file::before {
            content: "📄 ";
        }
        .collapsed > .folder::before {
            content: "📂 ";
        }
        .children {
            margin-left: 20px;
            display: block;
        }
        .collapsed > .children {
            display: none;
        }
        .toggle {
            cursor: pointer;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Интерактивная иерархия директорий</h1>
    
    <div class="directory-tree">
        <?php
        function printDirectoryTree($path, $c = 0) {
            $items = scandir($path);
            $otstup = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $c);
            
            foreach ($items as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
                
                $fullPath = $path . '/' . $item;
                
                if (is_dir($fullPath)) {
                    // Генерируем уникальный ID для каждой папки
                    $folderId = 'folder_' . md5($fullPath);
                    echo '<div class="folder" id="' . $folderId . '">';
                    echo '<span class="toggle" onclick="toggleFolder(\'' . $folderId . '\')">▶</span>';
                    echo '<strong>' . $item . '</strong>';
                    echo '<div class="children">';
                    printDirectoryTree($fullPath, $c + 1);
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<div class="file">' . $item . '</div>';
                }
            }
        }

        $directory = 'C:\Users\kokos\Desktop';
        echo "<p>Полная иерархия директории '$directory':</p>";
        printDirectoryTree($directory);
        ?>
    </div>

    <script>
        function toggleFolder(folderId) {
            const folder = document.getElementById(folderId);
            const toggle = folder.querySelector('.toggle');
            
            if (folder.classList.contains('collapsed')) {
                // Разворачиваем папку
                folder.classList.remove('collapsed');
                toggle.textContent = '▼';
            } else {
                // Сворачиваем папку
                folder.classList.add('collapsed');
                toggle.textContent = '▶';
            }
        }

        // Изначально сворачиваем все папки
        document.addEventListener('DOMContentLoaded', function() {
            const folders = document.querySelectorAll('.folder');
            folders.forEach(folder => {
                folder.classList.add('collapsed');
            });
        });
    </script>
</body>
</html>