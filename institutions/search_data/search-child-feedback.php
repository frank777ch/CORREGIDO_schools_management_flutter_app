<?php
// Definir una constante para "<br/>"
const LINE_BREAK = "<br/>";

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo LINE_BREAK . "Please Login" . LINE_BREAK;
    exit;
}

require_once "../config.php";

if (isset($_POST['query'])) {
    $query = "SELECT * FROM children_feedback WHERE teacher_name LIKE '{$_POST['query']}%' AND children_feedback.school_id='{$_SESSION['id']}'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_array($result)) {
            echo LINE_BREAK;
            echo "<a style='color: #ffffff; padding-top: 2px;' href=\"../edit_data/edit-child-feedback.php?child_feedback_id=".$user['id']."\">";
            echo "ID : " . $user['id'] . LINE_BREAK;
            echo "Teacher Name : " . $user['teacher_name'] . LINE_BREAK;
            echo "Subject : " . $user['subject'] . LINE_BREAK;
            echo "Feedback : " . $user['feedback'] . LINE_BREAK;
        }
    }
}
?>