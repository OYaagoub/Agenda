<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="app/resources/css/style.css">
</head>

<body>
    <div id="log">
        <a href="#" id="login">login</a>
        <a href="#" id="register">register</a>
        <span style="display:flex;align-items:center;padding:3px;">
        <img style="width:60px" src="app/resources/icon/user.png" alt="">
        <p>Oussama</p></span>
        <a href="#" id="logout">logout</a>

    </div>
    <?php
        require_once "app/resources/views/login.php";
        require_once "app/resources/views/register.php";
        require_once "app/resources/views/alert.php";
        
    ?>
    

    <div id="load">
        <svg width="300" height="120" id="clackers">
        <!-- Left arc path -->
        <svg>
            <path id="arc-left-up" fill="none" d="M 90 90 A 90 90 0 0 1 0 0"/>
        </svg>
        <!-- Right arc path -->
        <svg>
            <path id="arc-right-up" fill="none" d="M 100 90 A 90 90 0 0 0 190 0"/>
        </svg>
        
        <text x="150" y="50" fill="#ffffff" font-family="Helvetica Neue,Helvetica,Arial" font-size="18"
                text-anchor="middle">
            L O A D I N G
        </text>
        <circle cx="15" cy="15" r="15">
            <!-- I used a python script to calculate the keyPoints and keyTimes based on a quadratic function. -->
            <animateMotion dur="1.5s" repeatCount="indefinite"
            calcMode="linear"
            keyPoints="0.0;0.19;0.36;0.51;0.64;0.75;0.84;0.91;0.96;0.99;1.0;0.99;0.96;0.91;0.84;0.75;0.64;0.51;0.36;0.19;0.0;0.0;0.05;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0"
            keyTimes="0.0;0.025;0.05;0.075;0.1;0.125;0.15;0.175;0.2;0.225;0.25;0.275;0.3;0.325;0.35;0.375;0.4;0.425;0.45;0.475;0.5;0.525;0.55;0.575;0.6;0.625;0.65;0.675;0.7;0.725;0.75;0.775;0.8;0.825;0.85;0.875;0.9;0.925;0.95;0.975;1.0">
            <mpath xlink:href="#arc-left-up"/>
            </animateMotion>
        </circle>
        <circle cx="135" cy="105" r="15" />
        <circle cx="165" cy="105" r="15" />
        <circle cx="95" cy="15" r="15">
            <animateMotion dur="1.5s" repeatCount="indefinite"
            calcMode="linear"
            keyPoints="0.0;0.0;0.05;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0.0;0.19;0.36;0.51;0.64;0.75;0.84;0.91;0.96;0.99;1.0;0.99;0.96;0.91;0.84;0.75;0.64;0.51;0.36;0.19;0.0"
            keyTimes="0.0;0.025;0.05;0.075;0.1;0.125;0.15;0.175;0.2;0.225;0.25;0.275;0.3;0.325;0.35;0.375;0.4;0.425;0.45;0.475;0.5;0.525;0.55;0.575;0.6;0.625;0.65;0.675;0.7;0.725;0.75;0.775;0.8;0.825;0.85;0.875;0.9;0.925;0.95;0.975;1.0">
            <mpath xlink:href="#arc-right-up"/>
            </animateMotion>
        </circle>
        </svg>
    </div>

    <div id="dashboard">


    <!-- days sourced from: https://nationaldaycalendar.com/february/ -->
    <h1>February 2022</h1>
    <p>Holidays and Daily Observances in the United States</a>
    
    <ul id="loaddata">
        <li data-datetime="2022-02-01 21:21"><time >1</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-02 12:21"><time >2</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-03"><time >3</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-04"><time >4</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-05"><time >5</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-06"><time >6</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-07"><time >7</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
    </ul>
    
    <div id="form">
        <h3>Agrega un evento</h3>
        <div style="display:flex">

            <input class="input" type="time" name="" id="time" style="padding:10px">
            <input class="input" type="text" id="title" placeholder="Tiltulo">
        </div>
        <!-- <input type="text" id="descripcion" placeholder="Descripcion"> -->
        <textarea name="" style="width:50%" id="description" cols="30" rows="10" placeholder="Descripcion"></textarea>
        <img id="close" src="app/resources/icon/close.png" alt="">
        <div style="width:100%;display:flex;flex-direction:column;align-items:center">

            <button id="btn_insert" style="width:40%" >Agregar</button>
            
            
        </div>
    </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="app/resources/js/open.js"></script>
<script src="app/resources/js/alert.js"></script>
<script src="app/resources/js/insertNote.js"></script>
<script src="app/resources/js/signup.js"></script>
<script src="app/resources/js/login.js"></script>
</html>