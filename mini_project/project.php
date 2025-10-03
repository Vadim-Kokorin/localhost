<style>
    .img1 {
        height: 160px;
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
        gap: 10px; 
        padding: 5px;
        margin-top: 120px;
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
        max-height: 400px;
        overflow-y: auto;
        margin: 20px 0;
    }

    .pagination {
        background-color: #f0f0f0;  
        text-align: center; 
        font-family: sans-serif; 
        color: #333; 
        width: 100%;
        font-size: 20px;
        padding: 15px 0;
        margin-top: 20px;
    }

    .footer {
        text-align: center;
        font-size: 16px;
        padding: 10px;
        color: #666;
    }
    
    textarea {
        width: 80%;
        height: 100px;
        margin: 10px 0;
    }

    .auth-box {
        background: #f8f8f8;
        padding: 15px;
        border-bottom: 2px solid #ccc;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        text-align: center;
    }

    .auth-form {
        display: inline-block;
        margin: 0 15px;
        vertical-align: top;
    }

    .form-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .form-input {
        padding: 8px 12px;
        margin: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 180px;
        font-size: 14px;
    }

    .form-button {
        padding: 8px 20px;
        background: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin: 5px;
        font-size: 14px;
        transition: background 0.3s;
    }

    .form-button:hover {
        background: #45a049;
    }

    .user-info {
        display: inline-block;
        margin: 0 20px;
        padding: 8px 15px;
        background: #e9f7ef;
        border-radius: 4px;
        border: 1px solid #4CAF50;
    }

    .switch-link {
        color: #0066cc;
        cursor: pointer;
        text-decoration: underline;
        margin: 0 10px;
        font-size: 14px;
    }

    .error {
        color: #d32f2f;
        font-size: 13px;
        margin: 5px 0;
        font-weight: bold;
    }

    .logout-button {
        padding: 6px 12px;
        background: #f44336;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
        font-size: 13px;
    }

    .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 8px;
        object-fit: cover;
    }
</style>

<?php
session_start();

function create_mas($file_name) {
    if (!file_exists($file_name)) return [];
    $mas = file($file_name);
    for ($i = 0; $i < count($mas); $i++) {
        $mas[$i] = explode(";", trim($mas[$i]));
    }
    return $mas;
}

if (isset($_GET['register'])) {
    if (empty($_GET['reg_login']) || empty($_GET['reg_password']) || empty($_GET['reg_email']) || empty($_GET['reg_phone']) || empty($_GET['reg_avatar'])) {
        $reg_error = "Заполните все поля!";
        $show_register = true;
    } else {
        $mas_of_mas = create_mas("user.txt");
        $login = $_GET['reg_login'];
        $password = $_GET['reg_password'];
        $email = $_GET['reg_email'];
        $phone = $_GET['reg_phone'];
        $avatar = $_GET['reg_avatar'];
        
        $user_exists = false;
        foreach ($mas_of_mas as $user) {
            if (isset($user[1]) && $user[1] == $login) {
                $user_exists = true;
                break;
            }
        }
        
        if ($user_exists) {
            $reg_error = "Пользователь с таким логином уже существует!";
            $show_register = true;
        } else {
            $next_id = count($mas_of_mas) + 1;
            $user_data = $next_id . ";" . $login . ";" . $password . ";" . $email . ";" . $phone . ";" . $avatar . "\n";
            file_put_contents("user.txt", $user_data, FILE_APPEND);
            
            $_SESSION['id_user'] = $next_id;
            $_SESSION['user_name'] = $login;
            $_SESSION['user_avatar'] = $avatar;
            $show_register = false;
        }
    }
}

if (isset($_GET['knopka'])) {
    if (empty($_GET['log']) || empty($_GET['pass'])) {
        $error = "Заполните поля!";
        $show_register = false;
    } else {
        $mas_of_mas = create_mas("user.txt");
        $login = $_GET['log'];
        $password = $_GET['pass'];
        $user_found = false;

        foreach ($mas_of_mas as $user) {
            if (isset($user[1]) && isset($user[2]) && $user[1] == $login && $user[2] == $password) {
                $_SESSION['id_user'] = $user[0];
                $_SESSION['user_name'] = $user[1];
                $_SESSION['user_avatar'] = isset($user[5]) ? $user[5] : '';
                $user_found = true;
                $show_register = false;
                break;
            }
        }

        if (!$user_found) {
            $error = "Неверный логин или пароль!";
            $show_register = true;
        }
    }
}

if (isset($_GET['show_register'])) {
    $show_register = true;
} elseif (isset($_GET['show_login'])) {
    $show_register = false;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: project.php");
    exit();
}

$mas_news = create_mas("news.txt");
$mas_comments = create_mas("comments.txt");
$mas_user = create_mas("user.txt");

if (isset($_GET['add_comment']) && isset($_SESSION['id_user'])) {
    if (isset($_GET['comment_text']) && trim($_GET['comment_text']) != '') {
        $news_id = $_GET['news_id'];
        $user_id = $_SESSION['id_user'];
        $comment_text = $_GET['comment_text'];

        $current_date = date("Y-m-d");
        $current_time = date("H:i:s");

        $next_id = count($mas_comments) + 1;

        $comment_data = $next_id . ";" . $news_id . ";" . $comment_text . ";" . $user_id . ";" . $current_date . ";" . $current_time . "\n";

        file_put_contents("comments.txt", $comment_data, FILE_APPEND);

        header("Location: project.php?news_id=" . $news_id . "&page=" . $_GET['page']);
        exit();
    }
}

function spawn_div($mas_news, $start_index, $count_news_na_page, $cur_page, $total_pages) {
    print("<div class='container'>");

    $end_index = min($start_index + $count_news_na_page, count($mas_news));
    for($i = $start_index; $i < $end_index; $i++) {
        if(isset($mas_news[$i]) && count($mas_news[$i]) >= 7) {
            $news_id = $mas_news[$i][0];
            print("
                <a href='?news_id=$news_id&page=$cur_page' class='item'>
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
                print("<strong><a href='?page=$i'>  $i  </a></strong>");
            } else {
                print("<a href='?page=$i'>  $i  </a>");
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
                    $user_avatar = '';
                    for($k = 0; $k < count($mas_user); $k++) {
                        if (isset($mas_user[$k][0]) && $mas_user[$k][0] == $user_id) {
                            $user_name = $mas_user[$k][1];
                            $user_avatar = isset($mas_user[$k][5]) ? $mas_user[$k][5] : '';
                            break;
                        }
                    }

                    $avatar_html = $user_avatar ? "<img src='$user_avatar' class='user-avatar'>" : "";
                    
                    print("<div class='comment'>"
                    ."<p><strong>Пользователь:</strong> ".$avatar_html." ".$user_name."</p>"
                    ."<p><strong>Комментарий:</strong> ".$mas_comments[$j][2]."</p>"
                    ."<p><strong>Дата:</strong> ".$mas_comments[$j][4]." <strong>Время:</strong> ".$mas_comments[$j][5]."</p>"
                    ."</div>");
                }
            }

            if (!$comments) {
                print("<p>Комментариев пока нет</p>");
            }

            if (isset($_SESSION['id_user'])) {
                print("
                    <h3>Добавить комментарий:</h3>
                    <form method='GET'>
                        <textarea name='comment_text' placeholder='Введите ваш комментарий'></textarea><br>
                        <input type='hidden' name='news_id' value='".$_GET['news_id']."'>
                        <input type='hidden' name='page' value='".$_GET['page']."'>
                        <button type='submit' name='add_comment'>Добавить комментарий</button>
                    </form>
                ");
            } else {
                print("<p><b>Чтобы оставить комментарий, войдите в систему!</b></p>");
            }

            print("</div>");

            print("<br><a href='?page=" . $_GET['page'] . "'>Вернуться к списку новостей</a>");
            break;
        }
    }
}
?>

<body>

<? if (!isset($_GET['news_id'])) { ?>

<div class='header_glavniy'>
<?
if (!isset($_SESSION['id_user'])) {
    if (isset($show_register) && $show_register) {
        print '<p style="font-size: 20px; text-align:center">Регистрация</p>';
        print '<form method="GET" class="reg-form">';
        print '<input type="text" placeholder="Введите логин" name="reg_login" required class="form-input">';
        print '<input type="password" placeholder="Введите пароль" name="reg_password" required class="form-input">';
        print '<input type="email" placeholder="Введите email" name="reg_email" required class="form-input">';
        print '<input type="text" placeholder="Введите телефон" name="reg_phone" required class="form-input">';
        print '<input type="file" name="reg_avatar" required class="form-input">';
        print '<button type="submit" name="register" class="form-button">Зарегистрироваться</button>';
        print '</form>';
        
        if (isset($reg_error)) {
            print "<p style='color:red; font-size: 12px;'>$reg_error</p>";
        }
        
        print '<div class="switch-form">';
        print '<a href="?show_login=1">Вернуться к авторизации</a>';
        print '</div>';
    } else {
        print '<p style="font-size: 20px; text-align:center">Авторизация</p>';
        print '<form method="GET" class="auth-form">';
        print '<input type="text" placeholder="Введите логин" name="log" class="form-input">';
        print '<input type="password" placeholder="Введите пароль" name="pass" class="form-input">';
        print '<button type="submit" name="knopka" class="form-button">Войти</button>';
        print '</form>';
        
        if (isset($error)) {
            print "<p style='color:red; font-size: 12px;'>$error</p>";
        }
        
        print '<div class="switch-form">';
        print '<a href="?show_register=1">Нет аккаунта? Зарегистрироваться</a>';
        print '</div>';
    }
} else {
    $avatar_html = isset($_SESSION['user_avatar']) && $_SESSION['user_avatar'] ? "<img src='".$_SESSION['user_avatar']."' class='user-avatar'>" : "";
    print '<p>' . $avatar_html . 'Вы вошли как: <b>' . $_SESSION['user_name'] . '</b></p>';
    print '<a href="?logout=1">Выйти</a>';
}
?>
</div>
<? } ?>

<?

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

if (isset($_GET['news_id'])) {
    spawn_news($mas_news, $mas_user, $mas_comments);
} else {
    spawn_div($mas_news, $start_index, $count_news_na_page, $cur_page, $total_pages);
}
?>

</body>
</html>