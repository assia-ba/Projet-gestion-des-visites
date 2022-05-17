<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="..\css\login.css" media="screen" type="text/css" />
        <title>تسجيل الدخول</title>
    </head>
    <?php $sens="rtl"; ?>
    <body dir=<?php echo $sens; ?> >
    <header><fieldset class="fieldset"  style='margin-left:15%; margin-right:15%; width:70%;'><h1 style="color:#aecff8;text-align: center;">فضاء تسجيل الزيارات<h1></fieldset ></header> 
        <div id="container" align="center">           
            <form action="../model/verification.php" method="POST">
                <fieldset class="fieldset" style='margin-left:15%; margin-right:15%; width:100%; margin-top:10%;'>
                    <h3><legend align="center">تسجيل الدخول</legend></h3>
                    <table>
                        <tr>
                            <td><b>إسم المستخدم:</b></td>
                            <td><input type="text"  name="username" placeholder="اسم المستخدم" required oninvalid="this.setCustomValidity('المرجو إدخال إسم المستخدم')" oninput="this.setCustomValidity('')" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td><b>كلمة المرور :</b></td>
                            <td><input type="password" name="password" placeholder="كلمة المرور" required oninvalid="this.setCustomValidity('المرجو إدخال كلمة المرور')" oninput="this.setCustomValidity('')"></p></td>
                        </tr>
                    </table>           
                    <p align="center"><input type="submit" id='submit' value='دخول' style='width:25%' ></p>
                    <?php 
                        if(isset($_GET['erreur'])){
                            $err = $_GET['erreur'];
                            if($err==1 || $err==2)
                                echo "<p align='center' style='font-size:20px;color:red'>إسم المستخدم أو كلمة السر خاطئة</p>";
                        }
                    ?>
                </fieldset>
            </form>
        </div>
    </body>
</html>