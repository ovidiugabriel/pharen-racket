<?php

class Iteration {
    private $index;
    private $total;
    
    public function __construct($index, $total) {
        $this->index = (int) $index;
        $this->total = (int) $total;
    }
    
    public function index() {
        return $this->index;
    }

    public function iteration() {
        return $this->index + 1;
    }
    
    public function first() {
        return 0 == $this->index;
    }
    
    public function last() {
        return ($this->total - 1) == $this->index;
    }
    
    public function show() {
        return $this->total > 0;
    }
    
    public function total() {
        return $this->total;
    }
}

/**
 * Argument can be either an array or a PharenVector.
 * When a PharenVector is given it is converted into an array.
 *
 * @param array|PharenVector $lst
 * @return array
 */
function from_pharen_vector($lst) {
    if (is_object($lst) && get_class($lst) == 'PharenVector') {
        return arr($lst);
    }
    return $lst;
}

/**
 * Iteratively executes $callback for all the elements of the list $a 
 * from the first element to the last one. 
 * If the list is empty $forelse is executed.
 *
 * @param array|PharenVector $a
 * @param callback $callback
 * @param callback $forelse
 */
function for_each($a, $callback, $forelse = null) {
    $a = from_pharen_vector($a);
    $n = count($a);
    $it = new Iteration(0, $n);
    
    for ($i = 0; $i < $n; $i++) {
        $it = new Iteration($i, $n);
        $callback($it, $a[$i]);
    }   
    if ((0 == $i) && (null != $forelse)) {
        $forelse();
    }
    return $it;
}

