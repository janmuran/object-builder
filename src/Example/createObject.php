<?php

use Janmuran\ObjectBuilder\Example\Object\Person;

require_once '../../vendor/autoload.php';

$objectBuilder = new \Janmuran\ObjectBuilder\ResponseBuilder(\JMS\Serializer\SerializerBuilder::create()->build());

$json = file_get_contents('person.json');
if ($json === false) {
    throw new Exception('Unable load test file content');
}

$object = $objectBuilder->createObjectFromString($json, Person::class);

if (!$object instanceof Person) {
    throw new Exception('Invalid object type');
}

echo 'Test object created successful';
