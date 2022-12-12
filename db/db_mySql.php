<?php
    // session_start();
    $settings = parse_ini_file('../config/settings.ini', true);
    // DEBUG:
    // var_dump($settings);

    $nomDriverBaseDeDades = $settings['databaseMySql']['dbDriver'];
    $nomServerBaseDeDades = $settings['databaseMySql']['ServHost'];
    $nomNostraBaseDeDades = $settings['databaseMySql']['dataBase'];
    $nomUsuariBaseDeDades = $settings['databaseMySql']['usr'];
    $pwdUsuariBaseDeDades = $settings['databaseMySql']['pwd'];				

    // crear objecte cnn de tipus class mysqli(server,user,pwd,nameBD)
    //      també es pot fer:  $cnn = mysqli_connect('localhost','root','','php_mysql_crud');
    $cnn = new mysqli($nomServerBaseDeDades, 
                      $nomUsuariBaseDeDades, 
                      $pwdUsuariBaseDeDades, 
                      $nomNostraBaseDeDades);
        
    // debugar
    printf("<div>");
    printf("Server: " . $nomServerBaseDeDades . " / ");
    printf("Usuari: " . $nomUsuariBaseDeDades . " / ");
    printf("Passwd: " . $pwdUsuariBaseDeDades . " / ");
    printf("BDades: " . $nomNostraBaseDeDades . " / ");
    printf("</div>");

    // comprobar conexió:
    if (isset($cnn)){
        echo "DB is connected. / ";
    }

    if ($cnn->connect_error)
    {
        printf("Error de connexió a la BD.");
    }
    else
    {
        printf("Connexió ok!");
    }

    // DEBUG: dades combo desplegable:
    $queryUsersAll = "SELECT * FROM users";
    $recordsetUsers = mysqli_query($cnn,$queryUsersAll);
    $queryTasksAll = "SELECT * FROM tasks";
    $recordsetTasks = mysqli_query($cnn,$queryTasksAll);
