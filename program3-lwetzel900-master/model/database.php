<?php

//some of this taken from group project
$dsn = 'mysql:host=localhost;dbname=program3-lwetzel900';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    //Displays the exception and keeps on rolling, uncomment the exit if you want it to halt instead
    exit();
}

//user database functions***************************************************************************************
//insert user into table
function insertUser($fName, $lName, $email, $address, $city, $zip, $phone, $password) {
    global $db;

    $query = "insert into users
                    (fName, lName, email, address, city, zip, phone, password)
                    VALUES
                    (:fNamePlace, :lNamePlace, :emailPlace, :addressPlace, :cityPlace, :zipPlace, :phonePlace, :passwordPlace)";

    $statement = $db->prepare($query);
    $statement->bindValue(':fNamePlace', $fName);
    $statement->bindValue(':lNamePlace', $lName);
    $statement->bindValue(':emailPlace', $email);
    $statement->bindValue(':addressPlace', $address);
    $statement->bindValue(':cityPlace', $city);
    $statement->bindValue(':zipPlace', $zip);
    $statement->bindValue(':phonePlace', $phone);
    $statement->bindValue(':passwordPlace', $password);

    $statement->execute();
    $userId = $db->lastInsertId();
    $statement->closeCursor();

    return $userId;
}

//modified from group project
function getHashedPassword($email) {
    global $db;
    //looks for the email
    $query = "SELECT password FROM users WHERE email = :emailPlace";
    $statement = $db->prepare($query);
    $statement->bindValue(':emailPlace', $email);

    $statement->execute();
    $results = $statement->fetch();
    $statement->closeCursor();

    $hashedPassword = $results['password'];
    return $hashedPassword;
}

function getUserByEmail($email) {
    global $db;
    // not returning the password becuase we probably shouldn't.
    $query = "SELECT userID, fName, lName, email
                FROM users WHERE email = :emailPlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':emailPlace', $email);

    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $results[0];
}

function getUserByID($userID) {
    global $db;
    // not returning the password becuase we probably shouldn't.
    $query = "SELECT fName, lName
                FROM users WHERE userID = :idPlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':idPlace', $userID);

    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $results[0];
}

function getAllUsers() {
    global $db;

    $query = "select * from users";

    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;
}

//checks all emails for duplicates
function emailExists($email) {
    global $db;

    $query = "SELECT * FROM users WHERE email = :emailPlace";
    $statement = $db->prepare($query);
    $statement->bindValue(':emailPlace', $email);
//the execute method returns a boolean TRUE on success if there is a match or FALSE on failure.
    $success = $statement->execute();
    $statement->fetchAll(); //returns results of select statement if anything
    $statement->closeCursor();

    return $success;
}

//admin functions*************************************************************
function deleteUser($userID) {
    global $db;

    $query = 'DELETE FROM users
              WHERE userID = :idPlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':idPlace', $userID);
    $statement->execute();
    $statement->closeCursor();
}

//venue functions*********************************************************************
function getAllVenues() {
    global $db;

    $query = "select * from venue
                order by name";

    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $results;
}

function getVenueByID($venueID) {
    global $db;

    $query = "select name, city from venue
                        WHERE venueID = :idPlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':idPlace', $venueID);

    $statement->execute();
    $results = $statement->fetch();
    $statement->closeCursor();

    return $results[0];
}

function getVenueNameByID($venueID) {
    global $db;

    $query = "select name from venue
                        WHERE venueID = :idPlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':idPlace', $venueID);

    $statement->execute();
    $results = $statement->fetch();
    $statement->closeCursor();

    return $results[0];
}

function insertVenue($name, $city, $state, $venuePic) {
    global $db;

    $query = "insert into venue
                    (name, city, state, venuePic)
                    VALUES
                    (:namePlace, :cityPlace, :statePlace, :picPlace)";

    $statement = $db->prepare($query);
    $statement->bindValue(':namePlace', $name);
    $statement->bindValue(':cityPlace', $city);
    $statement->bindValue(':statePlace', $state);
    $statement->bindValue(':picPlace', $venuePic);

    $statement->execute();
    //$imageId = $db->lastInsertId();
    $statement->closeCursor();

    //return $imageId;
}

function deleteVenue($venueID) {
    global $db;

    $query = 'DELETE FROM venue
              WHERE venueID = :idPlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':idPlace', $venueID);
    $statement->execute();
    $statement->closeCursor();
}

//services functions***********************************************************
function getAllServices() {
    global $db;

    $query = "select * from services
                order by serviceType";

    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;
}

function getServiceByID($serviceID) {
    global $db;

    $query = "select serviceType, serviceDescription, servicePic from services
                        WHERE serviceID = :idPlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':idPlace', $serviceID);

    $statement->execute();
    $results = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $results;
}

function getServiceTypeByID($serviceID) {
    global $db;

    $query = "select serviceType from services
                        WHERE serviceID = :idPlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':idPlace', $serviceID);

    $statement->execute();
    $results = $statement->fetch();
    $statement->closeCursor();

    return $results[0];
}

function insertServices($serviceType, $serviceDescription, $servicePic) {
    global $db;

    $query = "insert into services
                    (serviceType, serviceDescription, servicePic)
                    VALUES
                    (:typePlace, :descriptPlace, :picPlace)";

    $statement = $db->prepare($query);
    $statement->bindValue(':typePlace', $serviceType);
    $statement->bindValue(':descriptPlace', $serviceDescription);
    $statement->bindValue(':picPlace', $servicePic);

    $statement->execute();
    $serviceId = $db->lastInsertId();
    $statement->closeCursor();

    return $serviceId;
}

function deleteService($serviceID) {
    global $db;

    $query = 'DELETE FROM services
              WHERE serviceID = :idPlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':idPlace', $serviceID);
    $statement->execute();
    $statement->closeCursor();
}

function updateService($serviceID, $serviceType, $serviceDescription, $servicePic) {
    global $db;

    $query = 'update services
                set serviceType = :typePlace, serviceDescription = :descriptPlace, servicePic = :picPlace
                WHERE serviceID = :servicePlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':servicePlace', $serviceID);
    $statement->bindValue(':typePlace', $serviceType);
    $statement->bindValue(':descriptPlace', $serviceDescription);
    $statement->bindValue(':picPlace', $servicePic);

    $statement->execute();
    $serviceId = $db->lastInsertId();
    $statement->closeCursor();

    return $serviceId;
}

//images functions*********************************************************
function insertImage($image) {
    global $db;

    $query = "insert into images
                    (galleryImages)
                    VALUES
                    (:imagePlace)";

    $statement = $db->prepare($query);
    $statement->bindValue(':imagePlace', $image);

    $statement->execute();
    $statement->closeCursor();
}

function getAllImages() {
    global $db;

    $query = "SELECT * FROM images";

    $statement = $db->prepare($query);

    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;
}

function deleteFromImages($imageID) {
    global $db;

    $query = 'DELETE FROM images
              WHERE imageID = :imagePlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':imagePlace', $imageID);
    $statement->execute();
    $statement->closeCursor();
}

//user selection functions**************************************************
function insertIntoSelection($userID, $venueID, $serviceID) {
    global $db;

    $query = 'insert into userselection
                    (userID, venueID, serviceID)
                    VALUES
                    (:userPlace, :venuePlace, :servicePlace)';

    $statement = $db->prepare($query);
    $statement->bindValue(':userPlace', $userID);
    $statement->bindValue(':venuePlace', $venueID);
    $statement->bindValue(':servicePlace', $serviceID);

    $statement->execute();
    $statement->closeCursor();
}

function getVenueIdFromVenueService($userID) {
    global $db;

    $query = 'select distinct venueID
                from userselection
                WHERE userID = :userPlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':userPlace', $userID);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_COLUMN);
    $statement->closeCursor();

    return $results;
}

function getUserVenueServiceByUserID($userID) {
    global $db;

    $query = 'SELECT v.name, s.serviceType
                FROM userselection u
                JOIN venue v ON u.venueID = v.venueID
                JOIN services s ON u.serviceID = s.serviceID
                WHERE userID = :userPlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':userPlace', $userID);

    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_GROUP);
    $statement->closeCursor();

    return $results;
}

function idExistInUserSelection($userID) {
    global $db;

    $query = "SELECT * FROM userselection
        WHERE userID = :userPlace";
    $statement = $db->prepare($query);
    $statement->bindValue(':userPlace', $userID);
//the execute method returns a boolean TRUE on success or FALSE on failure.
    $success = $statement->execute();
    $statement->fetchAll(); //returns results of select statement if anything
    $statement->closeCursor();

    return $success;
}

function deleteIDUserSelection($userID, $venueID) {
    global $db;

    $query = 'DELETE FROM userselection
              WHERE userID = :userPlace and
              venueID = :venuePlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':userPlace', $userID);
    $statement->bindValue(':venuePlace', $venueID);
    $statement->execute();
    $statement->closeCursor();
}

//function insertServiceIntoSelection($userID, $serviceID) {
//    global $db;
//
//    $query = 'update userselection
//                set serviceID = :servicePlace
//                    WHERE userID = :userPlace';
//
//    $statement = $db->prepare($query);
//    $statement->bindValue(':userPlace', $userID);
////    $statement->bindValue(':venuePlace', $venueID);
//    $statement->bindValue(':servicePlace', $serviceID);
//
//    $statement->execute();
//    //$imageId = $db->lastInsertId();
//    $statement->closeCursor();
//
//    //return $imageId;
//}
//
//function insertVenueIntoSelection($userID, $venueID) {
//    global $db;
//
//    $query = 'update userselection
//                set venueID = :venuePlace
//                    WHERE userID = :userPlace';
//
//    $statement = $db->prepare($query);
//    $statement->bindValue(':userPlace', $userID);
//    $statement->bindValue(':venuePlace', $venueID);
////    $statement->bindValue(':servicePlace', $serviceID);
//
//    $statement->execute();
//    //$imageId = $db->lastInsertId();
//    $statement->closeCursor();
//
//    //return $imageId;
//}

//venueService table functions**********************************************
function getVenueServiceByID($venueID) {
    global $db;

    $query = "select * from venueservice
                where venueID = :venuePlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':venuePlace', $venueID);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    $services = array();
    foreach ($results as $ser) {
        $services[] = $ser['serviceID'];
    }

    return $services;
}

function insertVenueService($venueID, $serviceID) {
    global $db;

    $query = 'insert into venueservice
                    (venueID, serviceID)
                    VALUES
                    (:venuePlace, :servicePlace)';

    $statement = $db->prepare($query);
    $statement->bindValue(':venuePlace', $venueID);
    $statement->bindValue(':servicePlace', $serviceID);

    $statement->execute();
    $statement->closeCursor();
}

function checkVenueService($venueID, $serviceID) {
    global $db;
    
    $query = 'select * FROM venueservice
              WHERE venueID = :venuePlace and
              serviceID = :servicePlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':venuePlace', $venueID);
    $statement->bindValue(':servicePlace', $serviceID);
    $success = $statement->execute();
    $statement->closeCursor();
    
    return $success;
}

function deleteServiceFromVenue($venueID, $serviceID) {
    global $db;
    
    $query = 'DELETE FROM venueservice
              WHERE venueID = :venuePlace and
              serviceID = :servicePlace';

    $statement = $db->prepare($query);
    $statement->bindValue(':venuePlace', $venueID);
    $statement->bindValue(':servicePlace', $serviceID);
    $statement->execute();
    $statement->closeCursor();
}

function getServiceNamesFromVS($venueID) {
    global $db;

    $query = "SELECT * FROM venueservice v JOIN services s
        ON v.serviceID = s.serviceID WHERE venueID = :venuePlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':venuePlace', $venueID);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;
}

function VenueName($serviceID) {
    global $db;

    $query = "SELECT distinct name FROM venueservice vs JOIN venue v
        ON vs.venueID = v.venueID WHERE serviceID = :servicePlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':servicePlace', $serviceID);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_COLUMN);
    $statement->closeCursor();

    return $results;
}

function ServiceName($venueID) {
    global $db;

    $query = "SELECT serviceType FROM venue v JOIN services s
        ON v.serviceID = s.serviceID  WHERE venueID = :venuePlace";

    $statement = $db->prepare($query);
    $statement->bindValue(':venuePlace', $venueID);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    $services = array();
    foreach ($results as $ser) {
        $services[] = $ser['serviceType'];
    }

    return $services;
}


