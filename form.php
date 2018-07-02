<?





$error= false;

$errorText = "";

if (empty($_POST["name"])==true) {

	$error=true;

	$errorText = "У вас неправильно заполнено поле Имя";



}



if  (empty($_POST["email"])==true){

	$error=true;

	$errorText = "У вас неправильно записан e-mail";



}

if  (empty($_POST["message"])==true){

	$error=true;

	$errorText = "У вас не написано сообщение";



}



if($error==true){

	$response = [

		"error" => true,

		"message" =>$errorText

	];

	echo json_encode($response);

	die();

}







$servername = "localhost";

$username = "root";

$password = "";



// Create connection

$conn = new mysqli($servername, $username, $password, "bd1");





$sql = "INSERT INTO tab1 (name, email, message)

VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["message"]."')";



if ($conn->query($sql) === TRUE) {

	echo "New record created successfully <br>";
	echo "<a href=index.html >Вернуться назад </a> </p>";

	$query ="SELECT * FROM tab1";
	$result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn)); 

	if ($result->num_rows > 0) {

    // output data of each row
 echo '<table>';
		while($row= $result->fetch_assoc()) {

			echo '<tr>';

			echo '<td style="padding:10px">' . $row['id'] . '</td>';

			echo '<td>' . $row['name'] . '</td>';

			echo '<td>' . $row['email'] . '</td>';

			echo '<td>' . $row['message'] . '</td>';

			echo '</tr>';



		}
 echo '</table>';
	} else {

		echo "0 results";

	}

	$conn->close();
	

    // очищаем результат
	mysqli_free_result($result);


} else {

	echo "Error: " . $sql . "<br>" . $conn->error;

}






?>