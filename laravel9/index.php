<?php
// $a=$b=1;
// for ($i=0; $i < 20 ; $i++) { 
//     $c=$a+$b;
//     if ($i<=1){$c=$i;}
//     echo ' c='.$c.', ';
//     $b=$a;
//     $a=$c;
// }

// $a=$b=1;
// for ($i=2; $i < 20 ; $i++) { 
//     $c=($i-1)+($i-2);
//     // if ($i<=1){$c=$i;}
//     echo ' c='.$c.', ';
//     // $b=$a;
//     // $a=$c;
// }



// // Виводимо перші 10 чисел Фібоначчі
// for ($i = 0; $i < 10; $i++) {
//     echo ($i - 1) + ($i - 2) . ", ";
// }


function fibonacci($n) {
    if ($n <= 1) {
        return $n;
    }
    return fibonacci($n - 1) + fibonacci($n - 2);
}

// Виводимо перші 10 чисел Фібоначчі
for ($i = 0; $i < 10; $i++) {
    echo '==='.fibonacci($i) . ", ===<br>";
}

