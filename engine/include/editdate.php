<?php
session_start();

    require_once ($_SERVER['DOCUMENT_ROOT'].'/engine/classes/Engine.php');

        $edit_month = $_POST['edit_month'];
        $editmonth = new Statistics();
        $editmonth->editMonth($edit_month);







