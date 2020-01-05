<?php

$CurrentTime = time();
// $DateTime = strftime("%d-%m-%Y - %H:%M:%S", $CurrentTime);

$DateTime = strftime("%d  %B - %Y - %H:%M:%S", $CurrentTime);
echo $DateTime;
