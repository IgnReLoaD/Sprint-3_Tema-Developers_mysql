<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"    content="width=device-width, initial-scale=1.0">
    <meta name="author"      content="Ignasi Ortiz, Carlos Leichner, Gabriel Farrus" />
	<meta name="description" content="IT Academy - FullStack LAMP" />
    <title>PhP Developers MySql</title>
    <link rel="shortcut icon" href="./images/favicon.ico">
    <!-- cdn per incorporar Tailwind al projecte  -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- bootstrap 4 --> 
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
          crossorigin="anonymous">
    <!-- font awesome 5  -->
    <script src="https://kit.fontawesome.com/afe5486742.js" crossorigin="anonymous"></script>    
</head>
<body class="bg-blue-200">
    <nav class="navbar navbar-dark bg-pink-500 flex">
        <div class="container justify-start">
            <div class="d-inline flex-row">
                <img src="./images/tasks_96x96.png"/>                
            </div>
            <div>
                <a href="#" class="navbar-brand font-extrabold">PHP Developers Team v.MySql</a>
            </div>
        </div>
        <div>
            <?php include("../db/db_mySql.php");  ?>
        </div>
        <select class="form-control" id="cmbMaster" name="cmbMaster" autofocus>
            <option value="0" name="optMaster">usuaris...</option>                    
            <?php                                      
                while ($fieldset = mysqli_fetch_array($recordsetUsers)){
                    echo'<option value="'.$fieldset['id_user'].'">'.$fieldset['rol'].' - '.$fieldset['name'].'</option>';
                }
            ?>
        </select> 
        <select class="form-control" id="cmbMaster" name="cmbMaster" autofocus>
            <option value="0" name="optMaster">tasques...</option>                    
            <?php                      
                // echo $fieldset;
                while ($fieldset = mysqli_fetch_array($recordsetTasks)){
                    echo'<option value="' . $fieldset['id_task'] . '">' . 'Created: ' . $fieldset['created_at'].' - Descrip: ' . $fieldset['descrip'].' - Master: '.$fieldset['masterUsr_id'].' - Slave: '.$fieldset['slaveUsr_id'].' - Status: '.$fieldset['currentStatus'].'</option>';
                }
            ?>
        </select> 
    </nav>
