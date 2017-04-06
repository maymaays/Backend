<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/5/2017 AD
 * Time: 4:21 PM
 */

$PRODUCTION = false;

function connection()
{
// IP address
    $host_ssh = "139.59.96.74";
    $local = "127.0.0.1";
// user
    $user_root = "root";
// password
    $pass_ssh = "dc647eb65e6711e155375218212b3964";
    $pass_db = "bdaf31f7f68f9f12ee893e106579764164e2dcda1a0dd4be";
// database
    $database = 'HotelManagement';
// port
    $default_sql_port = 3306;

    if (!$GLOBALS['PRODUCTION']) {
        // precondition: need to add private/public key for ssh (link: https://github.com/Database-Systems-For-SKE/Planning-Design#important)
        shell_exec("ssh -fNg -L " . $default_sql_port . ":" . $local . ":" . $default_sql_port . " " . $user_root . "@" . $host_ssh . " sleep 60 >> logfile");
    }
    $db = mysqli_connect($local, $user_root, $pass_db, $database);
    if (mysqli_connect_errno()) die("to connect to MySQL: " . mysqli_connect_error());
    return $db;
}

function query(mysqli $db, string $q)
{

    mysqli_set_charset($db, 'utf8');
    if ($result = $db->query($q)) {
        return $result;
    } else
        die("Query Error");
}

function close(mysqli $db)
{
    $db->close();
}

// merge 2 map arr
function merge_map($main, $arr)
{
    $result = array_combine(array_keys($main), array_fill(0, count($main), null));
    // $i = 0;
    foreach ($main as $key => $value) {
        if (is_array($value))
            $result[$key] = $value;
        else
            $result[$key][] = $value;
    }

    foreach ($main as $key => $value) {
        $key_exist = array_key_exists($key, $arr);
        if ($key_exist)
            $result[$key][] = $arr[$key];
    }
    // clean array
    array_walk($result, create_function('&$v', '$v = (count($v) == 1)? array_pop($v): $v;'));
    return $result;
}


// --------------------------- run --------------------------- //
$db = connection();

$result = query($db, "SELECT * FROM test WHERE id=0");

$array = array();


// Procedural style
while ($row = $result->fetch_assoc()) {
    if (!$row) die("no row result");

    if (!$array)
        $array = $row;
    else
        $array = merge_map($array, $row);

    // print_r($value);
    // echo "<br>";

    // foreach ($row as $element) {
    // echo $element;
    // }
    // printf("id=%s  name=%s  surname=%s<br>", $row[0], $row[1], $row[2]);
}
// print_r($array);
foreach ($array as $key => $values) {
    echo "key: " . $key . "[";
    foreach ($values as $key1 => $value) {
        echo $key1 . "->" . $value . ", ";
    }
    echo "]<br>";
}

$result->free();
// close everything
close($db);
?>