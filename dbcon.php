<?php
    require __DIR__.'/vendor/autoload.php';
    use Kreait\Firebase\Factory;
    $factory = (new Factory)
    ->withServiceAccount('dehims.json')
    ->withDatabaseUri('https://dehims-4c9bd-default-rtdb.firebaseio.com/');
    $database = $factory->createDatabase();
    $reference = $database->getReference('path/to/child/location');
    
?>