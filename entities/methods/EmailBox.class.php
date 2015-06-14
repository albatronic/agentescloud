<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:05
 */

/**
 * @orm:Entity(Emailbox)
 */
class EmailBox extends EmailBoxEntity {

    public function __toString() {
        return ($this->Id) ? $this->Id : '';
    }

}
