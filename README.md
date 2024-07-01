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

**Tamaño tablas**:
   ```SQL
   ALTER DATABASE tu_base_de_datos CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

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
