<?php

//
// Other
//

/**
 * Help for print something ( multiple values ) with "\n"
 *
 * @param ...$s
 */
function println(...$s): void
{
    foreach ($s as $v) {
        print ($v . "\n");
    }
}
