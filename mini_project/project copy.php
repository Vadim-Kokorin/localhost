<style>
    .img1 {
        height: 200px;
        width: 100%;
        object-fit: cover;
        border-style: solid;
    }

    .img2 {
        text-align: center;
        height: 40%;
        width: 30%;
        border-style: solid;
        display: block; 
        margin-left: auto; 
        margin-right: auto 
    }

    .container {
        display: grid;
        grid-template-columns: repeat(5, 1fr); 
        grid-template-rows: repeat(2, auto); 
        gap: 15px; 
        padding: 10px;
    }

    .item {
        cursor: pointer;
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .header {
        font-size: 32px;
        text-align: center;
        padding-top: 10px;
    }

    .podheader {
        font-size: 16px;
        text-align: center;
    }

    .text {
        text-align: center;
        font-size: 30px;
    }

    .date {
        text-align: center;
    }

    .comments {
        font-size: 16px;
        text-align: center;
    }

    .pagination {
        margin-top: auto; 
        background-color: #f0f0f0;  
        text-align: center; 
        font-family: sans-serif; 
        color: #333; 
        position: absolute;
        bottom: 10px;
        text-align: center;
        width: 100%;
        font-size: 30px;
        padding: 10px 0px;
    }

    .footer {
        position: absolute;
        bottom: 80px;
        text-align: left;
        font-size: 30px;
        padding: 5px;
    }
    
    textarea {
        width: 80%;
        height: 100px;
        margin: 10px 0;
    }

    .modal {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(218, 248, 248, 1);

}

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 500px;
}

.modal-content input {
  display: block;
  width: 90%;
  margin-bottom: 10px;
  padding: 8px;
}


</style>

<?php
if (!isset($_GET['id_user'])) {
    function spawn_form() {
        ?>

<div id="authModal" class="modal">
  <div class="modal-content">
    <form method="GET">
            <h2>Вход в систему</h2>
            <input type="text" placeholder="Введите логин" name="log"><br>
            <input type="password" placeholder="Введите пароль" name="pass"><br>
            <button type="submit" name="knopka">Войти</button>
        </form>
  </div>
</div>
        <?php
    }
    
    spawn_form();

    if (isset($_GET['knopka'])) {
    if (empty($_GET['log']) || empty($_GET['pass'])) {
        print("<p> Заполните поля и нажмите кнопку </p>");
    } else {
        $mas_of_mas = file('user.txt');
        for ($i = 0; $i < count($mas_of_mas); $i++) {
            $mas_of_mas[$i] = explode(";", $mas_of_mas[$i]);
        }
    
        $login = $_GET['log'];
        $password = $_GET['pass'];
        
        $user_found = false;
        for ($i = 0; $i < count($mas_of_mas); $i++) {
            if (trim($mas_of_mas[$i][1]) == $login && trim($mas_of_mas[$i][2]) == $password) {
                $id_user = trim($mas_of_mas[$i][0]);
                header("Location: project.php?id_user=" . $id_user);
                exit(); 
            }
        }
        
        if (!$user_found) {
            print("Неверный логин или пароль");
        }
    }
}
} else {
    function create_mas($file_name) {
        $mas = file($file_name);
        for ($i = 0; $i < count($mas); $i++) {
            $mas[$i] = explode(";", $mas[$i]);
        }
        return $mas;
    }

    $mas_news = create_mas("news.txt");
    $mas_comments = create_mas("comments.txt");
    $mas_user = create_mas("user.txt");

    if (isset($_GET['add_comment']) && isset($_GET['comment_text']) && trim($_GET['comment_text']) != '') {
    $news_id = $_GET['news_id'];
    $user_id = $_GET['id_user'];
    $comment_text = $_GET['comment_text'];
    
    $current_date = date("Y-m-d");
    $current_time = date("H:i:s");
    
    $next_id = count($mas_comments) + 1;
    
    $comment_data = $next_id . ";" . $news_id . ";" . $comment_text . ";" . $user_id . ";" . $current_date . ";" . $current_time . "\n";
    
    file_put_contents("comments.txt", $comment_data, FILE_APPEND);
    
    header("Location: ?id_user=" . $user_id . "&news_id=" . $news_id . "&page=" . $_GET['page']);
    exit();
}

    $count_news_na_page = 8;
    $total_news = count($mas_news);
    $total_pages = ceil($total_news / $count_news_na_page); 

    $cur_page = 1; 
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']); 
        if ($page < 1) {
            $cur_page = 1; 
        } elseif ($page > $total_pages) {
            $cur_page = $total_pages; 
        } else {
            $cur_page = $page; 
        }
    }

    $start_index = ($cur_page - 1) * $count_news_na_page;

    function spawn_div($mas_news, $start_index, $count_news_na_page, $cur_page, $total_pages) {
        print("<div class='container'>");
        
        $end_index = min($start_index + $count_news_na_page, count($mas_news));
        for($i = $start_index; $i < $end_index; $i++) {
            if(isset($mas_news[$i]) && count($mas_news[$i]) >= 7) {
                $news_id = $mas_news[$i][0];
                print("
                    <a href='?id_user=" . $_GET['id_user'] . "&news_id=$news_id&page=$cur_page' class='item'>
                        <img src='".$mas_news[$i][6]."' class='img1'>
                        <div style='font-size: 24px'>".$mas_news[$i][1]."</div>
                    </a>
                ");
            }
        }
        
        print("</div>");
        
        if ($total_pages > 1) {
            print("<div class='pagination'>");
            
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $cur_page) {
                    print("<strong><a href='?id_user=" . $_GET['id_user'] . "&page=$i'>  $i  </a></strong>");
                } else {
                    print("<a href='?id_user=" . $_GET['id_user'] . "&page=$i'>  $i  </a>");
                }
            }
            
            print("</div>");
        }
        
        print("<div class='footer'>Страница $cur_page из $total_pages</div>");
    }

    function spawn_news($mas_news, $mas_user, $mas_comments) {
        for($i = 0; $i < count($mas_news); $i++) {
            if (isset($mas_news[$i][0]) && $mas_news[$i][0] == $_GET['news_id']) {
                print(
                    "<b><p class='header'>".$mas_news[$i][1]."</p></b>".
                    "<p class='podheader'> Тема: ".$mas_news[$i][5]."</p>".
                    "<img src='".$mas_news[$i][6]."' class='img2'>".
                    "<p class='text'>".$mas_news[$i][2]."</p>".
                    "<p class='date'> Дата выпуска новости: ".$mas_news[$i][3]. ", Время: ". $mas_news[$i][4]."</p>"
                );
                
                print("<div class='comments'>");
                print("<h3>Комментарии:</h3>");
                
                $comments = false;
                for($j = 0; $j < count($mas_comments); $j++) {
                    if (isset($mas_comments[$j][1]) && $mas_comments[$j][1] == $_GET['news_id']) {
                        $comments = true;
                        $user_id = $mas_comments[$j][3]; 
                        
                        $user_name = "Неизвестный пользователь";
                        for($k = 0; $k < count($mas_user); $k++) {
                            if (isset($mas_user[$k][0]) && $mas_user[$k][0] == $user_id) {
                                $user_name = $mas_user[$k][1];
                                break;
                            }
                        }
                        
                        print("<div class='comment'>"
                        ."<p><strong>Пользователь:</strong> ".$user_name."</p>"
                        ."<p><strong>Комментарий:</strong> ".$mas_comments[$j][2]."</p>"
                        ."<p><strong>Дата:</strong> ".$mas_comments[$j][4]." <strong>Время:</strong> ".$mas_comments[$j][5]."</p>"
                        ."</div>");
                    }
                }
                
                if (!$comments) {
                    print("<p>Комментариев пока нет</p>");
                }
                
                print("
                    <h3>Добавить комментарий:</h3>
                    <form method='GET'>
                        <textarea name='comment_text' placeholder='Введите ваш комментарий' required></textarea><br>
                        <input type='hidden' name='news_id' value='".$_GET['news_id']."'>
                        <input type='hidden' name='id_user' value='".$_GET['id_user']."'>
                        <input type='hidden' name='page' value='".$_GET['page']."'>
                        <button type='submit' name='add_comment'>Добавить комментарий</button>
                    </form>
                ");
                
                print("</div>");
                
                print("<br><a href='?id_user=" . $_GET['id_user'] . "&page=" . $_GET['page'] . "'>Вернуться к списку новостей</a>");
                break;
            }
        }
    }

    if (isset($_GET['news_id'])) {
        spawn_news($mas_news, $mas_user, $mas_comments);
    } else {
        spawn_div($mas_news, $start_index, $count_news_na_page, $cur_page, $total_pages);
    }
}
?>