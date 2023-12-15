require("config.php");

function DB_open(){
    if(!$DB_CONNECT){
        // Create connection
        $DB_CONNECT = new mysqli($servername, $username, $password);

        // Check connection
        if ($DB_CONNECT->connect_error) {
            die("Connection failed: " . $DB_CONNECT->connect_error);
        }
    }
}

function DB_close(){
    if($DB_CONNECT){
        $DB_CONNECT->close();
        $DB_CONNECT = null;
    }
}

function DB_query($sql){
    DB_open();

    $result = $DB_CONNECT->query($sql);

    $rows = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
    } 

    return $rows;

    DB_close();
}

function get_artists(){
    return DB_query("SELECT * FROM artists");
}