# ANT - Assessment

## How to build and run?

### Prerequisite
* PHP 7
* Composer

### Build

Execute command: 

    composer build

wait until it's done.

### Run

Execute command:

    php -S localhost:8000 -t public
    
The application can be access in http://localhost:8000 after it started.
    
Live running application deployed on heroku and can be found on https://php-assessment-ant.herokuapp.com/.

## Api Path

Detail of the endpoint is on the api documentation online https://php-assessment-ant.herokuapp.com/api/documentation.
Accessing the public api will take sometime to load (about 20 second), because the server is shutdown and need to be started again.

### soldier

A soldier go to a war
- Soldier bring magazine
- Soldier put an ammo
- Soldier test magazine
- Soldier clear magazine

### shop

A shop with minus quantity problem
- Mom can create new product
- Mom can reduce a product qty
- Mom can clear all the product

### game

Joni couldn't find his key
- Joni find his key
Andi give Joni instruction to his key location
the output result will give the possibility of key location with 2 dimensional matrix and each it's position

```
{
  "location": [
    { "x": 3, "y": 4 },
    { "x": 5, "y": 2 },
    { "x": 5, "y": 3 },
    { "x": 5, "y": 4 },
    { "x": 6, "y": 2 }
  ],
  "mark": [
    ["#", "#", "#", "#", "#", "#", "#", "#"],
    ["#", ".", ".", ".", ".", ".", ".", "#"],
    ["#", ".", "#", "#", "#", "O", "O", "#"],
    ["#", ".", ".", ".", "#", "O", "#", "#"],
    ["#", "X", "#", "O", ".", "O", ".", "#"],
    ["#", "#", "#", "#", "#", "#", "#", "#"]
  ]
}
```

### tennis

Rahman will playing tennis
- Rahman bring ball container
- Rahman put a ball into container
- Rahman clear container

## Unit Test

To run unit test for Ball solution run

```
vendor/bin/phpunit
```
