<?php
    $msg = '';
    $msgClass = '';
    if(filter_has_var(INPUT_POST, 'submit')){
       
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if(!empty($email) && !empty($name) && !empty($message)){
           
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                $msg = 'Please a valid email';
                $msgClass = 'alert-danger';
            }
            else {
                $toEmail = 'akinloludavid27@yahoo.com';
                $subject = 'Contact Request from '.$name;
                $body = '<h2>Contact Request</h2>
                        <h4>Name</h4> <p> '.$name.'</p>
                        <h4>Email</h4> <p> '.$email.'</p>
                        <h4>Message</h4> <p> '.$message.'</p>';

                    $headers = "MIME-Version: 1.0" ."\r\n";
                    $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: " .$name. "<".$email.">". "\r\n";

                    if(mail($toEmail, $subject, $body, $headers)){
                        $msg = "Your email has been sent";
                        $msgClass = "alert-success";
                    }
                    else{
                        $msg = 'Your email was not sent';
                        $msgClass = 'alert-danger';
                    }
            }
        }
        else {
            $msg = "Please fill in all fields";
            $msgClass = 'alert-danger';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <title>Contact</title>
</head>
<body>


    <div class="container">
    
    <?php if ($msg != ''): ?>
        <div class = "alert <?php echo $msgClass; ?>"><?php echo $msg; ?> </div>

    <?php endif; ?>
    
    <form method = "post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name = "name" class = "form-control" value = "<?php echo isset($_POST['name']) ? $name : ''; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name = "email" class = "form-control" value = "<?php echo isset($_POST['email']) ? $email : ''; ?>"">
        </div>

       

        <div class="form-group">
            <label for="message">Message</label>
            <textarea type="text" name = "message" class = "form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
        </div>

        <button type = "submit" name = "submit" class = "btn btn-primary">Submit</button>


    </form>
    </div>
</body>
</html>