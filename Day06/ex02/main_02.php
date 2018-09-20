<?php
/* ************************************************************************** */
/*                                                                            */
/*                 main_02.php for J06                                        */
/*                 Created on : Mon Mar 31 17:37:41 2014                      */
/*                 Made by : David "Thor" GIRON <thor@42.fr>                  */
/*                                                                            */
/* ************************************************************************** */

require_once '../ex00/Color.class.php';
require_once '../ex01/Vertex.class.php';
require_once 'Vector.class.php';


Vertex::$verbose = False;

print( Vector::doc() );
Vector::$verbose = True;


$vtxO = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
$vtxX = new Vertex( array( 'x' => 1.0, 'y' => 0.0, 'z' => 0.0 ) );
$vtxY = new Vertex( array( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0 ) );
$vtxZ = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0 ) );

$vtcXunit = new Vector( array( 'orig' => $vtxO, 'dest' => $vtxX ) ); //Vector( x:1.00, y:0.00, z:0.00, w:0.00 ) constructed 
$vtcYunit = new Vector( array( 'orig' => $vtxO, 'dest' => $vtxY ) ); //Vector( x:0.00, y:1.00, z:0.00, w:0.00 ) constructed
$vtcZunit = new Vector( array( 'orig' => $vtxO, 'dest' => $vtxZ ) ); //Vector( x:0.00, y:0.00, z:1.00, w:0.00 ) constructed

print( $vtcXunit . PHP_EOL ); //Vector( x:1.00, y:0.00, z:0.00, w:0.00 )
print( $vtcYunit . PHP_EOL ); //Vector( x:0.00, y:1.00, z:0.00, w:0.00 )
print( $vtcZunit . PHP_EOL ); //Vector( x:0.00, y:0.00, z:1.00, w:0.00 )

$dest1 = new Vertex( array( 'x' => -12.34, 'y' => 23.45, 'z' => -34.56 ) );
 Vertex::$verbose = True;
 $vtc1  = new Vector( array( 'dest' => $dest1 ) ); //Vertex( x: 0.00, y: 0.00, z:0.00, w:1.00, Color( red: 255, green: 255, blue: 255 ) ) constructed
 Vertex::$verbose = False;

$orig2 = new Vertex( array( 'x' => 23.87, 'y' => -37.95, 'z' => 78.34 ) );
$dest2 = new Vertex( array( 'x' => -12.34, 'y' => 23.45, 'z' => -34.56 ) );
$vtc2  = new Vector( array( 'orig' => $orig2, 'dest' => $dest2 ) ); // Vector( x:-36.21, y:61.40, z:-112.90, w:0.00 ) constructed

print( 'Magnitude is ' . $vtc2->magnitude() . PHP_EOL ); // Magnitude is 133.51978917

$nVtc2 = $vtc2->normalize(); // Vector( x:-0.27, y:0.46, z:-0.85, w:0.00 ) constructed

print( 'Normalized $vtc2 is ' . $nVtc2 . PHP_EOL ); //Normalized $vtc2 is Vector( x:-0.27, y:0.46, z:-0.85, w:0.00 )
//
print( 'Normalized $vtc2 magnitude is ' . $nVtc2->magnitude() . PHP_EOL ); // Normalized $vtc2 magnitude is 1

print( '$vtc1 + $vtc2 is ' . $vtc1->add( $vtc2 ) . PHP_EOL ); // $vtc1 + $vtc2 is Vector( x:-48.55, y:84.85, z:-147.46, w:0.00 )
print( '$vtc1 - $vtc2 is ' . $vtc1->sub( $vtc2 ) . PHP_EOL ); // $vtc1 - $vtc2 is Vector( x:23.87, y:-37.95, z:78.34, w:0.00 )
print( 'opposite of $vtc1 is ' . $vtc1->opposite() . PHP_EOL );
print( 'scalar product of $vtc1 and 42 is ' . $vtc1->scalarProduct( 42 ) . PHP_EOL );
print( 'dot product of $vtc1 and $vtc2 is ' . $vtc1->dotProduct( $vtc2 ) . PHP_EOL );
 print( 'cross product of $vtc1 and $vtc2 is ' . $vtc1->crossProduct( $vtc2 ) . PHP_EOL );
 print( 'cross product of $vtcXunit and $vtcYunit is ' . $vtcXunit->crossProduct( $vtcYunit ) . 'aka $vtcZunit' . PHP_EOL );
print( 'cosinus of angle between $vtc1 and $vtc2 is ' . $vtc1->cos( $vtc2 ) . PHP_EOL );
print( 'cosinus of angle between $vtcXunit and $vtcYunit is ' . $vtcXunit->cos( $vtcYunit ) . PHP_EOL );

// 
?>
