# Correcciones

## insert-student.php

**Falta de Validación de Formato name(./institutions/insert_data_php/insert-student.php)**:

    ```php
        // Validate Name
        if (empty(trim($_POST["name"]))) {
            $name_err = "Please insert a Name.";
        } else {
            $name = trim($_POST["name"]);
        }
    ```
**Debe tener longitud menor a 30**:

    ```php
        // Ejemplo para validación de nombre
        if (empty(trim($_POST["name"]))) {
            $name_err = "Por favor, ingresa un nombre.";
        } elseif (!preg_match('/^[a-zA-Z\s]{1,30}$/', $_POST["name"])) {
            $name_err = "El nombre solo puede contener letras y espacios, y debe tener menos de 30 caracteres.";
        } else {
            $name = trim($_POST["name"]);
        }
    ```
**Validar grade menor a 10**:
    

    ```php
        // Validate grade
    if (empty(trim($_POST["grade"]))) {
        $grade_err = "Please insert student grade.";
    } else {
        $grade = trim($_POST["grade"]);
    }
    ```

    ```php
    // Validar grado
    if (empty(trim($_POST["grade"]))) {
        $grade_err = "Por favor, ingresa el grado del estudiante.";
    } elseif (!is_numeric($_POST["grade"])) {
        $grade_err = "El grado debe ser un número.";
    } elseif ($_POST["grade"] >= 10) {
        $grade_err = "El grado debe ser menor que 10.";
    } else {
        $grade = trim($_POST["grade"]);
    }
    ```
**validar date of birth igual a 10 caracteres**:
    

    ```php
    // Validate date_of_birth
    if (empty(trim($_POST["date_of_birth"]))) {
        $date_of_birth_err = "Please insert student date of birth.";
    } else {
        $date_of_birth = trim($_POST["date_of_birth"]);
    }
    ```

    ```php
    // Validar fecha de nacimiento
    if (empty(trim($_POST["date_of_birth"]))) {
        $date_of_birth_err = "Por favor, ingresa la fecha de nacimiento del estudiante.";
    } elseif (strlen($_POST["date_of_birth"]) !== 10) {
        $date_of_birth_err = "La fecha de nacimiento debe tener exactamente 10 caracteres.";
    } else {
        $date_of_birth = trim($_POST["date_of_birth"]);
    }
    ```
     
**validar address**:

    ```php
    // Validar dirección
    if (empty(trim($_POST["address"]))) {
        $address_err = "Por favor, ingresa una dirección.";
    } elseif (strlen($_POST["address"]) >= 17) {
        $address_err = "La dirección debe tener menos de 17 caracteres.";
    } else {
        $address = trim($_POST["address"]);
    }
    ```

**Falta de Validación de Formato address(./institutions/insert_data_php/insert-student.php)**:

    ```php
    // Example for address validation
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter an address.";
    } else {
        $address = trim($_POST["address"]);
    }
    ```



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

**edit-student.php**:
Anteriormente
```php
   // Validate Grade
    if (empty(trim($_POST["grade"]))) {
        $grade_err = "Please insert student grade.";
    } else {
        $grade = trim($_POST["grade"]);
    }

    // Validate date_of_birth
    if (empty(trim($_POST["date_of_birth"]))) {
        $date_of_birth_err = "Please insert student date of birth.";
    } else {
        $date_of_birth = trim($_POST["date_of_birth"]);
    }
   ```
Ahora se verifica que los valores ingresados en fecha e grado sean correctos y sigan un formato establecido a su vez se mandan los mensajes de error correspondientes si el usuario
se equivoca en le llenado de estos campos

```php
   // Validate Grade
    if (empty(trim($_POST["grade"]))) {
        $grade_err = "Please insert student grade.";
    } elseif (!is_numeric(trim($_POST["grade"]))) {
        $grade_err = "Grade must be a number.";
    } else {
        $grade = trim($_POST["grade"]);
    }

    // Validate date_of_birth
    if (empty(trim($_POST["date_of_birth"]))) {
        $date_of_birth_err = "Please insert student date of birth.";
    } else {
        $date_of_birth = trim($_POST["date_of_birth"]);
        // Validate date format (YYYY-MM-DD)
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_of_birth)) {
            $date_of_birth_err = "Invalid date format. Use YYYY-MM-DD.";
        }
    }

   ```
**search-child-feedback.php**:

   ```php
@@ -114,7 +156,6 @@ https://youtu.be/Jy_7nu-YjPI
steps to work with the app
https://youtu.be/XH7Y5X1_BgQ

# App:

![Alt text](https://github.com/abdallahyassein/schools_management_flutter_app/blob/master/screenshot.png?raw=true "Title")
# Website :
![Alt text](https://github.com/abdallahyassein/schools_management_flutter_app/blob/master/screenshot2.png?raw=true "Title")
