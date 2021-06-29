<?php
//Use Recognition Client
session_start();
$_SESSION['aadhaar']=true;

require 'aws/aws-autoloader.php';
use Aws\Rekognition\RekognitionClient;

$rawData = $_POST['imgBase64'];
$filteredData = explode(',', $rawData);
$unencoded = base64_decode($filteredData[1]);
$randomName = rand(0, 99999);
//Create the image 
$fp = fopen('test.png', 'w');
fwrite($fp, $unencoded);
fclose($fp);

function check_faces($t1,$t2)
{
//Credentials for access AWS Service code parameter
$credentials = new Aws\Credentials\Credentials('AKIAXHI5XG5NOJZA7P6L', 'TV4Dpgwqy6mts/rm0OegDxs62VtstH97gddwErcO');

//Get Rekognition Access
$rekognitionClient = RekognitionClient::factory(array(
    		'region'	=> "eu-west-1",
    		'version'	=> 'latest',
        'credentials' => $credentials
));

//Calling Compare Face function
$compareFaceResults= $rekognitionClient->compareFaces([
        'SimilarityThreshold' => 80,
        'SourceImage' => [
            'Bytes' => file_get_contents($t1)
        ],
        'TargetImage' => [
            'Bytes' => file_get_contents($t2)
        ],
]);
$flag=0;
$FaceMatchesResult = $compareFaceResults['FaceMatches'];
foreach ($FaceMatchesResult as $val)
{
	foreach ($val as $val1)
	{
		$flag=1;
		break;
	}
}
return ($flag);
}

if(check_faces('test.png','database/images/test.jpg'))
	echo '1';
else if(check_faces('test.png','database/images/1.jpeg'))
	echo '1';
else if(check_faces('test.png','database/images/2.jpeg'))
	echo '1';
else if(check_faces('test.png','database/images/3.jpeg'))
	echo '1';

else
	echo '0';
?>