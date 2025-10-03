<?
function f()
{?>
<form><input type=text name=n1><input type=submit name=submit></form>
    <?}
if(!$_COOKIE['a']){
    if(!$_GET['submit']){f();}
    else{f();setcookie('a',$_GET['n1']);print($_GET['n1']);}}
else{f();
    
    $mas = explode(',', $_COOKIE['a']);
    $count = count($mas);
    
    if($_GET['submit'] && $_GET['n1']) {
        $new = $_GET['n1'];
        
        if($count >= 3) {
            $mas_is_3_last = array_slice($mas, -3);
            
            if (in_array($new, $mas_is_3_last)) {
                $result = implode(',', $mas_is_3_last);
                print($result);
                setcookie('a', $result);
            } else {
                $mas[] = $new; 
                if(count($mas) > 3) {
                    $mas = array_slice($mas, -3);
                }
                $result = implode(',', $mas);
                print($result);
                setcookie('a', $result);
            }
        } else {
 
            $mas[] = $new; 
            $result = implode(',', $mas);
            print($result);
            setcookie('a', $result);
        }
    } else {

        print($_COOKIE['a']);
    }
}
?>