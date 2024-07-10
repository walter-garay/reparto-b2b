<?php
    session_start();
    session_destroy();
    header("Location: ../vistas/Login/login.php");
    