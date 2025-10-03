<?
function f()
{?>
<form><input type=text name=n1><input type=submit name=submit></form>
    <?}
if(!$_COOKIE['a']){
    if(!$_GET['submit']){f();}
    else{f();setcookie('a',$_GET['n1']);print($_GET['n1']);}}
else{f();$q=($_COOKIE['a']).','.$_GET['n1'];
    
    $mas = explode(',', $q);
    $count = count($mas);
    print($mas[$count-3] . " " . $mas[$count-2] . " " . $mas[$count-1]);
    setcookie('a',$q);}
?>