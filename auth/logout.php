<?php
    session_start();
    session_destroy();

    header("Location: /reparto-b2b/index.php");