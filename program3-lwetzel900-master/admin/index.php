<?php
session_set_cookie_params(6000, '/');
session_start();
require_once('../model/database.php');
require_once ('../model/valid.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'adminLogin';
    }
}

$allServices = getAllServices();
$allVenues = getAllVenues();

switch ($action) {

    case 'adminLogin':
        $errorMessage = "";
        include ('adminLogin.php');
        exit();
        break;
    case 'admin':
        $password = filter_input(INPUT_POST, 'password');
        if (!empty($password) && adminPassword($password)) {
            header("Location: ?action=adminWork");
            exit();
        } else {
            $errorMessage = "Stop Playing";
            include ('adminLogin.php');
            exit();
        }
        break;

    case 'adminWork':
        $galleryImages = getAllImages();
        include ('adminWork.php');
        break;

//admin user view
    case 'userUpdate':
        $allUsers = getAllUsers();
        include('manageUser.php');
        break;

    case 'deleteUser':
        $userID = filter_input(INPUT_POST, 'userID');
        deleteUser($userID);
        header("Location: ?action=userUpdate");
        break;

//venue views
    case 'venueUpdate':
        include('venueUpdate.php');
        break;

    case 'deleteVenue':
        $venueID = filter_input(INPUT_POST, 'venueID');
        $imageLocation = filter_input(INPUT_POST, 'imageLocation');
        deleteVenue($venueID);
        unlink("../" . $imageLocation); //not sure if this is right
        header("Location: ?action=venueUpdate");
        break;

    case 'venueAdd':
        $vName = filter_input(INPUT_POST, 'name');
        $vCity = filter_input(INPUT_POST, 'city');
        $vState = filter_input(INPUT_POST, 'state');

        $place = 'venue';
        $vPic = uploadPic($place);

        if (empty($vPic)) {
            $vPic = "images/venue/venueDefault.jpg";
        }

        insertVenue($vName, $vCity, $vState, $vPic);
        header("Location: ?action=venueUpdate");
        break;

//service views
    case 'servicesUpdate':
        unset($_SESSION['service']);
        include('serviceUpdate.php');
        break;

    case 'deleteService':
        $serviceID = filter_input(INPUT_POST, 'serviceID');
        $imageLocation = filter_input(INPUT_POST, 'imageLocation');
        deleteService($serviceID);
        unlink("../" . $imageLocation); //not sure if this is right
        header("Location: ?action=servicesUpdate");
        break;

    case 'editServiceView':
        $serviceID = filter_input(INPUT_POST, 'serviceID');
        $name = VenueName($serviceID);
        $_SESSION['service'] = getServiceByID($serviceID);
        $type = $_SESSION['service']['serviceType'];
        $pic = $_SESSION['service']['servicePic'];
        $desription = $_SESSION['service']['serviceDescription'];
        include('editService.php');
        break;

    case 'updateService':
        $serviceID = filter_input(INPUT_POST, 'ID');
        $serviceType = filter_input(INPUT_POST, 'type');
        $serviceDescription = filter_input(INPUT_POST, 'description');

        $place = 'service';
        $servicePic = uploadPic($place);

        if (empty($servicePic)) {
            $servicePic = $_SESSION['service']['servicePic'];
        }

        updateService($serviceID, $serviceType, $serviceDescription, $servicePic);

        $venueID = filter_input(INPUT_POST, 'venueSelect');
        if (checkVenueService($venueID, $serviceID)) {
            deleteServiceFromVenue($venueID, $serviceID);
        }
        insertVenueService($venueID, $serviceID);

        header("Location: ?action=servicesUpdate");
        break;

    case 'serviceAdd':
        $serviceID = filter_input(INPUT_POST, 'ID');
        $sType = filter_input(INPUT_POST, 'type');
        $sDescript = filter_input(INPUT_POST, 'description');
        //$sPic = filter_input(INPUT_POST, 'pic');
        $venueID = filter_input(INPUT_POST, 'venueSelect');

        $place = 'service';
        $sPic = uploadPic($place);

        if (empty($sPic)) {
            $sPic = "images/service/serviceDefault.jpg";
        }

        $serviceIDReturned = insertServices($sType, $sDescript, $sPic);
        insertVenueService($venueID, $serviceIDReturned);
        header("Location: ?action=servicesUpdate");
        break;

//image views and actions
    case 'uploadImage':
        $place = 'gallery';
        $picPlace = uploadPic($place);
        insertImage($picPlace);
        header("Location: ?action=adminWork");
        break;

    case 'deleteImage';
        $imageID = filter_input(INPUT_POST, 'imageID');
        $imageLocation = filter_input(INPUT_POST, 'imageLocation');
        deleteFromImages($imageID);
        unlink("../" . $imageLocation); //not sure if this is right
        header("Location: ?action=adminWork");
        break;

    case'logout':
        session_unset();
        header("Location: ..");
        exit();
        break;
}

function uploadPic($place) {
    //taken from moodle
    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        //$file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        //$file_type = $_FILES['image']['type'];
        //$temp = $_FILES['image']['name'];
        $temp = explode('.', $file_name);
        $temp = end($temp);
        $file_ext = strtolower($temp);

        $extensions = array("jpeg", "jpg", "png", "gif");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "file extension not in whitelist: " . join(',', $extensions);
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../images/$place/" . $file_name); //not sure if this is right
            $imageURL = "images/$place/" . $file_name;
            //echo "Success";
        } else {
            //var_dump($errors);
        }
    }
    return $imageURL;
}
