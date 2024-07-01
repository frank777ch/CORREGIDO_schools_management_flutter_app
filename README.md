# Correcciones

Se ha modificado .....

**Falta de Validación de Formato de Email(./institutions/register.php)**:
   ```php
   // Validate Email
   if (empty(trim($_POST["email"]))) {  // check if the email input not empty
       $email_err = "Please insert a Email."; // if it is empty show the user this message
   } else {
       $email = trim($_POST["email"]); // if is not empty take the value that the user entered from the input
   }
   ```
   Sería recomendable validar el formato del email:
   ```php
   // Validate Email
   if (empty(trim($_POST["email"]))) {  
       $email_err = "Please insert an Email."; 
   } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
       $email_err = "Invalid email format.";
   } else {
       $email = trim($_POST["email"]); 
   }
   ```

**Validación de Número de Teléfono(./institutions/register.php)**:
   ```php
   // Validate number
   if (empty(trim($_POST["number"]))) {
       $number_err = "Please insert a Number."; 
   } else {
       $number = trim($_POST["number"]); 
   }
   ```
   validar que sólo contenga dígitos:
   ```php
   if (empty(trim($_POST["number"]))) {
       $number_err = "Please insert a Number."; 
   } elseif (!ctype_digit(trim($_POST["number"]))) {
       $number_err = "Please insert a valid Number."; 
   } else {
       $number = trim($_POST["number"]); 
   }
   ```
Se ha modificado .....

**search-child-feedback.php**:

   ```php
   if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
   echo 
"<br/>";
    echo"<a style='color: #ffffff;  padding-top: 2px;' href=\"../edit_data/edit-child-feedback.php?child_feedback_id=".$user['id']."\">";
    echo "ID : ".$user['id'].
"<br/>";
    echo "Teacher Name : ".$user['teacher_name'].
"<br/>";
    echo "Subject : ".$user['subject'].
"<br/>";
    echo "Feedback : ".$user['feedback'].
"<br/>";
    }
   ```
   Se ha modificado un literal asignandolo como constante para mejorar la mantenibilidad y legibilidad del codigo
   ```php
   const LINE_BREAK = "<br/>";
   
   // Check if the user is logged in, if not then redirect him to login page
   if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
       echo LINE_BREAK . "Please Login" . LINE_BREAK;
       exit;
   }
   ```


**institutions/show_data/search-parents.php**:
   Anteriormente se realizaba un echo usando () lo cual es propenso a errores si se quiere imprimir mas de un parametro
```php
   echo ("<td align='center'><a href=\"../edit_data/edit-parent.php?parent_id=".$user['id']."\">Edit</a></td>");
   echo ("<td align='center'><a href=\"../remove_data/remove-parent.php?parent_id=".$user['id']."\">Remove</a></td>");
   ```
   Se ha modificado para robustecer el codigo
   ```php
   if (mysqli_num_rows($result) > 0) {
                        while ($user = mysqli_fetch_array($result)) {
                            if ($user['school_id'] == (int)$_SESSION['id']) {
                            $id = $user['id'];
                            echo "<td align='center'>" . $user['id'] . "</td>";
                            ...
                            echo "<td align='center'><a href=\"../edit_data/edit-parent.php?parent_id=".$user['id']."\">Edit</a></td>";
                            echo "<td align='center'><a href=\"../remove_data/remove-parent.php?parent_id=".$user['id']."\">Remove</a></td>";
                            echo "</tr>";
                        }
                    }
                }
   ```









# schools_management_flutter_app
Schools Management App + Website 

Video for the app 
https://youtu.be/Jy_7nu-YjPI

steps to work with the app
https://youtu.be/XH7Y5X1_BgQ


# App:

![Alt text](https://github.com/abdallahyassein/schools_management_flutter_app/blob/master/screenshot.png?raw=true "Title")

# Website :

![Alt text](https://github.com/abdallahyassein/schools_management_flutter_app/blob/master/screenshot2.png?raw=true "Title")
