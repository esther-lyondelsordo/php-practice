// Exceptions exercise from the fantastic learn-php.org
<?php
# This function will throw an exception!
function throw_exception() {
  throw new Exception("Exception!");
}

# Surround the statement in a try-catch-finally block!
try {
    throw_exception();
} catch (Exception $e) {
    echo "Exception caught!\n";
} finally {
    echo "Done!";
}

?>