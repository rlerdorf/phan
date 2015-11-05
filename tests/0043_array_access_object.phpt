--TEST--
Array access object
--FILE--
<?php
class A { }
$a = new A;
if($a[1]) { }

class B implements ArrayAccess {
	function offsetExists($offset) { }
    function offsetGet($offset) { }
    function offsetSet($offset,$value) { }
    function offsetUnset($offset) { }
}

$b = new B;
if($b[1]) { }

interface I extends ArrayAccess { }

class C implements I {
    function offsetExists($offset) { }
    function offsetGet($offset) { }
    function offsetSet($offset,$value) { }
    function offsetUnset($offset) { }
}

class D {
    static function withB(B $b) {
        if($b[1]) { }
    }

    static function withC(C $c) {
        if($c[1]) { }
    }
}

D::withB(new B);
D::withC(new C);

$c = new C;
if ($c[1]) { }
--EXPECTF--
%s:4 TypeError Suspicious array access to a
