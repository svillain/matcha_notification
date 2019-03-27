<?php
include("database.php");
include('./../vendor/autoload.php');
include('./../vendor/fzaninotto/faker/src/autoload.php');

if (!file_exists('../userphoto')) {
    mkdir('../userphoto');
}

try {
    $pdobj = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
    $pdobj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdobj->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
try {
    $query = file_get_contents("db.sql");
    $pdobj->exec($query);

    $faker = Faker\Factory::create('fr_FR');
	$faker->addProvider(new Faker\Provider\fr_FR\Person($faker));
	$faker->addProvider(new Faker\Provider\fr_FR\Company($faker));
	$faker->addProvider(new Faker\Provider\fr_FR\Address($faker));
	$faker->addProvider(new Faker\Provider\Lorem($faker));
	$faker->addProvider(new Faker\Provider\Internet($faker));
	$stmt = $pdobj->prepare("SET FOREIGN_KEY_CHECKS=0");
	$stmt->execute();
	foreach (range(1, 750) as $x)
	{
		$prenom = $faker->firstName($gender = 'male'|'female');
		$bio = $faker->paragraph($nbSentences = 1, $variableNbSentences = true);
		$gender = $faker->randomElement($array = array ('Man','Woman'));
		$age = $faker->numberBetween($min = 18, $max = 70);
		$attraction = $faker->randomElement($array = array ('Men','Women','Both'));
		$localisation = $faker->address;
		$imgurl = $faker->imageUrl($width = 640, $height = 480);
		$pdobj->query("INSERT INTO users (username, email, name, surname, age, gender, bio, attraction, localisation, path_photo1) VALUES 
			('{$faker->userName}', 
			 '{$faker->email}',
			 '{$faker->lastName}', 
			 '" . $prenom . "',
			 '". $age . "', 
			'". $gender . "',
			'". $bio . "',		 
			'". $attraction . "',
			'".$localisation."',
			'".$imgurl."'
			)");
	}
	$i = 1;
    $stmt = $pdobj->prepare("SET FOREIGN_KEY_CHECKS=1");
    $stmt->execute();
}
catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
