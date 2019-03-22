<?php

include("database.php");
include('./../vendor/autoload.php');

try {
	$count = 750;
	$pdobj = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD,  array(
        PDO::ATTR_PERSISTENT => true
    ));	
	$pdobj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$seeder = new \tebazil\dbseeder\Seeder($pdobj);
	$generator = $seeder->getGeneratorConfigurator();
	$faker = $generator->getFakerConfigurator();
	$stmt = $pdobj->prepare("SET FOREIGN_KEY_CHECKS=0");
	$stmt->execute();
	$seeder->table('users')->columns([
	            'iduser', //automatic pk
	            'username'=>$faker->userName,
	            'email'=>$faker->email,
	            'password'=>$faker->password
	            	            
	        ])->rowQuantity( $count );

	 $seeder->table('users')->columns([
	            'name'=>$faker->lastName,
	            'surname'=>$faker->firstName($gender = 'male'|'female'),
	            'age'=>$faker->numberBetween($min = 18, $max = 100),
	            'gender'=>$faker->randomElement($array = array ('homme','femme','autre')),
	            'localisation'=>$faker->city, 
	            'attraction'=>$faker->randomElement($array = array ('Heterosexuel','Homosexuel','Bisexuel', 'Asexuel', 'Transexuel')), 
	            'bio'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true), 
	            
	        ])->rowQuantity( $count );

	$seeder->refill();

    $stmt = $pdobj->prepare("SET FOREIGN_KEY_CHECKS=1");
    $stmt->execute();

}
catch (PDOException $e){
	echo 'Connection failed: ' . $e->getMessage();
}

?>