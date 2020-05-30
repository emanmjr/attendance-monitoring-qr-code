<!DOCTYPE html>
<html >
<head>
</head>
<body>
    
    <div class="email-body">
        <p>Hi {{ $first_name }},</p>
        <p>Your account is now ready to be used. All you need to do is click the link below:</p>
        <p>
            <a href="{{ $confirmation_code }}" >Verify my account</a>
        </p>
        <p>
            After verifying your account, you need to change your temporary password.
            <br>
            <br>
            Email address: {{ $email }} <br>
            Your temporary password is: {{ $tempPassword }}
        </p>
        <br>
        <p>Thank You.</p>
        <p><strong>Your I-Pay Commerce Venture Team</strong></p>
    </div>
    
    <footer class="custom-footer">
        <center>Copyright © 2020 I-Pay Commerce Ventures Inc. All Rights Reserved.</center>
    </footer>
    
    
    <style>
        .custom-indent{
            margin-left: 20px;
        }
        body{
            background-color: #f5f8fa;
            color: #74787E;
        }
        .email-body{
            margin-left: 20px;
            margin-right: 20px;
            background: white;
            padding: 20px;
        }
        .email-logo{
            height: 50px;
        }
        .custom-email-header{
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 20px;
            padding: 10px;
            background: #c61e1f;
        }
        .custom-footer{
            background: #353535;
            padding: 20px;
            margin: 0 20px;
            margin-bottom: 20px;
        }
    </style>


</body>
</html>