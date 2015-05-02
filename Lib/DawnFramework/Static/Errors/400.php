<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description
 * @file            404.php
 * @version         1
 * @package         Dawn
 * @author          Patrick Bélanger (patrick.belanger <dot> gmail <dot> com)
 * @licence         Apache 2.0  http://www.apache.org/licenses/LICENSE-2.0
 *
 * Copyright © 2015, Patrick Bélanger and contributors. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/******************************************************************************************************************
 * CUSTOM FUNCTIONS
 *****************************************************************************************************************/

 function returnBaseDir() {
     /**
      * If framework is run locally on Windows operating system, we need to format the base directory value.
      * By default, browsers will prevent to load local resource.
      */
     $baseDir = str_replace('\\','/',dirname(__FILE__));
     $baseDir = str_replace($_SERVER['DOCUMENT_ROOT'],'',$baseDir);
     print($baseDir);
 }

/******************************************************************************************************************
 * HTML
 *****************************************************************************************************************/

?>
<!--

8 888888888o.            .8. `8.`888b                 ,8' b.             8
8 8888    `^888.        .888. `8.`888b               ,8'  888o.          8
8 8888        `88.     :88888. `8.`888b             ,8'   Y88888o.       8
8 8888         `88    . `88888. `8.`888b     .b    ,8'    .`Y888888o.    8
8 8888          88   .8. `88888. `8.`888b    88b  ,8'     8o. `Y888888o. 8
8 8888          88  .8`8. `88888. `8.`888b .`888b,8'      8`Y8o. `Y88888o8
8 8888         ,88 .8' `8. `88888. `8.`888b8.`8888'       8   `Y8o. `Y8888
8 8888        ,88'.8'   `8. `88888. `8.`888`8.`88'        8      `Y8o. `Y8
8 8888    ,o88P' .888888888. `88888. `8.`8' `8,`'         8         `Y8o.`
8 888888888P'   .8'       `8. `88888. `8.`   `8'          8            `Yo

                               Dawn Framework

You're reading? Want to contribute? :) https://github.com/patrickbelanger/dawn-framework

-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Error 400</title>
        <meta charset="utf-8">
        <meta name="author" content="Patrick Bélanger">
        <meta name="copyright" content="Copyright &copy; 2015, Patrick Bélanger and contributors. All rights reserved.">
        <link rel="stylesheet" href="<?php returnBaseDir(); ?>/Css/errorDocument.css">
    </head>
    <body>
        <section id="errorTitle" class="errorTitle">
            <h1>Error 400</h1>
        </section>
        <section id="errorDescription" class="errorDescription">
            Bad request.
        </section>
        <footer>
            <div class="left"><b>Dawn Framework</b></div>
            <div class="right">Copyright &copy; 2015, Patrick Bélanger and contributors. All rights reserved.</div>
        </footer>
    </body>
</html>