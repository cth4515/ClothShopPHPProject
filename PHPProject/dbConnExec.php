<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// function to connect to the database

function dbConnect()
{
    $serverName = 'buscissql1601\cisweb';
    $uName = 'larger';
    $pWord = 'scale';
    $db = 'Team103DB';
    
     try
    {
        //instantiate a PDO object and set connection properties
        
        $conn = new PDO("sqlsrv:Server=$serverName; Database=$db", $uName, $pWord, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $conn;   
    }
    // if connection fails
    
    catch (PDOException $e)
    {
        die('Connection failed: ' . $e->getMessage());
    }
}

//method to execute a query - the SQL statement to be executed, is passed to it

function executeQuery($query)
{
    // call the dbConnect function

    $conn = dbConnect();

    try
    {
        // execute query and assign results to a PDOStatement object

        $stmt = $conn->query($query);

        do
        {
            if ($stmt->columnCount() > 0)  // if rows with columns are returned
            {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //retreive the rows as an associative array
            }
        } while ($stmt->nextRowset());  
        dbDisconnect($conn);

        return $results;
    }
    catch (PDOException $e)
    {
        //if execution fails

        dbDisconnect($conn);
        die ('Query failed: ' . $e->getMessage());
    }
}
function dbDisconnect($conn)
{
    // closes the specfied connection and releases associated resources

    $conn = null;
}

?>
