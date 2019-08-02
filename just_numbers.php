<?php



$number_start = $_POST['number_start'];
$number_end  = $_POST['number_end'];

$number_start = htmlspecialchars($number_start);
$number_end = htmlspecialchars($number_end);
$number_start = (int) $number_start;
$number_end = (int) $number_end;


if(isset($number_start)) {
    
    
$host = 'localhost'; // адрес сервера 
$database = 'just_numbers'; // имя базы данных
$user = 'mysql'; // имя пользователя
$password = 'mysql'; // пароль
 
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
    
$query = "SELECT number FROM `just_numbers` WHERE `number` >= '". mysqli_real_escape_string($link, $number_start)."' AND `number` <= '". mysqli_real_escape_string($link, $number_end)."'";
    
$just_in_db = array();
$result = mysqli_query($link, $query);

    if(!$result){
        echo("Сообщение ошибки: %s\n". mysqli_error($link));
    }
    


while($row = $result->fetch_array()){
    $rows[] = $row;
}

foreach($rows as $row) {

    //echo $row['number']." ";
    array_push($just_in_db, $row['number']);
}


  
    $just_numbers = array();
    
    $flag = false;
  
  
  for($num = $number_start; $num < $number_end; $num++) {
      if(in_array($i, $just_in_db)){
          continue;
      }
      
  
     
    for($x=2; $x <= sqrt($num); $x++) {           
       if($num % $x == 0) {
            $flag = true;
            break;
        }
    } 
       
       if($flag == false) {                
            echo $num. " ";
            array_push($just_numbers, $num);
            if(!in_array($num, $just_in_db)) {
                if(!mysqli_query($link, "INSERT INTO `just_numbers`(number) VALUES ('". mysqli_real_escape_string($link, $num). "')")) {
                    echo("Сообщение ошибки: %s\n". mysqli_error($link));
                }    
           
            }
            
       }
       
       $flag = false;
    
    
  }  
    
    mysqli_close($link);
 }

else {
    echo "<div> Вы не ввели число. </div>";
}



    
    

